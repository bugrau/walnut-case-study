# Walnut Portal

A Laravel-based admin portal for managing and processing news content. This system receives news data through an API, processes it, and provides an admin interface for monitoring and management.

## Table of Contents
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Architecture](#architecture)
- [Database Schema](#database-schema)
- [API Documentation](#api-documentation)
- [Admin Interface](#admin-interface)
- [Processing Flow](#processing-flow)
- [Development Guide](#development-guide)
- [Troubleshooting](#troubleshooting)

## System Requirements

### Core Requirements
- PHP 8.3 or higher
- MySQL 5.7 or higher
- Composer 2.0+
- Node.js 14+ & NPM 6+

### PHP Extensions
- JSON
- PDO
- MySQL
- OpenSSL
- Mbstring
- Tokenizer
- XML
- CURL

## Installation

### 1. Initial Setup

## Database Schema

### Tables Overview

#### admin_users
| Column    | Type         | Description           |
|-----------|-------------|-----------------------|
| id        | bigint      | Primary key          |
| email     | string      | Admin email address  |
| password  | string      | Hashed password      |
| created_at| timestamp   | Creation timestamp   |
| updated_at| timestamp   | Update timestamp     |
| deleted_at| timestamp   | Soft delete timestamp|

#### incoming_log_data
| Column    | Type         | Description           |
|-----------|-------------|-----------------------|
| id        | bigint      | Primary key          |
| payload   | json        | Raw incoming data    |
| inserted  | json        | Processed items      |
| created_at| timestamp   | Creation timestamp   |
| deleted_at| timestamp   | Soft delete timestamp|

#### incoming_logs
| Column    | Type         | Description           |
|-----------|-------------|-----------------------|
| id        | bigint      | Primary key          |
| source    | string      | News source          |
| title     | string      | News title           |
| word_count| integer     | Article word count   |
| incoming_log_data_id| bigint | Foreign key     |

#### callback_logs
| Column    | Type         | Description           |
|-----------|-------------|-----------------------|
| id        | bigint      | Primary key          |
| incoming_log_id| bigint | Foreign key          |
| status    | enum        | pending/confirmed    |
| result    | string      | Processing result    |

## API Documentation

### Authentication
All API endpoints require a valid API token in the request header:
```
Authorization: Bearer YOUR_API_TOKEN
```

### Rate Limiting
- 100 requests per minute per IP
- 1000 requests per hour per token

### Endpoints

#### POST /api/callback
Receives and processes news data.

#### Request Format
[
    {
        "title": "Example News Title",
        "word_count": 1000
    },
    {
        "title": "Another News Title",
        "word_count": 500
    }
]

#### Success Response
{
    "success": true,
    "inserted_count": 2
}

#### Error Response
{
    "error": "Invalid request format"
}

#### GET /api/health
System health check endpoint.

Request: No parameters required

Response:
```json
{
    "status": "ok",
    "version": "1.0.0",
    "database": "connected",
    "queue": "running"
}
```

### Error Codes
| Code | Description           |
|------|-----------------------|
| 400  | Invalid request data  |
| 401  | Unauthorized         |
| 429  | Too many requests    |
| 500  | Server error         |

## Testing

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage report
php artisan test --coverage
```

### Test Categories
- Unit Tests: `tests/Unit`
- Feature Tests: `tests/Feature`
- API Tests: `tests/Feature/Api`
- Integration Tests: `tests/Integration`

## Performance Optimization

### Caching
- Redis caching enabled for:
  - API responses (5 minutes)
  - Database queries (1 hour)
  - Configuration (until changed)

### Queue Configuration
- Failed jobs retry: 3 times
- Queue timeout: 5 minutes
- Default queue: 'default'
- Priority queues: 'high', 'low'

### Database Indexing
Key indexes are set up on:
- incoming_logs: title, source
- callback_logs: status
- incoming_log_data: created_at

## Backup & Recovery

### Automated Backups
```bash
# Run backup
php artisan backup:run

# List backups
php artisan backup:list
```

### Backup Schedule
- Database: Daily at midnight
- Files: Weekly on Sunday
- Logs: Monthly rotation

### Recovery Procedures
1. Stop the application
2. Restore database backup
3. Restore file backup
4. Clear cache
5. Restart services

## Installation Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/your-org/walnut-portal.git
   cd walnut-portal
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your database in `.env`

5. Run migrations and build assets:
   ```bash
   php artisan migrate
   npm run build
   ```

6. Start the server:
   ```bash
   php artisan serve
   ```

## Development Setup

### Local Environment
- Configure your local `.env` file
- Set up a local MySQL database
- Ensure Redis is running (if using queues)

### Development Commands
```bash
# Run tests
php artisan test

# Watch assets during development
npm run dev

# Code style fixing
./vendor/bin/pint

# Clear application cache
php artisan optimize:clear

# Generate API documentation
php artisan l5-swagger:generate

# Run queue worker
php artisan queue:work
```

## Admin Interface

### Features
- Dashboard with real-time statistics
- Incoming logs viewer with filtering
- Callback status monitoring
- User management
- System health monitoring

### Access
1. Create an admin user:
```bash
php artisan make:admin-user
```
2. Visit `/admin` and login
3. Use the navigation menu to access different sections

## Monitoring & Logging

### Available Logs
- Application logs: `storage/logs/laravel.log`
- Queue worker logs: `storage/logs/queue.log`
- API request logs: `storage/logs/api.log`

### Monitoring Tools
- Server status: `/admin/monitoring`
- Queue status: `/admin/queues`
- Failed jobs: `/admin/failed-jobs`

## Error Handling

### Common Issues
1. API Connection Errors
   - Check API credentials in `.env`
   - Verify network connectivity
   - Review `storage/logs/api.log`

2. Queue Processing Issues
   - Ensure Redis is running
   - Check queue worker status
   - Review failed jobs in admin panel

3. Database Issues
   - Verify database credentials
   - Check available disk space
   - Review MySQL error logs

## Security

### Best Practices
- Keep Laravel and packages updated
- Use HTTPS in production
- Enable rate limiting
- Regular security audits
- Proper input validation

### Configuration
- Set secure session settings
- Configure CORS properly
- Use environment variables
- Implement API authentication

## Support

For technical support:
- Email: support@walnutportal.com
- Documentation: `/admin/docs`
- Issue tracker: GitHub Issues

## Contributing

1. Fork the repository
2. Create feature branch
3. Follow coding standards
4. Write tests
5. Submit pull request

See [CONTRIBUTING.md](CONTRIBUTING.md) for detailed guidelines.

## License

The Walnut Portal is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
