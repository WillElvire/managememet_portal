<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $loginPayload = $request->all();
        $user = User::firstWhere(['username'=>$request->Username]);
        if (!$user) {
            User::create([
                'username' => $request->Username,
                'email' =>$request->Username,
                'group_id' => 3,
                'role_id'=>1
            ]);
            $token = $user->createToken('bearer-token')->plainTextToken;
            Auth::login($user);
            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }
        $token = $user->createToken('bearer-token')->plainTextToken;
        Auth::login($user);
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'You have been successfully logged out.'
        ]);
    }
}
