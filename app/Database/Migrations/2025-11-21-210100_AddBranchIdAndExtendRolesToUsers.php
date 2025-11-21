<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBranchIdAndExtendRolesToUsers extends Migration
{
    public function up()
    {
        // Add branch_id column
        $this->forge->addColumn('users', [
            'branch_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'role',
            ],
        ]);

        // Note: Changing ENUM values in a migration depends on the DB driver.
        // Here we alter the column to include additional roles.
        $this->db->query("ALTER TABLE `users` MODIFY `role` ENUM('admin','doctor','nurse','receptionist','pharmacist','lab','accountant','it') NOT NULL DEFAULT 'receptionist'");
    }

    public function down()
    {
        // Revert role enum to original
        $this->db->query("ALTER TABLE `users` MODIFY `role` ENUM('admin','doctor','nurse','receptionist','pharmacist') NOT NULL DEFAULT 'receptionist'");

        // Drop branch_id column
        $this->forge->dropColumn('users', 'branch_id');
    }
}
