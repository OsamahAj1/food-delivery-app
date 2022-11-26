<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('restaurant.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:255']
        ]);

        if (auth()->attempt($attributes)) {
            session()->regenerate();

            $rule = auth()->user()->rule;
            if ($rule !== 'restaurant' && $rule !== 'admin') {
                auth()->logout();

                return redirect(route("$rule.login"));
            }

            return redirect(route('restaurant.index'))->with('message', 'Welcome Back ' . ucwords(auth()->user()->name));
        }

        return back()->withInput()->withErrors(['email' => 'Your provided credentials could not be verified.']);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect(route('index'));
    }
}
