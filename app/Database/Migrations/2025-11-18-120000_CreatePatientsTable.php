<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        // Ensure patients table exists (created by an earlier migration).
        if (! $this->db->tableExists('patients')) {
            $this->forge->addField([
                'patient_id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'first_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'last_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'date_of_birth' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
                'gender' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '50',
                    'null'       => true,
                ],
                'blood_type' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '10',
                    'null'       => true,
                ],
                'phone' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '20',
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                    'null'       => true,
                ],
                'address' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'emergency_contact' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                    'null'       => true,
                ],
                'emergency_phone' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '20',
                    'null'       => true,
                ],
                'medical_history' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'allergies' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '50',
                    'null'       => true,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('patient_id', true);
            $this->forge->createTable('patients');
        }

        // Add deleted_at column for soft deletes if it does not exist.
        if (! $this->db->fieldExists('deleted_at', 'patients')) {
            $this->forge->addColumn('patients', [
                'deleted_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
        }
    }

    public function down()
    {
        // Only drop the deleted_at column if it exists.
        if ($this->db->fieldExists('deleted_at', 'patients')) {
            $this->forge->dropColumn('patients', 'deleted_at');
        }
    }
}
