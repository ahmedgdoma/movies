<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailedLogin()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', '/api-login', ['email' => 'admin@movies.dev']);

        $response->assertStatus(400);
    }
    public function testSuccessLogin()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', '/api-login', ['email' => 'admin@movies.dev', 'password'=>'dev123456']);

        $response->assertStatus(200);
    }
}
