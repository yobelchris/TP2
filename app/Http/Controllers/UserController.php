<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        if (!$request->filled('username') || !$request->filled('password')) {
            return view('login', [
                'message' => 'username and password required',
                'is_error' => true
            ]);
        }

        $failed_attempt = 0;

        if ($request->has('failed_attempt')) {
            $failed_attempt = $request->input('failed_attempt');
        }

        $user = User::where('username', $request->input('username'))->get();

        if (count($user) <= 0) {
            return view('login', [
                'message' => 'invalid username or password',
                'is_error' => true,
                'failed_attempt' => $failed_attempt + 1
            ]);
        }

        if (! Hash::check($request->input('password'), $user[0]->password)) {
            return view('login', [
                'message' => 'invalid username or password',
                'is_error' => true,
                'failed_attempt' => $failed_attempt + 1
            ]);
        }

        return view('login',[
            'message' => 'success',
            'is_error' => false,
            'failed_attempt' => $failed_attempt
        ]);
    }

    public function register(Request $request) {
        if (!$request->filled('username') || !$request->filled('password') || !$request->filled('email')) {
            return view('register', [
                'message' => 'username, email and password required',
                'is_error' => true
            ]);
        }

        $user = User::where('username', $request->input('username'))->get();

        if (count($user) > 0) {
            return view('register', [
                'message' => 'username already exist',
                'is_error' => true
            ]);
        }

        $user = User::where('email', $request->input('email'))->get();

        if (count($user) > 0) {
            return view('register', [
                'message' => 'email already exist',
                'is_error' => true
            ]);
        }

        $regexPattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{10,}$/";

        if (preg_match($regexPattern, $request->input('password')) == 0) {
            return view('register', [
                'message' => 'password need at least 10 characters and contains at least one lowercase letter, one uppercase letter, one numeric digit, and one special character',
                'is_error' => true
            ]);
        }

        $user = new User;

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return view('register', [
            'message' => 'success',
            'is_error' => false
        ]);
    }
}
