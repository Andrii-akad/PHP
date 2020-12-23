<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function destroy()
    {
        auth()->logout();

        return redirect()->to('/');
    }
    public function create()
    {
        return view('account.login.create');
    }

    public function store()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'Пошту і пароль вказано не корентно!'
            ]);
        }

        return redirect()->to('/');
    }
}
