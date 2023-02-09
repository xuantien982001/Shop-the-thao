<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddelware
{

    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('admin')->check();
        if ($check) {
            $admin = Auth::guard('admin')->user();
            if ($admin->is_block) {
                toastr()->error('Tài khoản của bạn đã bị khoá!');
                return redirect('/admin-shop/login');
            }
            return $next($request);
        } else {
            return redirect('/admin-shop/login');
        }
    }
}
