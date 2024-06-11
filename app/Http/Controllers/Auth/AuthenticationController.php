<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;

class AuthenticationController extends Controller
{
    public function auth()
    {
        return view("admin.auth.login");
    }

    /**
     * To determine which url to go after logging in.
     */
    private function getRightRedirectRoute(): string{
        $role = Auth::user()->role;
        switch ($role){
            case 'admin':
                $url = '/admin/profile';
                break;
            case 'vendor':
                $url = '/admin/profile';
                break;
            default:
                $url = '/profile';
        }
        return $url;
    }

     /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended($this->getRightRedirectRoute());
    }

        /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
