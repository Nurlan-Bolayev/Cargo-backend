<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_user_registers_successfully()
    {
        $name = 'NNN111';
        $email = 'n@gmail.com';
        $password = 'nnn111';

        $this
            ->postJson('api/register', [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ])
            ->assertJson([
                'email' => $email,
                'name' => $name
            ]);

        $this
            ->assertDatabaseHas('users' ,[
               'email' => $email
            ]);
    }

    public function test_user_fails_to_register(){
        $name = 'NNN111';
        $email = 'n@gmail.com';
        $password = 'nnn111';
        $userA = User::factory()->create([
           'email' => $email,
        ]);
        $this
            ->postJson('api/register', [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ])
            ->assertJson([
                'errors' => [
                    'email' => ['This email is already taken.']
                ]
            ]);

        $this
            ->assertDatabaseMissing('users' ,[
                'name' => $name
            ]);
    }

    public function test_user_logs_in_succesfully()
    {
        $email = 'n@gmail.com';
        $password = 'nnn111';
        $user = User::factory()->create([
            'email' => $email,
            'password' => \Hash::make($password)
        ]);

        $this
            ->actingAs($user)
            ->postJson('api/login', [
                'email' => $email,
                'password' => $password
            ])
            ->assertJson([
                'email' => $email
            ]);
    }

    public function test_user_fails_to_login()
    {
        $email = 'n@gmail.com';
        $password = 'nnn111';
        $user = User::factory()->create([
            'password' => \Hash::make($password)
        ]);

        $this
            ->actingAs($user)
            ->postJson('api/login', [
                'email' => $email,
            ])
            ->assertJson([
                'errors' => [
                    'email' => ['The selected email is invalid.']
                ]]);
    }
}
