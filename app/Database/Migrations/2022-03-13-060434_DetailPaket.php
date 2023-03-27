<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailPaket extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detailpaket' => [
                'type' => ' INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_paket' => [
                'type' => 'VARCHAR',
                'constraint' => '7'
            ],
            'id_menu' => [
                'type' => 'VARCHAR',
                'constraint' => '8'
            ]
        ]);

        $this->forge->addKey('id_detailpaket', TRUE);
        $this->forge->addForeignKey('id_menu', 'Menu', 'id_menu', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_paket', 'Paket', 'id_paket', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Detail_Paket');
    }

    public function down()
    {
        $this->forge->dropTable('Detail_Order');
    }
}
