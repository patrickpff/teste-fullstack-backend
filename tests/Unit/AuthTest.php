<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Traits\AuthHelpers;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use AuthHelpers;
    use DatabaseTransactions;

    /**
     * Check if the user can log in on API with valid credentials
     * 
     * @return void
     */
    public function test_it_logs_in_with_valid_credentials()
    {
        $userData = [
            "email" => 'johndoe'.uniqid().'@example.com',
            "password" => '53cr3t!'
        ];
        $tokens = $this->generateTokensForUser($userData)["tokens"];
        
        $this->assertArrayHasKey("access_token", $tokens);
        $this->assertArrayHasKey("refresh_token", $tokens);
    }

    /**
     * Check if the user can log in on API with valid credentials
     * 
     * @return void
     */
    // public function test_returns_unnauthorized_with_invalid_credentials()
    // {
    //     $userData = [
    //         "email" => 'johndoe@example.com',
    //         "password" => '53cr3t!'
    //     ];

    //     $userTryingToLogIn = [
    //         "email" => 'johndoe@example.com',
    //         "password" => 'secret!'
    //     ];

    //     $tokens = $this->generateTokensForUser($userData, $userTryingToLogIn)["tokens"];
        
    //     $this->assertArrayNotHasKey("access_token", $tokens);
    //     $this->assertArrayHasKey("error", $tokens);
    //     $this->assertEquals('invalid_credentials', $tokens['error']);
    // }
}
