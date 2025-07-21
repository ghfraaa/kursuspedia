<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kursus; // Pastikan Anda memiliki model Kursus
use Carbon\Carbon; // Untuk memudahkan penanganan tanggal

class KursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama jika tabel sudah ada untuk menghindari duplikasi
        // Kursus::truncate(); // Gunakan ini jika Anda ingin mengosongkan tabel setiap kali seeder dijalankan

        $kursuses = [
            [
                'id' => 1,
                'nama' => 'Kursus Web Development Dasar',
                'gambar' => '1752745971_IEJuynrUKh.png',
                'kategori' => 'Programming',
                'deskripsi' => 'Pelajari dasar-dasar pemrograman web dengan HTML, CSS, dan JavaScript. Cocok untuk pemula yang ingin memulai karir sebagai web developer.',
                'metode' => 'online',
                'lokasi' => 'tes',
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-09-12',
                'harga' => 750000,
                'sertifikat' => true,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 30,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-19 07:40:51',
            ],
            [
                'id' => 2,
                'nama' => 'Kursus Digital Marketing',
                'gambar' => '1752745989_NspgRzL04m.png',
                'kategori' => 'Marketing',
                'deskripsi' => 'Kuasai strategi pemasaran digital modern termasuk SEO, SEM, social media marketing, dan content marketing untuk meningkatkan bisnis Anda.',
                'metode' => 'hybrid',
                'lokasi' => 'Jakarta',
                'tanggal_mulai' => '2025-08-15',
                'tanggal_selesai' => '2025-10-15',
                'harga' => 1200000,
                'sertifikat' => true,
                'siswa_terdaftar' => 2,
                'jumlah_siswa' => 25,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-19 08:52:52',
            ],
            [
                'id' => 3,
                'nama' => 'Kursus Data Science dengan Python',
                'gambar' => '1752746027_Wbz3efQ8WT.png',
                'kategori' => 'Programming',
                'deskripsi' => 'Belajar analisis data menggunakan Python, pandas, numpy, dan machine learning untuk menjadi data scientist profesional.',
                'metode' => 'online',
                'lokasi' => null,
                'tanggal_mulai' => '2025-09-01',
                'tanggal_selesai' => '2025-11-30',
                'harga' => 2500000,
                'sertifikat' => true,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 20,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-17 00:53:47',
            ],
            [
                'id' => 4,
                'nama' => 'Kursus Bahasa Inggris Conversation',
                'gambar' => '1752746066_RojZ6uOiP2.png',
                'kategori' => 'Language',
                'deskripsi' => 'Tingkatkan kemampuan speaking bahasa Inggris dengan metode conversation interaktif bersama native speaker.',
                'metode' => 'offline',
                'lokasi' => 'Surabaya',
                'tanggal_mulai' => '2025-08-10',
                'tanggal_selesai' => '2025-10-10',
                'harga' => 800000,
                'sertifikat' => true,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 20,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-17 00:54:26',
            ],
            [
                'id' => 5,
                'nama' => 'Kursus Desain Grafis Adobe',
                'gambar' => '1752746103_qF9VZEACK0.png',
                'kategori' => 'Design',
                'deskripsi' => 'Pelajari teknik desain grafis profesional menggunakan Adobe Photoshop, Illustrator, dan InDesign untuk kebutuhan kreatif Anda.',
                'metode' => 'hybrid',
                'lokasi' => 'Bandung',
                'tanggal_mulai' => '2025-08-20',
                'tanggal_selesai' => '2025-10-20',
                'harga' => 1500000,
                'sertifikat' => false,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 15,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-18 04:08:00',
            ],
            [
                'id' => 6,
                'nama' => 'Kursus Mobile App Development',
                'gambar' => 'mobile-app.jpg',
                'kategori' => 'Programming',
                'deskripsi' => 'Buat aplikasi mobile Android dan iOS menggunakan React Native. Dari konsep hingga publish ke app store.',
                'metode' => 'online',
                'lokasi' => null,
                'tanggal_mulai' => '2025-09-15',
                'tanggal_selesai' => '2025-12-15',
                'harga' => 3000000,
                'sertifikat' => true,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 18,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-16 13:57:40',
            ],
            [
                'id' => 7,
                'nama' => 'Kursus Excel Advanced',
                'gambar' => 'excel-advanced.jpg',
                'kategori' => 'Office',
                'deskripsi' => 'Kuasai fitur-fitur advanced Excel seperti pivot table, macro, VBA, dan analisis data untuk meningkatkan produktivitas kerja.',
                'metode' => 'offline',
                'lokasi' => 'Yogyakarta',
                'tanggal_mulai' => '2025-08-05',
                'tanggal_selesai' => '2025-09-05',
                'harga' => 500000,
                'sertifikat' => true,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 25,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-16 13:57:40',
            ],
            [
                'id' => 8,
                'nama' => 'Kursus UI/UX Design',
                'gambar' => 'uiux-design.jpg',
                'kategori' => 'Design',
                'deskripsi' => 'Pelajari prinsip-prinsip UI/UX design menggunakan Figma dan Adobe XD untuk menciptakan pengalaman pengguna yang optimal.',
                'metode' => 'hybrid',
                'lokasi' => 'Medan',
                'tanggal_mulai' => '2025-08-25',
                'tanggal_selesai' => '2025-11-25',
                'harga' => 1800000,
                'sertifikat' => false,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 20,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-16 13:57:40',
            ],
            [
                'id' => 9,
                'nama' => 'Kursus Photography Basic',
                'gambar' => 'photography.jpg',
                'kategori' => 'Photography',
                'deskripsi' => 'Belajar teknik fotografi dasar, komposisi, pencahayaan, dan editing foto untuk menghasilkan karya fotografi yang memukau.',
                'metode' => 'offline',
                'lokasi' => 'Bali',
                'tanggal_mulai' => '2025-09-10',
                'tanggal_selesai' => '2025-10-10',
                'harga' => 1000000,
                'sertifikat' => false,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 25,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-16 13:57:40',
            ],
            [
                'id' => 10,
                'nama' => 'Kursus Accounting & Finance',
                'gambar' => 'accounting.jpg',
                'kategori' => 'Finance',
                'deskripsi' => 'Pahami konsep dasar akuntansi, pembukuan, dan manajemen keuangan untuk bisnis dan kehidupan pribadi.',
                'metode' => 'online',
                'lokasi' => null,
                'tanggal_mulai' => '2025-08-30',
                'tanggal_selesai' => '2025-10-30',
                'harga' => 900000,
                'sertifikat' => true,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 22,
                'created_at' => '2025-07-16 13:57:40',
                'updated_at' => '2025-07-16 13:57:40',
            ],
            [
                'id' => 12,
                'nama' => 'Testing',
                'gambar' => '1752734498_j3kOC9ZG4Y.png',
                'kategori' => 'Programming',
                'deskripsi' => 'testing aja bos',
                'metode' => 'hybrid',
                'lokasi' => 'palu',
                'tanggal_mulai' => '2025-07-17',
                'tanggal_selesai' => '2025-07-31',
                'harga' => 300000,
                'sertifikat' => true,
                'siswa_terdaftar' => 0,
                'jumlah_siswa' => 25,
                'created_at' => '2025-07-16 21:41:39',
                'updated_at' => '2025-07-16 21:41:39',
            ],
        ];

        foreach ($kursuses as $kursusData) {
            // Perhatikan bahwa jika Anda memiliki auto-increment pada 'id',
            // lebih baik biarkan Laravel menanganinya dan hapus 'id' dari array ini
            // atau gunakan firstOrCreate/updateOrCreate jika Anda ingin menjaga ID yang spesifik.
            // Untuk seeder, umumnya kita membiarkan auto-increment bekerja.

            // Jika Anda ingin mempertahankan ID yang sama dengan SQL dump, gunakan ini:
            Kursus::updateOrCreate(
                ['id' => $kursusData['id']], // Kondisi untuk mencari data yang sudah ada
                array_merge(
                    $kursusData,
                    [
                        'created_at' => Carbon::parse($kursusData['created_at']),
                        'updated_at' => Carbon::parse($kursusData['updated_at']),
                    ]
                )
            );
            // Jika Anda ingin membiarkan auto-increment, gunakan ini (hapus 'id' dari $kursusData):
            // Kursus::create(array_merge(
            //     collect($kursusData)->except('id')->toArray(), // Hapus 'id'
            //     [
            //         'created_at' => Carbon::parse($kursusData['created_at']),
            //         'updated_at' => Carbon::parse($kursusData['updated_at']),
            //     ]
            // ));
        }
    }
}