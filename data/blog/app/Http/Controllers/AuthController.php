<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm(string $key)
    {
        $user = Auth::user();

        if ($user instanceof User) {
            redirect($this->redirectTo)->send();
        }

        if (config('app.login_key') !== $key) {
            abort(404);
        }

        $LoginController = app()->make('\App\Http\Controllers\Auth\LoginController');
        return $LoginController->showLoginForm();
    }

    public function login(string $key, Request $request)
    {
        $user = Auth::user();

        if ($user instanceof User) {
            redirect($this->redirectTo)->send();
        }

        if (config('app.login_key') !== $key) {
            abort(404);
        }
        $LoginController = app()->make('\App\Http\Controllers\Auth\LoginController');
        return $LoginController->login($request);
    }

    public function showConfirmForm(string $key)
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            redirect($this->redirectTo)->send();
        }

        if (config('app.login_key') !== $key) {
            abort(404);
        }

        $ConfirmPasswordController = app()->make('\App\Http\Controllers\Auth\ConfirmPasswordController');
        return $ConfirmPasswordController->showConfirmForm();
    }

    public function confirm(string $key, Request $request)
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            redirect($this->redirectTo)->send();
        }

        if (config('app.login_key') !== $key) {
            abort(404);
        }

        $ConfirmPasswordController = app()->make('\App\Http\Controllers\Auth\ConfirmPasswordController');
        return $ConfirmPasswordController->confirm($request);
    }
}
