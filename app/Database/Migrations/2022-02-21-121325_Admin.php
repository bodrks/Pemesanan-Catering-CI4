<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '15'
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '15'
            ],
            'nama_admin' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '13'
            ]
        ]);
        $this->forge->addKey('username', TRUE);
        $this->forge->createTable('Admin');
    }

    public function down()
    {
        $this->forge->dropTable('Admin');
    }
}
