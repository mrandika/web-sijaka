<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyRequestAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-SIJAKA-APIKEY');

        if ($apiKey == env('APP_API_KEY', '')) {
            return $next($request);
        }

        return response()->json([
            'code' => 403,
            'message' => 'Failed to accept the requests.',
            'data' => null
        ], 403);
    }
}
