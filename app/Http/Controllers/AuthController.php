<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    public function token(Request $request)
    {
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => env('PASSWORD_CLIENT_ID', ''),
            'client_secret' => env('PASSWORD_CLIENT_SECRET', ''),
            'scope' => '*',
        ]);

        $proxy = Request::create('oauth/token', 'post');
        $response = Route::dispatch($proxy);

        if (!$response->isOk()) {
            return $response;
        }

        $data = json_decode($response->getContent(), true);

        // Safe cookies and HttpOnly
        $accessCookie = cookie(
            'access_token',
            $data['access_token'],
            60,                         // minutes
            '/',                        // path
            env('DOMAIN', 'localhost'), // domain
            false,                      // secure
            true,                       // httpOnly
            false,                      // raw
            'Lax'                       // sameSite = Lax (avoid Cors)
        );

        $refreshCookie = cookie(
            'refresh_token',
            $data['refresh_token'],
            60 * 24 * 7,                // 7 days
            '/',                        // path
            env('DOMAIN', 'localhost'), // domain
            false,                      // secure
            true,                       // httpOnly
            false,                      // raw
            'Lax'                       // sameSite = Lax (avoid Cors)
        );

        return response()->json(['message' => 'Login successful'])
            ->withCookie($accessCookie)
            ->withCookie($refreshCookie);
    }

    public function refreshToken(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');

        if (!$refreshToken) {
            return response()->json(['message' => 'No refresh token found'], 401);
        }

        $request->request->add([
            'grant_type' => 'refresh_token',
            "refresh_token" => $refreshToken,
            "client_id" => env('PASSWORD_CLIENT_ID', ''),
            "client_secret" => env('PASSWORD_CLIENT_SECRET', '')
        ]);

        $proxy = Request::create('oauth/token', 'post');
        $response = Route::dispatch($proxy);

        if (!$response->isOk()) {
            return $response;
        }

        $data = json_decode($response->getContent(), true);

        // Update cookies
        $accessCookie = cookie(
            'access_token',
            $data['access_token'],
            60,                         // minutes
            '/',                        // path
            null,                       // domain
            false,                      // secure
            true,                       // httpOnly
            false,                      // raw
            'Lax'                       // sameSite = Lax (avoid Cors)
        );

        $refreshCookie = cookie(
            'refresh_token',
            $data['refresh_token'],
            60 * 24 * 7,                // 7 days
            '/',                        // path
            null,                       // domain
            false,                      // secure
            true,                       // httpOnly
            false,                      // raw
            'Lax'                       // sameSite = Lax (avoid Cors)
        );

        return response()->json(['message' => 'Token refreshed'])
            ->withCookie($accessCookie)
            ->withCookie($refreshCookie);
    }
}
