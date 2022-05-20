<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
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
        /*DB::table('client_statuses')->insert([
            'status' => 'янги',]);
        DB::table('client_statuses')->insert([
            'status' => 'тажрибали',]);
        DB::table('client_statuses')->insert([
            'status' => 'Доимий',]);
        DB::table('client_statuses')->insert([
            'status' => 'Замованый',]);
        DB::table('client_statuses')->insert([
            'status' => 'Хайотий',]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'comp@biznes.uz',
            'password' => Hash::make('Admin2022'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'email_verified_at' => now(),
        ]);
        DB::table('questions')->insert([
            'question' => '<b>Исмингизни киритинг?</b>',
        ]);
        DB::table('questions')->insert([
            'question' => '<b>Фамилиянгизни киритинг?</b>',
        ]);
        DB::table('questions')->insert([
            'question' => '<b>Сиз билан богланиш учун ракамингизни киритинг?</b>',
        ]);
        DB::table('questions')->insert([
            'question' => '<b>Табриклайми сиз руйхатдан утдингиз!</b>',
        ]);*/
        DB::table('users')->insert([
            'role_id' => 2,
            'name' => "Baby",
            'email' => "Baby@smm.uz",
            'password' => Hash::make('Baby2022'),
            'customer_id' => 1,

        ]);
        DB::table('customers')->insert([
            'id' => 1,
            'name' => "saidbek",
            'adress' => "Андижон ш. Бобуршох кучаси 1-уй",
            'location' => "location",
            'number' => "+998934272711",

        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role' => 'customer',]);

    }
}
