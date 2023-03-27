<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pemesanan' => [
                'type' => 'VARCHAR',
                'constraint' => '13'
            ],
            'tgl_pemesanan' => [
                'type' => 'DATE'
            ],
            'id_customer' => [
                'type' => 'VARCHAR',
                'constraint' => '8'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Lunas', 'Belum Lunas']
            ],
            'total' => [
                'type' => 'FLOAT'
            ],
            'pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]
        ]);
        $tgl_digunakan = ['tgl_digunakan' => ['type' => 'DATE']];
        $this->forge->addKey('id_pemesanan', TRUE);
        $this->forge->addForeignKey('id_customer', 'Customer', 'id_customer', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Pemesanan');
        $this->forge->addColumn('Pemesanan', $tgl_digunakan);
    }

    public function down()
    {
        $this->forge->dropTable('Pemesanan');
    }
}
