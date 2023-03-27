<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailOrder extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detailpemesanan' => [
                'type' => 'VARCHAR',
                'constraint' => '15'
            ],
            'id_pemesanan' => [
                'type' => 'VARCHAR',
                'constraint' => '13'
            ],
            'id_paket' => [
                'type' => 'VARCHAR',
                'constraint' => '7'
            ],
            'qty' => [
                'type' => 'INT'
            ],
            'sub_total' => [
                'type' => 'FLOAT'
            ]
        ]);
        $this->forge->addKey('id_detailpemesanan', TRUE);
        $this->forge->addForeignKey('id_pemesanan', 'Pemesanan', 'id_pemesanan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_paket', 'Paket', 'id_paket', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Detail_pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('Detail_pemesanan');
    }
}
