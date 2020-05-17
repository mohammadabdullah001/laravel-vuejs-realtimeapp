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

        $allowedOrigins = [
            'http://127.0.0.1:8000',
            // 'https://sockjs.pusher.com/pusher/app/',
        ];
        $requestOrigin = $request->headers->get('Origin');

        if (in_array($requestOrigin, $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $requestOrigin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT,PATCH, DELETE,OPTIONS')
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Allow-Headers', 'Origin,Accept,Content-Type, Authorization');
        }
        return $next($request);
    }
}
