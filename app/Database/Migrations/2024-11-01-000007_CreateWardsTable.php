<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWardsTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'floor' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'department' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'total_beds' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
            ],
            'available_beds' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
            ],
            'ward_type' => [
                'type'       => 'ENUM',
                'constraint' => ['general', 'private', 'icu', 'emergency'],
                'default'    => 'general',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'maintenance'],
                'default'    => 'active',
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
        $this->forge->createTable('wards');
    }

    public function down()
    {
        $this->forge->dropTable('wards');
    }
}
