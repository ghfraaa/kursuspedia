<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction; // Pastikan Anda memiliki model Transaction
use Carbon\Carbon; // Untuk memudahkan penanganan tanggal dan waktu

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama jika tabel sudah ada untuk menghindari duplikasi
        // Transaction::truncate(); // Gunakan ini jika Anda ingin mengosongkan tabel setiap kali seeder dijalankan

        $transactions = [
            [
                'id' => 1,
                'user_id' => 3,
                'kursus_id' => 2,
                'amount' => 1200000.00,
                'status' => 'diterima',
                'payment_proof' => 'payment_proofs/lJgTPfsaGqhIKdCeOtLBz7qqoN7O4EKqYZUQLl7v.png',
                'created_at' => '2025-07-16 23:36:37',
                'updated_at' => '2025-07-17 02:18:48',
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'kursus_id' => 2,
                'amount' => 1200000.00,
                'status' => 'diterima',
                'payment_proof' => 'payment_proofs/e3LF3zVy7wLoz9OtiwYEvyPf8TQgetxcsF69ehtU.png',
                'created_at' => '2025-07-17 02:22:54',
                'updated_at' => '2025-07-19 08:52:52',
            ],
            [
                'id' => 5,
                'user_id' => 3,
                'kursus_id' => 5,
                'amount' => 1500000.00,
                'status' => 'pending',
                'payment_proof' => 'payment_proofs/w2XNVWiNUq22D4qTfijf54AcoqFgNzxJr7OCpMky.png',
                'created_at' => '2025-07-18 04:04:02',
                'updated_at' => '2025-07-18 04:22:01',
            ],
            [
                'id' => 6,
                'user_id' => 3,
                'kursus_id' => 1,
                'amount' => 750000.00,
                'status' => 'belum_dibayar',
                'payment_proof' => null,
                'created_at' => '2025-07-18 22:57:16',
                'updated_at' => '2025-07-18 22:57:16',
            ],
            [
                'id' => 7,
                'user_id' => 2,
                'kursus_id' => 1,
                'amount' => 750000.00,
                'status' => 'belum_dibayar',
                'payment_proof' => null,
                'created_at' => '2025-07-19 07:39:41',
                'updated_at' => '2025-07-19 07:40:51',
            ],
            [
                'id' => 8,
                'user_id' => 2,
                'kursus_id' => 12,
                'amount' => 300000.00,
                'status' => 'pending',
                'payment_proof' => 'payment_proofs/AzKmtgMWRfcm1hi1okhFQ05Y96FNBb1Sl6UI4C4A.png',
                'created_at' => '2025-07-19 07:42:57',
                'updated_at' => '2025-07-19 07:43:58',
            ],
        ];

        foreach ($transactions as $transactionData) {
            // Gunakan updateOrCreate untuk memastikan ID yang spesifik atau membuat data baru
            Transaction::updateOrCreate(
                ['id' => $transactionData['id']], // Kondisi untuk mencari data yang sudah ada
                array_merge(
                    $transactionData,
                    [
                        'created_at' => Carbon::parse($transactionData['created_at']), // Mengonversi string ke objek Carbon
                        'updated_at' => Carbon::parse($transactionData['updated_at']), // Mengonversi string ke objek Carbon
                    ]
                )
            );
            // Alternatif jika Anda ingin membiarkan auto-increment (hapus 'id' dari $transactionData):
            // Transaction::create(array_merge(
            //     collect($transactionData)->except('id')->toArray(), // Hapus 'id'
            //     [
            //         'created_at' => Carbon::parse($transactionData['created_at']),
            //         'updated_at' => Carbon::parse($transactionData['updated_at']),
            //     ]
            // ));
        }
    }
}