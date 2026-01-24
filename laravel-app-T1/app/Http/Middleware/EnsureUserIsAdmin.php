<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // Assumes `is_admin` boolean column exists on users table. Adjust as needed.
        if (! $user || ! ($user->is_admin ?? false)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }
            return redirect()->route('login')->with('error', 'يجب أن تكون مشرفاً للوصول إلى لوحة التحكم.');
        }

        return $next($request);
    }
}
