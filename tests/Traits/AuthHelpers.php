<?php

namespace Tests\Traits;

use App\User;

trait AuthHelpers
{
    protected function createUser($userData=null)
    {
        $password = '53cr3t!';

        if ($userData) {
            // Create personalized fake user
            $user = factory(\App\User::class)->create([
                'email' => $userData["email"],
                'password' => bcrypt($userData["password"]),
            ]);
            $password = $userData["password"];
        } else {
            // Create basic fake user
            $user = factory(\App\User::class)->create([
                "email" => 'johndoe'.uniqid().'@example.com',
                "password" => bcrypt($password)
            ]);
        }

        return [
            "user" => $user,
            "password" => $password
        ];
    }

    protected function postAuth($username, $password)
    {
        // call oauth/token endpoint
        return $this->json("POST", "/oauth/token", [
            "grant_type" => "password",
            "client_id" => env("PASSWORD_CLIENT_ID"),
            "client_secret" => env("PASSWORD_CLIENT_SECRET"),
            "username" => $username,
            "password" => $password,
            'scope' => ''
        ]);
    }

    protected function generateTokensForUser($userData=null, $userTryingToLogIn=null)
    {
        $password = '53cr3t!';

        $userData = $this->createUser($userData);
        $user = $userData['user'];
        $password = $userData['password'];

        $response = $this->postAuth(
            $userTryingToLogIn ? $userTryingToLogIn['email'] : $user->email,
            $userTryingToLogIn ? $userTryingToLogIn['password'] : $password
        );
        print_r($userTryingToLogIn ? $userTryingToLogIn['email'] : $user->email);
        print_r($userTryingToLogIn ? $userTryingToLogIn['password'] : $password);

        $authData = json_decode($response->getContent(), true);

        return [
            "tokens" => $authData,
            "response" => $response
        ];
    }
}