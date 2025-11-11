<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\AuthHelpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use AuthHelpers;

    /**
     * Check if the user can log in on API with valid credentials
     * 
     * @return void
     */
    public function test_it_logs_in_with_valid_credentials()
    {
        $userData = [
            'email' => 'johndoe'.uniqid().'@example.com',
            'password' => '53cr3t!'
        ];

        $tokens = $this->generateTokensForUser($userData)['tokens'];

        // Check if tokens exist
        $this->assertArrayHasKey('access_token', $tokens);
        $this->assertArrayHasKey('refresh_token', $tokens);

        // Check if it is possible to access protected route with the credentials
        $response = $this->json('GET', '/api/user', [], [
            'Authorization' => 'Bearer ' . $tokens['access_token']
        ]);

        $response->assertStatus(200);
    }


    /**
     * Check if returns unnauthorized with wrong credentials
     * 
     * @return void
     */
    public function test_returns_unnauthorized_with_invalid_credentials()
    {
        $userData = [
            "email" => 'johndoe'.uniqid().'@example.com',
            "password" => '53cr3t!'
        ];

        $userTryingToLogIn = [
            "email" => 'johndoe'.uniqid().'@example.com',
            "password" => 'secret!'
        ];

        $response = $this->generateTokensForUser($userData, $userTryingToLogIn)["response"];
        
        $response->assertStatus(401);
    }
}
