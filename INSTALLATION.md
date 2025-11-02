# HMS Installation Guide

## Prerequisites

- PHP 8.1 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- XAMPP (recommended for local development)

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/markpijera/HMS_Project.git
cd HMS_Project
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file:

```bash
cp env .env
```

Or on Windows:

```bash
copy env .env
```

Edit `.env` file and configure your database:

```
database.default.hostname = localhost
database.default.database = hms_database
database.default.username = root
database.default.password = your_password
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 4. Create Database

Create a new MySQL database:

```sql
CREATE DATABASE hms_database;
```

### 5. Run Migrations

```bash
php spark migrate
```

This will create all necessary tables:
- patients
- doctors
- appointments
- medicines
- admissions
- invoices

### 6. Seed Database (Optional)

To populate the database with sample data:

```bash
php spark db:seed DatabaseSeeder
```

This will add:
- 5 sample doctors
- 5 sample patients
- 8 sample medicines

### 7. Start Development Server

#### Using PHP Built-in Server

```bash
php spark serve
```

The application will be available at: `http://localhost:8080`

#### Using XAMPP

1. Copy the project to `C:\xampp\htdocs\HMS`
2. Start Apache and MySQL from XAMPP Control Panel
3. Access the application at: `http://localhost/HMS/public`

### 8. Configure Virtual Host (Optional)

For better development experience, configure a virtual host:

**Apache Configuration (httpd-vhosts.conf):**

```apache
<VirtualHost *:80>
    ServerName hms.local
    DocumentRoot "C:/xampp/htdocs/HMS/public"
    
    <Directory "C:/xampp/htdocs/HMS/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Windows Hosts File (C:\Windows\System32\drivers\etc\hosts):**

```
127.0.0.1 hms.local
```

Access the application at: `http://hms.local`

## API Testing

### Using cURL

```bash
# Get all patients
curl http://localhost:8080/api/v1/patients

# Create a patient
curl -X POST http://localhost:8080/api/v1/patients \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "John",
    "last_name": "Doe",
    "phone": "555-1234",
    "gender": "Male"
  }'
```

### Using Postman

1. Import the API documentation from `API_DOCUMENTATION.md`
2. Set base URL to `http://localhost:8080/api/v1`
3. Test all endpoints

## Troubleshooting

### Database Connection Error

- Verify MySQL service is running
- Check database credentials in `.env`
- Ensure database exists

### Permission Issues

On Linux/Mac, set proper permissions:

```bash
chmod -R 777 writable/
```

### CORS Issues

The CORS filter is already configured in `app/Filters/CorsFilter.php`

## Production Deployment

### 1. Set Environment

```
CI_ENVIRONMENT = production
```

### 2. Disable Debug Mode

```
app.forceGlobalSecureRequests = true
```

### 3. Configure Database

Use production database credentials

### 4. Set Encryption Key

Generate a secure encryption key:

```bash
php spark key:generate
```

### 5. Optimize Autoloader

```bash
composer install --no-dev --optimize-autoloader
```

### 6. Configure Web Server

Point document root to `public/` directory

## Security Recommendations

1. Change default database credentials
2. Set strong encryption key
3. Enable HTTPS in production
4. Implement authentication/authorization
5. Regular database backups
6. Keep dependencies updated

## Support

For issues and questions:
- GitHub Issues: https://github.com/markpijera/HMS_Project/issues
- Documentation: See `README.md` and `API_DOCUMENTATION.md`

## License

MIT License
