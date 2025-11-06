<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMedicalRecordsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'patient_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'doctor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'appointment_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'admission_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'visit_date' => [
                'type' => 'DATE',
            ],
            'diagnosis' => [
                'type' => 'TEXT',
            ],
            'symptoms' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'treatment' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'prescription' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'follow_up_date' => [
                'type' => 'DATE',
                'null' => true,
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

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('patient_id', 'patients', 'patient_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('doctor_id', 'doctors', 'doctor_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('appointment_id', 'appointments', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('admission_id', 'admissions', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('medical_records');
    }

    public function down()
    {
        $this->forge->dropTable('medical_records');
    }
}
