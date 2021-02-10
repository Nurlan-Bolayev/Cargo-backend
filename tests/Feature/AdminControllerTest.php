<?php

namespace Tests\Feature;

use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    public function test_admin_logs_in()
    {
        $email = 'n@mail.com';
        $password = 'nnn111';

        $admin = Admin::factory()->create([
            'email' => $email,
            'name' => 'NNN',
            'password' => Hash::make($password)
        ]);

        $this
            ->actingAs($admin)
            ->postJson('api/admin/login', [
                'email' => $email,
                'password' => $password
            ])
            ->assertJson([
                'name' => 'NNN',
                'email' => $email
            ]);
    }

    public function test_admin_fails_to_login(){
        $email = 'n@gmail.com';
        $password = 'nnn111';
        $admin = Admin::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this
            ->actingAs($admin)
            ->postJson('api/admin/login', [
                'email' => 'nonexisting@gmail.com',
                'password' => 'nnn111'
            ])
            ->assertJson([
               'errors' => [
                   'email' => ['These credentials do not match our records.']
               ]
            ]);
    }
}
