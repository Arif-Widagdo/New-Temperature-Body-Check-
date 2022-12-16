<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Position::factory()->create([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Admin',
            'slug' => 'admin',
            'status' => 1,
        ]);
        \App\Models\Position::factory()->create([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Marketing',
            'slug' => 'marketing',
            'status' => 1,
        ]);

        \App\Models\Position::factory()->create([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Akuntan',
            'slug' => 'akuntan',
            'status' => 1,
        ]);

        \App\Models\Position::factory()->create([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Human Resource',
            'slug' => 'human-resource',
            'status' => 1,
        ]);


        $positions = \App\Models\Position::all();

        foreach ($positions as $position) {
            \App\Models\User::factory()->create([
                'id' => Uuid::uuid4()->toString(),
                'id_position' => $position->id,
                'name' => $position->name . 'Pengguna',
                'email' => $position->name . '@example.com',
                'status' => 'actived',
                'gender' => 'M',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
