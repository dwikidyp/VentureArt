<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedUsers();
        $this->callSeeders();
    }

    private function seedUsers(): void{
        if(!user::where('email', 'admin@admin.com')->exists()) {
            $users = User::factory()->createMany([
                [
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'password' => bcrypt('password'),
                ],
                [
                    'name' => 'Pengguna1',
                    'email' => 'pengguna1@gmail.com',
                    'password' => bcrypt('password'),
                ]
            ]);
        
        foreach ($users as $user) {
            if($user->email=='admin@admin.com'){
                $user->assignRole('super_admin');
            }
        }
        }
    }

    private function callSeeders(): void{
        $this->call([
            RoleSeeder::class,
            KaryaseniSeeder::class,
            KursustutorialSeeder::class,
            EventkompetisiSeeder::class
        ]);
    }
}
