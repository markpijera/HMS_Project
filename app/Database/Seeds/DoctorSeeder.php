<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'first_name'       => 'John',
                'last_name'        => 'Smith',
                'specialization'   => 'Cardiology',
                'license_number'   => 'DOC-2024-001',
                'phone'            => '555-0101',
                'email'            => 'john.smith@hospital.com',
                'department'       => 'Cardiology',
                'qualification'    => 'MD, FACC',
                'experience_years' => 15,
                'consultation_fee' => 150.00,
                'available_days'   => 'Monday,Tuesday,Wednesday,Thursday,Friday',
                'available_hours'  => '09:00-17:00',
                'status'           => 'active',
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'       => 'Sarah',
                'last_name'        => 'Johnson',
                'specialization'   => 'Pediatrics',
                'license_number'   => 'DOC-2024-002',
                'phone'            => '555-0102',
                'email'            => 'sarah.johnson@hospital.com',
                'department'       => 'Pediatrics',
                'qualification'    => 'MD, FAAP',
                'experience_years' => 12,
                'consultation_fee' => 120.00,
                'available_days'   => 'Monday,Wednesday,Friday',
                'available_hours'  => '08:00-16:00',
                'status'           => 'active',
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'       => 'Michael',
                'last_name'        => 'Chen',
                'specialization'   => 'Orthopedics',
                'license_number'   => 'DOC-2024-003',
                'phone'            => '555-0103',
                'email'            => 'michael.chen@hospital.com',
                'department'       => 'Orthopedics',
                'qualification'    => 'MD, FAAOS',
                'experience_years' => 18,
                'consultation_fee' => 175.00,
                'available_days'   => 'Tuesday,Thursday,Saturday',
                'available_hours'  => '10:00-18:00',
                'status'           => 'active',
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'       => 'Emily',
                'last_name'        => 'Rodriguez',
                'specialization'   => 'Dermatology',
                'license_number'   => 'DOC-2024-004',
                'phone'            => '555-0104',
                'email'            => 'emily.rodriguez@hospital.com',
                'department'       => 'Dermatology',
                'qualification'    => 'MD, FAAD',
                'experience_years' => 10,
                'consultation_fee' => 130.00,
                'available_days'   => 'Monday,Tuesday,Thursday,Friday',
                'available_hours'  => '09:00-17:00',
                'status'           => 'active',
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'       => 'David',
                'last_name'        => 'Williams',
                'specialization'   => 'Neurology',
                'license_number'   => 'DOC-2024-005',
                'phone'            => '555-0105',
                'email'            => 'david.williams@hospital.com',
                'department'       => 'Neurology',
                'qualification'    => 'MD, PhD, FAAN',
                'experience_years' => 20,
                'consultation_fee' => 200.00,
                'available_days'   => 'Monday,Wednesday,Friday',
                'available_hours'  => '08:00-16:00',
                'status'           => 'active',
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('doctors')->insertBatch($data);
    }
}
