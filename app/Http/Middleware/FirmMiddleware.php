<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Firm;

class FirmMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply to admin guard
        if (Auth::guard('admin')->check()) {
            
            // Check if firm is selected in session
            if (!Session::has('selected_firm_id')) {
                
                // Allow access to firm selection and creation routes to avoid infinite loop
                $allowedRoutes = [
                    'firms.select',
                    'firms.store',
                    'firms.index',
                    'firms.create',
                    'logout'
                ];

                if (!$request->routeIs($allowedRoutes)) {
                    // Check if any firm exists, if not redirect to create first firm
                    if (Firm::count() === 0) {
                        return redirect()->route('firms.create')->with('info', 'Please create your first firm to continue.');
                    }
                    
                    // If firms exist but none selected, redirect to selection
                    return redirect()->route('firms.select')->with('info', 'Please select a firm to continue.');
                }
            } else {
                // Verify the selected firm actually exists (safety check)
                $firmId = Session::get('selected_firm_id');
                if (!Firm::where('id', $firmId)->exists()) {
                    Session::forget('selected_firm_id');
                    return redirect()->route('firms.select')->with('error', 'Selected firm no longer exists.');
                }
            }
        }

        return $next($request);
    }
}
