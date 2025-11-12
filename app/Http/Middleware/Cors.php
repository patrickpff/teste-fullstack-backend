<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $allowedOrigins = [
        //     env('ANGULAR_URL', ''),
        //     // other urls
        // ];
        
        $origin = $request->headers->get("Origin") ?? 'http://localhost:4200';

        $response = $next($request);

        // if (in_array($origin, $allowedOrigins, true)) {
        $response->headers->set('Access-Control-Allow-Origin', $origin);
        $response->headers->set('Vary', 'Origin'); // avoid incorrect cache
        // }

        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        if ($request->getMethod() === "OPTIONS") {
            return response('', 204)
                ->withHeaders($response->headers->all());
        }

        return $response;
    }
}
