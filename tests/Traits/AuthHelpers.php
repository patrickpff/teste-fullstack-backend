<?php

namespace Tests\Traits;

use App\User;

trait AuthHelpers
{
    protected function createUser($userData=null)
    {
        $password = '53cr3t!';

        if (!$userData) {
            // Create personalized fake user
            $user = factory(\App\User::class)->create([
                'email' => $userData["email"],
                'password' => bcrypt($userData["password"]),
            ]);
            $password = $userData["password"];
        } else {
            // Create basic fake user
            $user = factory(\App\User::class)->create([
                "email" => 'johndoe@example.com',
                "password" => bcrypt($password)
            ]);
        }

        return [
            "user" => $user,
            "password" => $password
        ];
    }

    protected function generateTokensForUser($userData=null, $userTryingToLogIn=null)
    {
        $password = '53cr3t!';

        $userData = $this->createUser($userData);
        $user = $userData['user'];
        $password = $userData['password'];

        // call oauth/token endpoint
        $response = $this->json("POST", "/oauth/token", [
            "grant_type" => "password",
            "client_id" => env("PASSWORD_CLIENT_ID"),
            "client_secret" => env("PASSWORD_CLIENT_SECRET"),
            "username" => $userTryingToLogIn ? $userTryingToLogIn['email'] : $user->email,
            "password" => $userTryingToLogIn ? $userTryingToLogIn['password'] : $password,
            'scope' => ''
        ]);

        $authData = json_decode($response->getContent(), true);

        return $authData;
    }
}