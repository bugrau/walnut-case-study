1. Launch EC2 Instance
   - Choose Ubuntu Server 20.04 LTS
   - Select t2.micro (free tier) or t2.small
   - Configure Security Group:
     - Allow SSH (Port 22)
     - Allow HTTP (Port 80)
     - Allow HTTPS (Port 443)

2. Connect to EC2 Instance   ```bash
   ssh -i your-key.pem ubuntu@your-ec2-ip   ```

3. Install Docker and Docker Compose   ```bash
   sudo apt update
   sudo apt install -y docker.io docker-compose
   sudo usermod -aG docker ubuntu   ```

4. Clone Project and Deploy   ```bash
   git clone your-project-repo
   cd your-project
   docker-compose up -d   ```

Unique Approaches:
1. Using Docker's restart policy to ensure the container always runs
2. Implementing Chromium instead of Chrome for lighter weight
3. Using node-cron inside the container instead of system cron
4. Setting up proper error handling and logging 