<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Mohamad Asep Saepulloh',
                'username' => 'asep30',
                'password' => Hash::make('asep3003'),
                'telp' => '083811691729',
                'level' => 'Admin',
            ],
            [
                'nama' => 'Muhamad Ramdhani Akbar',
                'username' => 'akbar',
                'password' => Hash::make('akbar'),
                'telp' => '083811655736',
                'level' => 'Petugas',
            ]
        ];
        Petugas::insert($data);
    }
}
