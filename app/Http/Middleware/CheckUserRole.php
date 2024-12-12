<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // return $next($request);
        $user = Auth::guard('custom_users')->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
    
        if (!in_array($user->usertype, $roles)) {
            // Redirect to appropriate dashboard based on user's actual role
            switch($userRole) {
                case 1:
                    return redirect()->route('admin.dashboard')
                        ->with('error', 'You do not have permission to access this page');
                case 3:
                    return redirect()->route('technician.dashboard')
                        ->with('error', 'You do not have permission to access this page');
                case 0:
                    return redirect()->route('requester.dashboard')
                        ->with('error', 'You do not have permission to access this page');
                default:
                    return redirect()->route('unauthorized')
                        ->with('error', 'Unauthorized access');
            }
        }
    }
}
