<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\DatabaseSwitcher;

class TenantMiddleware
{
    /**
     * Handle an incoming request and ensure the correct tenant database is connected.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the current user is an admin (using the 'admin' guard)
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            
            // If the admin has a specific database assigned, switch to it
            if ($admin->db_name) {
                DatabaseSwitcher::switch($admin->db_name);
            } else {
                // If no DB is assigned, we might want to log them out or show an error
                // For now, let's just use the main DB as fallback (default behavior)
            }
        }

        return $next($request);
    }
}
