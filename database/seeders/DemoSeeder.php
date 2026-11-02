<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment('local', 'testing')) {
            throw new \RuntimeException('Data demo hanya boleh dibuat di lingkungan lokal atau testing.');
        }
        User::factory()->count(5)->create()->each(function (User $user): void {
            foreach (['pending', 'proses', 'selesai'] as $status) {
                Laporan::factory()->for($user, 'pelapor')->create(['status' => $status]);
            }
        });
    }
}