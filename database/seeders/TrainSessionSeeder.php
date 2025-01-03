<?php

namespace Database\Seeders;

use App\Models\Classs;
use App\Models\TrainSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data existing sebelum seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TrainSession::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Pastikan classes ada
        $classes = Classs::count() > 0 
            ? Classs::all() 
            : Classs::factory(5)->create();

        // Untuk setiap kelas, buat 5 sesi pelatihan
        foreach ($classes as $class) {
            // Ambil user yang terdaftar pada kelas tersebut
            $usersInClass = User::where('class_id', $class->id)->get();

            // Buat 5 sesi pelatihan untuk setiap kelas
            foreach (range(1, 5) as $index) {
                // Buat sesi pelatihan baru
                $trainSession = TrainSession::factory()->create([
                    'class_id' => $class->id,
                    // Pilih user secara acak dari pengguna yang terdaftar di kelas ini
                    'user_id' => $usersInClass->random()->id,
                ]);

                // Pastikan sesi pelatihan sudah terkait dengan pengguna yang sesuai
                foreach ($usersInClass as $user) {
                    // Tidak perlu menggunakan attach, hanya verifikasi
                    $exists = $user->trainSessions()->where('id', $trainSession->id)->exists();

                    if (!$exists) {
                        // Sudah otomatis terkait pada saat pembuatan TrainSession dengan user_id
                        // Logika tambahan dapat ditambahkan di sini jika diperlukan
                    }
                }
            }
        }
    }
}
