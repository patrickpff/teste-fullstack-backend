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

        return Route::dispatch($proxy);
    }
}
