<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'          => 'Mona Saleh',
            'email'         => 'eng.mona20sa@gmail.com',
            'password'      => Hash::make('MonaPortfolio'), // كلمة المرور
            'image'         => 'profile/image.png',
            'location'      => 'Syria-Damascus-Judaydat Artuz',
            'github_link'   => 'https://github.com/eng-MonaSaleh18',
            'linkedin_link' => 'https://www.linkedin.com/in/mona-saleh-950a272b8?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app',
            'phone'         => '+963959929155',
            'telegram_link' => 'https://t.me/eng_mona18sa',
        ]);
    }
}
