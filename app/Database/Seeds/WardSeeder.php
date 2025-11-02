<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WardSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'           => 'General Ward A',
                'floor'          => 1,
                'department'     => 'General Medicine',
                'total_beds'     => 20,
                'available_beds' => 15,
                'ward_type'      => 'general',
                'status'         => 'active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'General Ward B',
                'floor'          => 1,
                'department'     => 'General Medicine',
                'total_beds'     => 20,
                'available_beds' => 18,
                'ward_type'      => 'general',
                'status'         => 'active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'ICU Ward',
                'floor'          => 2,
                'department'     => 'Critical Care',
                'total_beds'     => 10,
                'available_beds' => 3,
                'ward_type'      => 'icu',
                'status'         => 'active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Private Ward A',
                'floor'          => 3,
                'department'     => 'VIP Services',
                'total_beds'     => 15,
                'available_beds' => 12,
                'ward_type'      => 'private',
                'status'         => 'active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Emergency Ward',
                'floor'          => 0,
                'department'     => 'Emergency',
                'total_beds'     => 25,
                'available_beds' => 20,
                'ward_type'      => 'emergency',
                'status'         => 'active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Pediatric Ward',
                'floor'          => 2,
                'department'     => 'Pediatrics',
                'total_beds'     => 18,
                'available_beds' => 14,
                'ward_type'      => 'general',
                'status'         => 'active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('wards')->insertBatch($data);
    }
}
