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
});
