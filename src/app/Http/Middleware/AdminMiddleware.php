<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            // Логирование для случая, когда пользователь не аутентифицирован
            Log::info('Пользователь не аутентифицирован.');
            return response()->json([
                'message' => 'Unauthorized: User not authenticated'
            ], 403);
        }

        if (!$request->user()->isAdmin()) {
            // Логирование для случая, когда пользователь не администратор
            Log::info('Пользователь не администратор. ID пользователя: ' . $request->user()->id);
            return response()->json([
                'message' => 'Unauthorized: User is not admin'
            ], 403);
        }

        return $next($request);
    }
}
