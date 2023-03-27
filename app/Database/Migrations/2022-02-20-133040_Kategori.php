<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => '5'
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ]
        ]);
        $this->forge->addKey('id_kategori', TRUE);
        $this->forge->createTable('Kategori');
    }

    public function down()
    {
        $this->forge->dropTable('Kategori');
    }
}
