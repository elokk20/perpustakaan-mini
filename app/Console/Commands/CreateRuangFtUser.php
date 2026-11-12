<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateRuangFtUser extends Command
{
    protected $signature = 'ruangft:akun-buat';

    protected $description = 'Buat akun pengguna RuangFT. secara aman melalui terminal';

    public function handle(): int
    {
        $nama = trim((string) $this->ask('Nama pengguna'));
        $email = strtolower(trim((string) $this->ask('Email')));
        $password = (string) $this->secret('Kata sandi (minimal 8 karakter, huruf besar/kecil, angka)');
        $konfirmasi = (string) $this->secret('Konfirmasi kata sandi');

        $input = [
            'name' => $nama,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $konfirmasi,
        ];

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ], [
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sama.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return self::FAILURE;
        }

        User::create([
            'name' => $nama,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info('Akun RuangFT. berhasil dibuat. Silakan login pada /login.');

        return self::SUCCESS;
    }
}
