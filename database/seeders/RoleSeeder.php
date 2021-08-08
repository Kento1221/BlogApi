<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = now()->toDateTimeString();
        $roles = [
            ['id' => Role::IS_ADMIN, 'name' => 'admin', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => Role::IS_USER, 'name' => 'user', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => Role::IS_WRITER, 'name' => 'writer', 'created_at' => $timestamp, 'updated_at' => $timestamp]
        ];

        Role::insert($roles);
    }
}
