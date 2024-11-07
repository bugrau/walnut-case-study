const puppeteer = require('puppeteer');
const axios = require('axios');
const retry = require('retry');

async function scrapeNews() {
    console.log('Starting scraping process...');
    let browser = null;

    try {
        browser = await puppeteer.launch({
            headless: "new",  // Using new headless mode
            args: [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-dev-shm-usage',
                '--disable-gpu'
            ]
        });

        console.log('Browser launched successfully');
        const page = await browser.newPage();
        
        // Set longer timeout and log navigation
        console.log('Navigating to The Guardian...');
        await page.goto('https://www.theguardian.com/international', {
            waitUntil: 'networkidle0',
            timeout: 60000
        });
        
        // Action 1: Click on the "News" section
        console.log('Looking for News section...');
        await page.waitForSelector('nav a[href="/news"]', { timeout: 30000 });
        await page.click('nav a[href="/news"]');
        
        // Action 2: Wait for and click on the first article
        console.log('Looking for first article...');
        await page.waitForSelector('a[data-link-name="article"]', { timeout: 30000 });
        await page.click('a[data-link-name="article"]');
        
        // Action 3: Wait for article content to load and read it
        console.log('Reading article content...');
        await page.waitForSelector('.article-body-content', { timeout: 30000 });
        
        const data = await page.evaluate(() => {
            const title = document.querySelector('h1')?.innerText || 'No title found';
            const content = document.querySelector('.article-body-content')?.innerText || '';
            const wordCount = content.split(/\s+/).length;
            
            return {
                title,
                wordCount,
                timestamp: new Date().toISOString()
            };
        });

        console.log('Article data collected:', {
            title: data.title,
            wordCount: data.wordCount
        });

        // Send data to Laravel callback endpoint
        console.log('Sending data to Laravel API...');
        await axios.post('http://your-laravel-api/callback', data);
        console.log('Data sent successfully');

    } catch (error) {
        console.error('Scraping error:', error.message);
        if (error.name === 'TimeoutError') {
            console.error('Page timed out. Check your internet connection or if the website structure has changed.');
        }
    } finally {
        if (browser) {
            await browser.close();
            console.log('Browser closed');
        }
    }
}

async function scrapeWithRetry() {
    const operation = retry.operation({
        retries: 3,
        factor: 2,
        minTimeout: 1000
    });

    operation.attempt(async () => {
        try {
            await scrapeNews();
        } catch (err) {
            if (operation.retry(err)) {
                return;
            }
        }
    });
}

module.exports = scrapeWithRetry;
