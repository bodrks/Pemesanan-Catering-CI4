<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_menu' => [
                'type' => 'VARCHAR',
                'constraint' => '8'
            ],
            'nama_menu' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'gambar' => [
                'type' => 'TEXT'
            ],
            'deskripsi' => [
                'type' => 'TEXT'
            ],
            'id_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => '5'
            ]
        ]);
        $this->forge->addKey('id_menu', TRUE);
        $this->forge->addForeignKey('id_kategori', 'Kategori', 'id_kategori', 'NO ACTION', 'NO ACTION');
        $this->forge->createTable('Menu');
    }

    public function down()
    {
        $this->forge->dropTable('Menu');
    }
}
