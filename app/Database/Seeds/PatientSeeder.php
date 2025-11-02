<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'first_name'        => 'James',
                'last_name'         => 'Anderson',
                'date_of_birth'     => '1985-03-15',
                'gender'            => 'Male',
                'blood_type'        => 'O+',
                'phone'             => '555-1001',
                'email'             => 'james.anderson@email.com',
                'address'           => '123 Main St, City, State 12345',
                'emergency_contact' => 'Mary Anderson',
                'emergency_phone'   => '555-1002',
                'medical_history'   => 'Hypertension, Diabetes Type 2',
                'allergies'         => 'Penicillin',
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'        => 'Lisa',
                'last_name'         => 'Martinez',
                'date_of_birth'     => '1992-07-22',
                'gender'            => 'Female',
                'blood_type'        => 'A+',
                'phone'             => '555-1003',
                'email'             => 'lisa.martinez@email.com',
                'address'           => '456 Oak Ave, City, State 12345',
                'emergency_contact' => 'Carlos Martinez',
                'emergency_phone'   => '555-1004',
                'medical_history'   => 'Asthma',
                'allergies'         => 'Pollen, Dust',
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'        => 'Robert',
                'last_name'         => 'Taylor',
                'date_of_birth'     => '1978-11-08',
                'gender'            => 'Male',
                'blood_type'        => 'B+',
                'phone'             => '555-1005',
                'email'             => 'robert.taylor@email.com',
                'address'           => '789 Pine Rd, City, State 12345',
                'emergency_contact' => 'Jennifer Taylor',
                'emergency_phone'   => '555-1006',
                'medical_history'   => 'High Cholesterol',
                'allergies'         => 'None',
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'        => 'Amanda',
                'last_name'         => 'Brown',
                'date_of_birth'     => '1995-05-30',
                'gender'            => 'Female',
                'blood_type'        => 'AB+',
                'phone'             => '555-1007',
                'email'             => 'amanda.brown@email.com',
                'address'           => '321 Elm St, City, State 12345',
                'emergency_contact' => 'Thomas Brown',
                'emergency_phone'   => '555-1008',
                'medical_history'   => 'Migraine',
                'allergies'         => 'Shellfish',
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'        => 'Christopher',
                'last_name'         => 'Davis',
                'date_of_birth'     => '1988-09-12',
                'gender'            => 'Male',
                'blood_type'        => 'O-',
                'phone'             => '555-1009',
                'email'             => 'chris.davis@email.com',
                'address'           => '654 Maple Dr, City, State 12345',
                'emergency_contact' => 'Sarah Davis',
                'emergency_phone'   => '555-1010',
                'medical_history'   => 'None',
                'allergies'         => 'Latex',
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('patients')->insertBatch($data);
    }
}
