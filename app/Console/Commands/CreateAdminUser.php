<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    protected $signature = 'app:create-admin';
    protected $description = 'Membuat user admin baru';

    public function handle()
    {
        $name = $this->ask('Masukkan nama untuk admin:');
        $email = $this->ask('Masukkan email untuk admin:');
        $password = $this->secret('Masukkan password untuk admin:');

        // Validasi input
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $this->info('Gagal membuat admin. Lihat error di bawah:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // Buat user dengan role 'polres'
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'superadmin', // Langsung set sebagai admin
        ]);

        $this->info('User admin berhasil dibuat!');
        return 0;
    }
}
