<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'                => 'Amoxicillin 500mg',
                'sku'                 => 'MED-001',
                'batch_number'        => 'BATCH-2024-001',
                'expiry_date'         => date('Y-m-d', strtotime('+2 years')),
                'supplier'            => 'PharmaCorp Inc.',
                'purchase_price'      => 5.50,
                'sale_price'          => 12.00,
                'stock_quantity'      => 500,
                'min_stock_threshold' => 50,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'name'                => 'Ibuprofen 400mg',
                'sku'                 => 'MED-002',
                'batch_number'        => 'BATCH-2024-002',
                'expiry_date'         => date('Y-m-d', strtotime('+18 months')),
                'supplier'            => 'MediSupply Ltd.',
                'purchase_price'      => 3.00,
                'sale_price'          => 8.00,
                'stock_quantity'      => 750,
                'min_stock_threshold' => 100,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'name'                => 'Paracetamol 500mg',
                'sku'                 => 'MED-003',
                'batch_number'        => 'BATCH-2024-003',
                'expiry_date'         => date('Y-m-d', strtotime('+1 year')),
                'supplier'            => 'HealthMeds Co.',
                'purchase_price'      => 2.50,
                'sale_price'          => 6.00,
                'stock_quantity'      => 1000,
                'min_stock_threshold' => 150,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'name'                => 'Omeprazole 20mg',
                'sku'                 => 'MED-004',
                'batch_number'        => 'BATCH-2024-004',
                'expiry_date'         => date('Y-m-d', strtotime('+15 months')),
                'supplier'            => 'PharmaCorp Inc.',
                'purchase_price'      => 8.00,
                'sale_price'          => 18.00,
                'stock_quantity'      => 300,
                'min_stock_threshold' => 40,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'name'                => 'Metformin 850mg',
                'sku'                 => 'MED-005',
                'batch_number'        => 'BATCH-2024-005',
                'expiry_date'         => date('Y-m-d', strtotime('+2 years')),
                'supplier'            => 'DiabetesCare Pharma',
                'purchase_price'      => 6.00,
                'sale_price'          => 14.00,
                'stock_quantity'      => 400,
                'min_stock_threshold' => 60,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'name'                => 'Aspirin 100mg',
                'sku'                 => 'MED-006',
                'batch_number'        => 'BATCH-2024-006',
                'expiry_date'         => date('Y-m-d', strtotime('+6 months')),
                'supplier'            => 'CardioMeds Ltd.',
                'purchase_price'      => 1.50,
                'sale_price'          => 4.00,
                'stock_quantity'      => 25,
                'min_stock_threshold' => 50,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'name'                => 'Cetirizine 10mg',
                'sku'                 => 'MED-007',
                'batch_number'        => 'BATCH-2024-007',
                'expiry_date'         => date('Y-m-d', strtotime('+1 year')),
                'supplier'            => 'AllergyRelief Inc.',
                'purchase_price'      => 4.00,
                'sale_price'          => 10.00,
                'stock_quantity'      => 600,
                'min_stock_threshold' => 80,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'name'                => 'Lisinopril 10mg',
                'sku'                 => 'MED-008',
                'batch_number'        => 'BATCH-2024-008',
                'expiry_date'         => date('Y-m-d', strtotime('+20 months')),
                'supplier'            => 'CardioMeds Ltd.',
                'purchase_price'      => 7.00,
                'sale_price'          => 16.00,
                'stock_quantity'      => 350,
                'min_stock_threshold' => 50,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('medicines')->insertBatch($data);
    }
}
