<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // ✅ Import Auth facade

class CheckUserRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        // Debugging Middleware Execution
        // dd("Middleware Running: Required Role -> " . $role);
        
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('login')->with('status', 'Please login to continue.');
        }
       

        // Check if user has required role
        //old working
        // if (Auth::user()->role !== $role) {
        //     return response()->json(['message' => 'Forbidden: Insufficient permissions'], 403);
        // }

        $userRole = Auth::user()->role; // Get logged-in user's role
        $allowedRoles = explode('|', $roles); // Convert "admin|superadmin" to ['admin', 'superadmin']
    
        if (!in_array($userRole, $allowedRoles)) {
            return redirect('/')->with('status', 'Access Denied.');
        }
    

        return $next($request);
    }
}

