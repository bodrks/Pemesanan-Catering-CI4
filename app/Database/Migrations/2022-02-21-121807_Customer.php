<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_customer' => [
                'type' => 'VARCHAR',
                'constraint' => '8'
            ],
            'nama_customer' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '13'
            ],
            'foto' => [
                'type' => 'TEXT'
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '15'
            ]
        ]);
        $this->forge->addKey('id_customer', TRUE);
        $this->forge->createTable('Customer');
    }

    public function down()
    {
        $this->forge->dropTable('Customer');
    }
}
