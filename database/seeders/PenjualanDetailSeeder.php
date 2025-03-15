<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'barang_id' => 1, 'harga' => 7000000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 1, 'barang_id' => 2, 'harga' => 4500000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 1, 'barang_id' => 3, 'harga' => 150000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 2, 'barang_id' => 4, 'harga' => 300000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 2, 'barang_id' => 5, 'harga' => 5000, 'jumlah' => 3, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 2, 'barang_id' => 6, 'harga' => 10000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 3, 'barang_id' => 1, 'harga' => 7000000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 3, 'barang_id' => 3, 'harga' => 150000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 3, 'barang_id' => 4, 'harga' => 300000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 4, 'barang_id' => 2, 'harga' => 4500000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 4, 'barang_id' => 5, 'harga' => 5000, 'jumlah' => 5, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 4, 'barang_id' => 6, 'harga' => 10000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 5, 'barang_id' => 3, 'harga' => 150000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 5, 'barang_id' => 4, 'harga' => 300000, 'jumlah' => 3, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 5, 'barang_id' => 1, 'harga' => 7000000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 6, 'barang_id' => 2, 'harga' => 4500000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 6, 'barang_id' => 5, 'harga' => 5000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 6, 'barang_id' => 6, 'harga' => 10000, 'jumlah' => 4, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 7, 'barang_id' => 1, 'harga' => 7000000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 7, 'barang_id' => 2, 'harga' => 4500000, 'jumlah' => 3, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 7, 'barang_id' => 3, 'harga' => 150000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 8, 'barang_id' => 4, 'harga' => 300000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 8, 'barang_id' => 5, 'harga' => 5000, 'jumlah' => 4, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 8, 'barang_id' => 6, 'harga' => 10000, 'jumlah' => 3, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 9, 'barang_id' => 1, 'harga' => 7000000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 9, 'barang_id' => 3, 'harga' => 150000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 9, 'barang_id' => 5, 'harga' => 5000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],

            ['penjualan_id' => 10, 'barang_id' => 2, 'harga' => 4500000, 'jumlah' => 1, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 10, 'barang_id' => 4, 'harga' => 300000, 'jumlah' => 2, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
            ['penjualan_id' => 10, 'barang_id' => 6, 'harga' => 10000, 'jumlah' => 3, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => null],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
