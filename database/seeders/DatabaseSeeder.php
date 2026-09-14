<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::query()->updateOrCreate(
            ['email' => 'publisher@afya-mtandaoni.test'],
            [
                'name' => 'Main Publisher',
                'role' => 'publisher',
                'password' => Hash::make('publisher123'),
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'admin@afya-mtandaoni.test'],
            [
                'name' => 'Security Administrator',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        $this->call(WonderfulArticlesSeeder::class);
        $this->call(WonderfulHealthNewsSeeder::class);
    }
}
