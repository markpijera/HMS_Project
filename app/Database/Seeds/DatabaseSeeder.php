<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Doctors
        $this->call('DoctorSeeder');
        
        // Seed Patients
        $this->call('PatientSeeder');
        
        // Seed Medicines
        $this->call('MedicineSeeder');
    }
}
