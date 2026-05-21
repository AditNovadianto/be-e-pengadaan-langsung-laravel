<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Sistem;
use App\Models\Role;
use App\Models\User;
use App\Models\Penyedia;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the required Sistem and Role exist (or create them)
        $sistem = Sistem::firstOrCreate([
            'nama_sistem' => 'E-Pengadaan',
        ], [
            'status_sistem' => 'ACTIVE',
        ]);

        $role = Role::firstOrCreate([
            'nama_role' => 'Admin',
        ]);

        // -------------------------------------------------
        // Panitia / User (account used for login as "user")
        // -------------------------------------------------
        User::firstOrCreate(
            [
                'email_user' => 'panitia@test.com',
            ],
            [
                'nama_user'   => 'Panitia Lelang',
                'password_user' => Hash::make('password123'),
                'status_user' => 'ACTIVE',
                'id_sistem'    => $sistem->id_sistem,
                'id_role'      => $role->id_role,
            ]
        );

        // -------------------------------------------------
        // Vendor / Penyedia (account used for login as "penyedia")
        // -------------------------------------------------
        Penyedia::firstOrCreate(
            [
                'email_penyedia' => 'makmur@test.com',
            ],
            [
                'nama_perusahaan' => 'PT Makmur Jaya',
                'password_penyedia'=> Hash::make('password123'),
                'nib'              => '1234567890',
                'id_sistem'        => $sistem->id_sistem,
            ]
        );
    }
}