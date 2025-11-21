# HMS Setup & Running Guide

## ✅ Prerequisites (Already Installed)
- ✓ PHP 8.2.12
- ✓ Composer 2.8.11
- ✓ XAMPP (with MySQL/MariaDB)

## 📋 Step-by-Step Setup Instructions

### Step 1: Start XAMPP Services

1. Open **XAMPP Control Panel**
2. Start **Apache** (for web server)
3. Start **MySQL** (for database)

### Step 2: Create Database

**Option A: Using phpMyAdmin**
1. Open browser and go to: `http://localhost/phpmyadmin`
2. Click "New" in the left sidebar
3. Database name: `hms_database`
4. Collation: `utf8mb4_general_ci`
5. Click "Create"

**Option B: Using Command Line**
```bash
# Open Command Prompt in this directory
mysql -u root -p
# Press Enter (no password by default in XAMPP)

# Then run:
CREATE DATABASE hms_database;
exit;
```

### Step 3: Configure Environment

1. Copy the environment file:
```bash
copy env .env
```

2. Open `.env` file and verify database settings:
```
database.default.hostname = localhost
database.default.database = hms_database
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### Step 4: Install Dependencies

```bash
composer install
```

### Step 5: Run Database Migrations

This creates all the tables (patients, doctors, appointments, medicines, admissions, invoices, wards, users):

```bash
php spark migrate
```

### Step 6: Seed Database with Sample Data

This adds sample doctors, patients, medicines, wards, and users:

```bash
php spark db:seed DatabaseSeeder
```

### Step 7: Start the Development Server

**Option A: Using CodeIgniter Spark (Recommended)**
```bash
php spark serve
```
Server will run at: `http://localhost:8080`

**Option B: Using XAMPP Apache**
- Already running if Apache is started in XAMPP
- Access at: `http://localhost/HMS/public`

## 🧪 Testing the API

### Using Browser

1. **Test Homepage:**
   ```
   http://localhost:8080
   ```

2. **Test API - Get All Patients:**
   ```
   http://localhost:8080/api/v1/patients
   ```

3. **Test API - Get Dashboard:**
   ```
   http://localhost:8080/api/v1/dashboard
   ```

### Using cURL (Command Prompt)

**Get All Patients:**
```bash
curl http://localhost:8080/api/v1/patients
```

**Login:**
```bash
curl -X POST http://localhost:8080/api/v1/auth/login ^
  -H "Content-Type: application/json" ^
  -d "{\"email\":\"admin@hospital.com\",\"password\":\"admin123\"}"
```

**Create a Patient:**
```bash
curl -X POST http://localhost:8080/api/v1/patients ^
  -H "Content-Type: application/json" ^
  -d "{\"first_name\":\"John\",\"last_name\":\"Doe\",\"phone\":\"555-9999\",\"gender\":\"Male\"}"
```

**Get Dashboard Statistics:**
```bash
curl http://localhost:8080/api/v1/dashboard
```

**Get Available Wards:**
```bash
curl http://localhost:8080/api/v1/wards/available
```

**Get Medicine Alerts:**
```bash
curl http://localhost:8080/api/v1/medicines/alerts
```

### Using Postman

1. Download Postman: https://www.postman.com/downloads/
2. Import collection from `API_DOCUMENTATION.md`
3. Set base URL: `http://localhost:8080/api/v1`
4. Test all endpoints

## 👥 Default User Accounts

After seeding, you can login with these accounts:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@hospital.com | admin123 |
| Doctor | john.smith@hospital.com | doctor123 |
| Nurse | mary.johnson@hospital.com | nurse123 |
| Receptionist | sarah.lee@hospital.com | reception123 |
| Pharmacist | mike.brown@hospital.com | pharma123 |

## 📊 Sample Data Included

After seeding, you'll have:
- **5 Doctors** (Cardiology, Pediatrics, Orthopedics, Dermatology, Neurology)
- **5 Patients** with medical history
- **8 Medicines** with stock levels
- **6 Wards** (General, ICU, Private, Emergency, Pediatric)
- **5 Users** (one for each role)

## 🔍 Verify Installation

### Check Database Tables
```bash
php spark db:table --show
```

