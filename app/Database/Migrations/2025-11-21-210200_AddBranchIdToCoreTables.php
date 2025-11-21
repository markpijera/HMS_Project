<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBranchIdToCoreTables extends Migration
{
    public function up()
    {
        $fields = [
            'branch_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ];

        $tables = [
            'patients',
            'doctors',
            'appointments',
            'admissions',
            'medicines',
            'invoices',
            'medical_records',
            'prescriptions',
            'lab_tests',
        ];

        foreach ($tables as $table) {
            if (! $this->db->fieldExists('branch_id', $table)) {
                $this->forge->addColumn($table, $fields);
            }
        }

        if ($this->db->DBDriver === 'MySQLi') {
            foreach ($tables as $table) {
                $this->db->query("ALTER TABLE `{$table}` ADD CONSTRAINT `fk_{$table}_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branches`(`id`) ON DELETE SET NULL ON UPDATE CASCADE");
            }
        }
    }

    public function down()
    {
        $tables = [
            'patients',
            'doctors',
            'appointments',
            'admissions',
            'medicines',
            'invoices',
            'medical_records',
            'prescriptions',
            'lab_tests',
        ];

        foreach ($tables as $table) {
            if ($this->db->DBDriver === 'MySQLi') {
                $this->db->query("ALTER TABLE `{$table}` DROP FOREIGN KEY `fk_{$table}_branch_id`");
            }

            if ($this->db->fieldExists('branch_id', $table)) {
                $this->forge->dropColumn($table, 'branch_id');
            }
        }
    }
}
