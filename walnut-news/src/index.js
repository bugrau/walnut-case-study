const scrapeNews = require('./scraper');
const cron = require('node-cron');

// Run every 5 minutes
cron.schedule('*/5 * * * *', () => {
    console.log('Running scraper...');
    scrapeNews();
});

// Initial run
scrapeNews(); 