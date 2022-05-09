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
        DB::table('roles')->insert([
            'role' => 'admin',]);*/
        DB::table('users')->insert([
            'name' => 'admin',
            'login' => 'comp@biznes.uz',
            'password' => Hash::make('Admin2022'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'email_verified_at' => now(),
        ]);
    }
}
