<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('account.register.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ],
            [
                'name.required'=> "Ім'я обовязкове поле",
                'email.required'=> "Пошта є обовязкове поле",
                'email.email'=> "Не коретно вказано пошту",
                'email.unique'=>"Такий емейл уже є" ,
                'password.required'=> "Вкажіть поле пароль",
                'password.confirmed'=>'Паролі не співпадають'
            ]
        );
        if(User::query()->has())
        $user = User::create(request(['name', 'email', 'password']));
        auth()->login($user);

        return redirect()->to('/');
    }
}
