<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetMoviesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailedAuthentivation()
    {
        $token = \App\User::find(1)->api_token;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json('GET', '/api/get-recent-movies');

        $response->assertStatus(401);
    }
    public function testFailedParameters()
    {
        $token = \App\User::find(1)->api_token;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Bearer ${token}"
        ])->json('GET', '/api/get-recent-movies?polity|asb');

        $response->assertStatus(406);
    }
    public function testSuccessParameters()
    {
        $token = \App\User::find(1)->api_token;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Bearer ${token}"
        ])->json('GET', '/api/get-top-rated-movies?popularity|asc&rate|desc&category_id=18');

        $response->assertStatus(200);
    }
    public function testAnotherSuccessParameters()
    {
        $token = \App\User::find(1)->api_token;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Bearer ${token}"
        ])->json('GET', '/api/get-recent-movies?title|desc&rate=5');

        $response->assertStatus(200);
    }
}
