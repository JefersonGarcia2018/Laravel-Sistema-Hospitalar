<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'José da Silva Souza',
            'email' => 'analista_rh@gmail.com',
            'cpf' => '029.869.250-30',
            'celular' => '(11)99977-2222',
            'rh' => '1',
            'setor' => 'RH',
            'cargo' => 'Analista de RH',
            'password' => Hash::make('12345678'),
        ]);
    }
}
