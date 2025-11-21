# HMS API Documentation

## Base URL
```
http://localhost/api/v1
```

## Endpoints

### Patients

#### Get All Patients
```
GET /patients
Query Parameters:
  - search: Search by name, phone, or email
```

#### Get Single Patient
```
GET /patients/{id}
```

#### Create Patient
```
POST /patients
Body: {
  "first_name": "string",
  "last_name": "string",
  "date_of_birth": "YYYY-MM-DD",
  "gender": "Male|Female|Other",
  "blood_type": "string",
  "phone": "string",
  "email": "string",
  "address": "string",
  "emergency_contact": "string",
  "emergency_phone": "string",
  "medical_history": "string",
  "allergies": "string"
}
```

#### Update Patient
```
PUT /patients/{id}
Body: Same as Create Patient
```

#### Delete Patient
```
DELETE /patients/{id}
```

### Appointments

#### Get All Appointments
```
GET /appointments
Query Parameters:
  - doctor_id: Filter by doctor
  - patient_id: Filter by patient
  - date: Filter by date (YYYY-MM-DD)
  - status: Filter by status
```

#### Create Appointment
```
POST /appointments
Body: {
  "patient_id": integer,
  "doctor_id": integer,
  "scheduled_at": "YYYY-MM-DD HH:MM:SS",
  "duration_minutes": integer,
  "reason": "string",
  "notes": "string"
}
```

#### Update Appointment
```
PUT /appointments/{id}
```

#### Confirm Appointment
```
POST /appointments/{id}/confirm
```

#### Cancel Appointment
```
POST /appointments/{id}/cancel
```

### Medicines

#### Get All Medicines
```
GET /medicines
Query Parameters:
  - search: Search by name or SKU
  - low_stock: Get low stock medicines (true/false)
  - expiring: Get expiring medicines (true/false)
  - days: Days for expiring check (default: 30)
```

#### Get Medicine Alerts
```
GET /medicines/alerts
```

#### Create Medicine
```
POST /medicines
Body: {
  "name": "string",
  "sku": "string",
  "batch_number": "string",
  "expiry_date": "YYYY-MM-DD",
  "supplier": "string",
  "purchase_price": decimal,
  "sale_price": decimal,
  "stock_quantity": integer,
  "min_stock_threshold": integer
}
```

#### Dispense Medicine
```
POST /medicines/{id}/dispense
Body: {
  "quantity": integer
}
```

### Admissions

#### Get All Admissions
```
GET /admissions
Query Parameters:
  - status: Filter by status
  - patient_id: Filter by patient
```

#### Get Active Admissions
```
GET /admissions/active
```

#### Create Admission
```
POST /admissions
Body: {
  "patient_id": integer,
  "admitted_by": integer,
  "assigned_doctor_id": integer,
  "ward_id": integer,
  "room_number": "string",
  "bed_number": "string",
  "notes": "string"
}
```

#### Discharge Patient
```
POST /admissions/{id}/discharge
Body: {
  "discharge_date": "YYYY-MM-DD HH:MM:SS",
  "notes": "string"
}
```

### Invoices

#### Get All Invoices
```
GET /invoices
Query Parameters:
  - status: Filter by status
  - patient_id: Filter by patient
```

#### Get Unpaid Invoices
```
GET /invoices/unpaid
```

#### Create Invoice
```
POST /invoices
Body: {
  "patient_id": integer,
  "admission_id": integer (optional),
  "created_by": integer,
  "total_amount": decimal
}
```

#### Mark Invoice as Paid
```
POST /invoices/{id}/mark-paid
```

### Dashboard

#### Get Dashboard Statistics
```
GET /dashboard
```

#### Get Appointment Statistics
```
GET /dashboard/appointment-stats
```

#### Get Admission Statistics
```
GET /dashboard/admission-stats
```

#### Get Financial Overview
```
GET /dashboard/financial-overview
```

### Reports

#### Patient Report
```
GET /reports/patients
Query Parameters:
  - from: Start date (YYYY-MM-DD)
  - to: End date (YYYY-MM-DD)
```

#### Appointment Report
```
GET /reports/appointments
Query Parameters:
  - from: Start date (YYYY-MM-DD)
  - to: End date (YYYY-MM-DD)
```

#### Admission Report
```
GET /reports/admissions
Query Parameters:
  - from: Start date (YYYY-MM-DD)
  - to: End date (YYYY-MM-DD)
```

#### Financial Report
```
GET /reports/financial
Query Parameters:
  - from: Start date (YYYY-MM-DD)
  - to: End date (YYYY-MM-DD)
```

## Response Format

### Success Response
```json
{
  "status": "success",
  "data": { ... }
}
```

### Error Response
```json
{
  "status": "error",
  "message": "Error message",
  "errors": { ... }
}
```

## Status Codes

- 200: Success
- 201: Created
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 422: Validation Error
- 500: Server Error
