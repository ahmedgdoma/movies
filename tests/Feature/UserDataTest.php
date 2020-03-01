<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailedGetUserData()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', '/api/user');

        $response->assertStatus(401);
    }


    public function testSuccessGetUserData()
    {
        $token = User::find(1)->api_token;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Bearer ${token}"
        ])->json('GET', '/api/user');

        $response->assertStatus(200);
    }
}
