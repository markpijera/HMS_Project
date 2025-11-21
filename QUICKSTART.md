# Quick Start Guide - HMS

## Prerequisites Check
✅ PHP 8.2.12 - Installed
✅ Composer 2.8.11 - Installed
✅ XAMPP - Installed

## Step-by-Step (5 Minutes)

### 1. Start XAMPP Services
- Open **XAMPP Control Panel**
- Click **Start** on **Apache**
- Click **Start** on **MySQL**

### 2. Create Database
Open browser: `http://localhost/phpmyadmin`

Click "SQL" tab and run:
```sql
CREATE DATABASE hms_database;
```

### 3. Copy Environment File
Open PowerShell in this folder and run:
```powershell
Copy-Item env .env
```

Or manually: Copy `env` file and rename it to `.env`

### 4. Install Dependencies (if needed)
```powershell
composer install
```

### 5. Run Migrations (Create Tables)
```powershell
php spark migrate
```

This creates 11 tables:
- patients
- doctors
- appointments
- medicines
- admissions
- invoices
- wards
- users
- medical_records
- prescriptions
- lab_tests

### 6. Seed Sample Data
```powershell
php spark db:seed DatabaseSeeder
```

This adds:
- 5 Doctors
- 5 Patients
- 8 Medicines
- 6 Wards
- 5 Users (admin, doctor, nurse, receptionist, pharmacist)

### 7. Start Server
```powershell
php spark serve
```

Server will run at: **http://localhost:8080**

---

## Test the API

### In Browser:

**Dashboard:**
```
http://localhost:8080/api/v1/dashboard
```

**Get All Patients:**
```
http://localhost:8080/api/v1/patients
```

**Get All Doctors:**
```
http://localhost:8080/api/v1/doctors
```

**Get Available Wards:**
```
http://localhost:8080/api/v1/wards/available
```

**Get Medicine Alerts:**
```
http://localhost:8080/api/v1/medicines/alerts
```

### Using PowerShell:

**Login:**
```powershell
$body = @{
    email = "admin@hospital.com"
    password = "admin123"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:8080/api/v1/auth/login" -Method Post -Body $body -ContentType "application/json"
```

**Get Dashboard:**
```powershell
Invoke-RestMethod -Uri "http://localhost:8080/api/v1/dashboard"
```

**Get Patients:**
```powershell
Invoke-RestMethod -Uri "http://localhost:8080/api/v1/patients"
```

---

## Default Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@hospital.com | admin123 |
| Doctor | john.smith@hospital.com | doctor123 |
| Nurse | mary.johnson@hospital.com | nurse123 |
| Receptionist | sarah.lee@hospital.com | reception123 |
| Pharmacist | mike.brown@hospital.com | pharma123 |

---

## Available Endpoints

### Authentication
- POST `/api/v1/auth/login`
- POST `/api/v1/auth/register`
- GET `/api/v1/auth/me`

### Patients
- GET `/api/v1/patients`
- POST `/api/v1/patients`
- GET `/api/v1/patients/{id}`

### Doctors
- GET `/api/v1/doctors`
- GET `/api/v1/doctors/available`
- GET `/api/v1/doctors/{id}/schedule`

### Appointments
- GET `/api/v1/appointments`
- POST `/api/v1/appointments`
- POST `/api/v1/appointments/{id}/confirm`

### Medicines
- GET `/api/v1/medicines`
- GET `/api/v1/medicines/alerts`
- POST `/api/v1/medicines/{id}/dispense`

### Admissions
- GET `/api/v1/admissions`
- GET `/api/v1/admissions/active`
- POST `/api/v1/admissions/{id}/discharge`

### Invoices
- GET `/api/v1/invoices`
- GET `/api/v1/invoices/unpaid`
- POST `/api/v1/invoices/{id}/mark-paid`

### Wards
- GET `/api/v1/wards`
- GET `/api/v1/wards/available`

### Medical Records
- GET `/api/v1/medical-records`
- GET `/api/v1/medical-records/patient/{id}`

### Prescriptions
- GET `/api/v1/prescriptions`
- GET `/api/v1/prescriptions/active`
- GET `/api/v1/prescriptions/patient/{id}`

### Lab Tests
- GET `/api/v1/lab-tests`
- GET `/api/v1/lab-tests/pending`
- GET `/api/v1/lab-tests/completed`

### Dashboard & Reports
- GET `/api/v1/dashboard`
- GET `/api/v1/dashboard/appointment-stats`
- GET `/api/v1/reports/patients`
- GET `/api/v1/reports/financial`

---

## Troubleshooting

**Error: Database connection failed**
- Make sure MySQL is running in XAMPP
- Check database name is `hms_database`

**Error: Port 8080 already in use**
```powershell
php spark serve --port=8081
```

**Error: Class not found**
```powershell
composer dump-autoload
```

---

## Next Steps

1. Test the API endpoints
2. Check the dashboard statistics
3. Try creating a patient
4. Try booking an appointment
5. Explore all features!

For full documentation, see:
- `API_DOCUMENTATION.md`
- `SETUP_GUIDE.md`
- `INSTALLATION.md`

🎉 **Enjoy testing the Hospital Management System!**
