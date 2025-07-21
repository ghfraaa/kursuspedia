<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review; // Pastikan Anda memiliki model Review
use Carbon\Carbon; // Untuk memudahkan penanganan tanggal dan waktu

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama jika tabel sudah ada untuk menghindari duplikasi
        // Review::truncate(); // Gunakan ini jika Anda ingin mengosongkan tabel setiap kali seeder dijalankan

        $reviews = [
            [
                'id' => 1,
                'user_id' => 3,
                'kursus_id' => 2,
                'rating' => 3,
                'komentar' => 'lumayan',
                'created_at' => '2025-07-19 07:23:54',
                'updated_at' => '2025-07-19 07:23:54',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'kursus_id' => 2,
                'rating' => 5,
                'komentar' => 'loremipsum dolor sit amet penereus lorem ipsum dolor sit amet',
                'created_at' => '2025-07-19 15:33:50',
                'updated_at' => '2025-07-19 15:33:50',
            ],
            [
                'id' => 4,
                'user_id' => 4,
                'kursus_id' => 1,
                'rating' => 4,
                'komentar' => 'bagus',
                'created_at' => '2025-07-20 02:08:43',
                'updated_at' => '2025-07-20 02:08:43',
            ],
            [
                'id' => 5,
                'user_id' => 4,
                'kursus_id' => 2,
                'rating' => 5,
                'komentar' => 'bagus',
                'created_at' => '2025-07-20 02:08:43',
                'updated_at' => '2025-07-20 02:08:43',
            ],
            [
                'id' => 6,
                'user_id' => 4,
                'kursus_id' => 3,
                'rating' => 4,
                'komentar' => 'lumayan',
                'created_at' => '2025-07-20 02:08:43',
                'updated_at' => '2025-07-20 02:08:43',
            ],
            [
                'id' => 7,
                'user_id' => 4,
                'kursus_id' => 4,
                'rating' => 5,
                'komentar' => 'mayan',
                'created_at' => '2025-07-20 02:08:43',
                'updated_at' => '2025-07-20 02:08:43',
            ],
        ];

        foreach ($reviews as $reviewData) {
            // Gunakan updateOrCreate untuk memastikan ID yang spesifik atau membuat data baru
            Review::updateOrCreate(
                ['id' => $reviewData['id']], // Kondisi untuk mencari data yang sudah ada
                array_merge(
                    $reviewData,
                    [
                        'created_at' => Carbon::parse($reviewData['created_at']), // Mengonversi string ke objek Carbon
                        'updated_at' => Carbon::parse($reviewData['updated_at']), // Mengonversi string ke objek Carbon
                    ]
                )
            );
            // Alternatif jika Anda ingin membiarkan auto-increment (hapus 'id' dari $reviewData):
            // Review::create(array_merge(
            //     collect($reviewData)->except('id')->toArray(), // Hapus 'id'
            //     [
            //         'created_at' => Carbon::parse($reviewData['created_at']),
            //         'updated_at' => Carbon::parse($reviewData['updated_at']),
            //     ]
            // ));
        }
    }
}