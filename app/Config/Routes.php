<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// API Routes
$routes->group('api/v1', ['namespace' => 'App\Controllers\Api'], function($routes) {
    // Authentication routes
    $routes->post('auth/login', 'AuthController::login');
    $routes->post('auth/register', 'AuthController::register');
    $routes->get('auth/me', 'AuthController::me');
    $routes->put('auth/profile', 'AuthController::updateProfile');
    $routes->post('auth/change-password', 'AuthController::changePassword');
    $routes->post('auth/logout', 'AuthController::logout');

    // Patient routes
    $routes->get('patients', 'PatientController::index');
    $routes->get('patients/(:num)', 'PatientController::show/$1');
    $routes->post('patients', 'PatientController::create');
    $routes->put('patients/(:num)', 'PatientController::update/$1');
    $routes->delete('patients/(:num)', 'PatientController::delete/$1');

    // Doctor routes
    $routes->get('doctors', 'DoctorController::index');
    $routes->get('doctors/available', 'DoctorController::available');
    $routes->get('doctors/(:num)', 'DoctorController::show/$1');
    $routes->get('doctors/(:num)/schedule', 'DoctorController::schedule/$1');
    $routes->post('doctors', 'DoctorController::create');
    $routes->put('doctors/(:num)', 'DoctorController::update/$1');
    $routes->delete('doctors/(:num)', 'DoctorController::delete/$1');

    // Appointment routes
    $routes->get('appointments', 'AppointmentController::index');
    $routes->post('appointments', 'AppointmentController::create');
    $routes->put('appointments/(:num)', 'AppointmentController::update/$1');
    $routes->post('appointments/(:num)/confirm', 'AppointmentController::confirm/$1');
    $routes->post('appointments/(:num)/cancel', 'AppointmentController::cancel/$1');
    $routes->delete('appointments/(:num)', 'AppointmentController::delete/$1');

    // Medicine routes
    $routes->get('medicines', 'MedicineController::index');
    $routes->get('medicines/alerts', 'MedicineController::alerts');
    $routes->get('medicines/(:num)', 'MedicineController::show/$1');
    $routes->post('medicines', 'MedicineController::create');
    $routes->put('medicines/(:num)', 'MedicineController::update/$1');
    $routes->post('medicines/(:num)/dispense', 'MedicineController::dispense/$1');
    $routes->delete('medicines/(:num)', 'MedicineController::delete/$1');

    // Admission routes
    $routes->get('admissions', 'AdmissionController::index');
    $routes->get('admissions/active', 'AdmissionController::active');
    $routes->get('admissions/(:num)', 'AdmissionController::show/$1');
    $routes->post('admissions', 'AdmissionController::create');
    $routes->put('admissions/(:num)', 'AdmissionController::update/$1');
    $routes->post('admissions/(:num)/discharge', 'AdmissionController::discharge/$1');

    // Invoice routes
    $routes->get('invoices', 'InvoiceController::index');
    $routes->get('invoices/unpaid', 'InvoiceController::unpaid');
    $routes->get('invoices/(:num)', 'InvoiceController::show/$1');
    $routes->post('invoices', 'InvoiceController::create');
    $routes->put('invoices/(:num)', 'InvoiceController::update/$1');
    $routes->post('invoices/(:num)/mark-paid', 'InvoiceController::markPaid/$1');
    $routes->delete('invoices/(:num)', 'InvoiceController::delete/$1');

    // Dashboard routes
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('dashboard/appointment-stats', 'DashboardController::appointmentStats');
    $routes->get('dashboard/admission-stats', 'DashboardController::admissionStats');
    $routes->get('dashboard/financial-overview', 'DashboardController::financialOverview');

    // Report routes
    $routes->get('reports/patients', 'ReportController::patients');
    $routes->get('reports/appointments', 'ReportController::appointments');
    $routes->get('reports/admissions', 'ReportController::admissions');
    $routes->get('reports/financial', 'ReportController::financial');

    // Ward routes
    $routes->get('wards', 'WardController::index');
    $routes->get('wards/available', 'WardController::available');
    $routes->get('wards/(:num)', 'WardController::show/$1');
    $routes->post('wards', 'WardController::create');
    $routes->put('wards/(:num)', 'WardController::update/$1');
    $routes->delete('wards/(:num)', 'WardController::delete/$1');

    // Medical Record routes
    $routes->get('medical-records', 'MedicalRecordController::index');
    $routes->get('medical-records/patient/(:num)', 'MedicalRecordController::patientHistory/$1');
    $routes->get('medical-records/(:num)', 'MedicalRecordController::show/$1');
    $routes->post('medical-records', 'MedicalRecordController::create');
    $routes->put('medical-records/(:num)', 'MedicalRecordController::update/$1');
    $routes->delete('medical-records/(:num)', 'MedicalRecordController::delete/$1');

    // Prescription routes
    $routes->get('prescriptions', 'PrescriptionController::index');
    $routes->get('prescriptions/active', 'PrescriptionController::active');
    $routes->get('prescriptions/patient/(:num)', 'PrescriptionController::patientPrescriptions/$1');
    $routes->get('prescriptions/(:num)', 'PrescriptionController::show/$1');
    $routes->post('prescriptions', 'PrescriptionController::create');
    $routes->put('prescriptions/(:num)', 'PrescriptionController::update/$1');
    $routes->post('prescriptions/(:num)/complete', 'PrescriptionController::complete/$1');
    $routes->post('prescriptions/(:num)/cancel', 'PrescriptionController::cancel/$1');
    $routes->delete('prescriptions/(:num)', 'PrescriptionController::delete/$1');
});
