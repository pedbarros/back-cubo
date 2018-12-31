<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(400)
            ->assertJson([
                'status' => false,
                'data' => 'Você precisa especificar o email!',
            ]);
    }

    public function _testUserLoginsSuccessfully()
    {
        $payload = ['email' => 'cubo@cubo.com', 'password' => 'cubo123'];

        $this->json('POST', 'api/login', $payload)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '_id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'token',
                ],
            ]);

    }

    public function testsRegistersSuccessfully()
    {
        $number = rand(1,100);
        $payload = [
            'name' => 'Pedro' . $number,
            'email' => "pedro{$number}@pedro$number.com",
            'password' => $number,
        ];

        $this->json('post', '/api/register', $payload)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '_id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'token',
                ],
            ]);;
    }
}