### Check Routes
```bash
php spark routes
```

## 🌐 API Endpoints Available

### Authentication
- POST `/api/v1/auth/login` - User login
- POST `/api/v1/auth/register` - Register new user
- GET `/api/v1/auth/me` - Get current user

### Patients
- GET `/api/v1/patients` - List all patients
- POST `/api/v1/patients` - Create patient
- GET `/api/v1/patients/{id}` - Get patient details
- PUT `/api/v1/patients/{id}` - Update patient
- DELETE `/api/v1/patients/{id}` - Delete patient

### Appointments
- GET `/api/v1/appointments` - List appointments
- POST `/api/v1/appointments` - Create appointment
- POST `/api/v1/appointments/{id}/confirm` - Confirm appointment
- POST `/api/v1/appointments/{id}/cancel` - Cancel appointment

### Medicines
- GET `/api/v1/medicines` - List medicines
- GET `/api/v1/medicines/alerts` - Get low stock & expiring alerts
- POST `/api/v1/medicines/{id}/dispense` - Dispense medicine

### Admissions
- GET `/api/v1/admissions` - List admissions
- GET `/api/v1/admissions/active` - Get active admissions
- POST `/api/v1/admissions` - Admit patient
- POST `/api/v1/admissions/{id}/discharge` - Discharge patient

### Invoices
- GET `/api/v1/invoices` - List invoices
- GET `/api/v1/invoices/unpaid` - Get unpaid invoices
- POST `/api/v1/invoices` - Create invoice
- POST `/api/v1/invoices/{id}/mark-paid` - Mark as paid

### Wards
- GET `/api/v1/wards` - List all wards
- GET `/api/v1/wards/available` - Get available wards
- POST `/api/v1/wards` - Create ward

### Dashboard
- GET `/api/v1/dashboard` - Get statistics
- GET `/api/v1/dashboard/appointment-stats` - Appointment statistics
- GET `/api/v1/dashboard/financial-overview` - Financial overview

### Reports
- GET `/api/v1/reports/patients` - Patient report
- GET `/api/v1/reports/appointments` - Appointment report
- GET `/api/v1/reports/financial` - Financial report

## 🐛 Troubleshooting

### Database Connection Error
```
Error: Unable to connect to database
```
**Solution:**
1. Verify MySQL is running in XAMPP
2. Check database name is `hms_database`
3. Verify credentials in `.env` file

### Port Already in Use
```
Error: Address already in use
```
**Solution:**
```bash
# Use different port
php spark serve --port=8081
```

### Migration Error
```
Error: Table already exists
```
**Solution:**
```bash
# Reset database
php spark migrate:rollback
php spark migrate
```

### Composer Dependencies Missing
```
Error: Class not found
```
**Solution:**
```bash
composer install
composer dump-autoload
```

## 📱 Next Steps

1. **Explore the API** - Use Postman or cURL to test endpoints
2. **Check Dashboard** - View statistics at `/api/v1/dashboard`
3. **Create Test Data** - Add more patients, appointments, etc.
4. **Build Frontend** - Connect React/Vue.js frontend to the API
5. **Add Authentication** - Implement JWT tokens for production

## 📚 Documentation

- **API Documentation:** See `API_DOCUMENTATION.md`
- **Installation Guide:** See `INSTALLATION.md`
- **Contributing:** See `CONTRIBUTING.md`

## 🆘 Need Help?

- Check logs: `writable/logs/`
- Enable debug mode in `.env`: `CI_ENVIRONMENT = development`
- Review error messages in browser/terminal

## ✅ Success Indicators

You'll know it's working when:
- ✓ Server starts without errors
- ✓ `/api/v1/patients` returns JSON data
- ✓ `/api/v1/dashboard` shows statistics
- ✓ Login works with test credentials
- ✓ No database connection errors

---

**Ready to start? Run these commands:**

```bash
# 1. Start XAMPP (Apache + MySQL)
# 2. Create database
# 3. Then run:

copy env .env
composer install
php spark migrate
php spark db:seed DatabaseSeeder
php spark serve

# Open browser: http://localhost:8080/api/v1/dashboard
```

🎉 **Enjoy your Hospital Management System!**
