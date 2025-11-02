<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// API Routes
$routes->group('api/v1', ['namespace' => 'App\Controllers\Api'], function($routes) {
    // Patient routes
    $routes->get('patients', 'PatientController::index');
    $routes->get('patients/(:num)', 'PatientController::show/$1');
    $routes->post('patients', 'PatientController::create');
    $routes->put('patients/(:num)', 'PatientController::update/$1');
    $routes->delete('patients/(:num)', 'PatientController::delete/$1');

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
});
