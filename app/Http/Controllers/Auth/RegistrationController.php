<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Hash;
use Auth;

class RegistrationController extends Controller
{
    public function register()
    {
        return view("admin.auth.register");
    }

    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $userExists = User::where('username', $username)->exists();

        return response()->json(['exists' => $userExists]);
    }

    public function registerUser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'mobile' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'max:100', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);



        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('subscribe');
    }
}
