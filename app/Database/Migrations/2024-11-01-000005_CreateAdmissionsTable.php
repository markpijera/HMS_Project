<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdmissionsTable extends Migration
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
            'admitted_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'assigned_doctor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'ward_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'room_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'bed_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'admission_date' => [
                'type' => 'DATETIME',
            ],
            'discharge_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['admitted', 'discharged', 'transferred'],
                'default'    => 'admitted',
            ],
            'notes' => [
                'type' => 'TEXT',
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
        $this->forge->addForeignKey('assigned_doctor_id', 'doctors', 'doctor_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('admissions');
    }

    public function down()
    {
        $this->forge->dropTable('admissions');
    }
}
