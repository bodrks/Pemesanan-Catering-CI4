<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paket extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_paket' => [
                'type' => 'VARCHAR',
                'constraint' => '7'
            ],
            'nama_paket' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'harga' => [
                'type' => 'FLOAT'
            ],
            'deskripsi' => [
                'type' => 'TEXT'
            ],
        ]);
        $gambar = ['gambar' => ['type' => 'TEXT']];
        $this->forge->addKey('id_paket', TRUE);
        $this->forge->createTable('Paket');
        $this->forge->addColumn('Paket', $gambar);
    }

    public function down()
    {
        $this->forge->dropTable('Paket');
    }
}
