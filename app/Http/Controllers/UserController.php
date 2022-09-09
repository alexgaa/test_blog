<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'email' => 'required|email',
            'password'=>'required|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        session()->flash('status', 'You are registered');
        Auth::login($user);
        return redirect()->home();
    }

    /**
     * @return Application|Factory|View
     */
    public function loginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt([
                'email' =>$request->email,
                'password' => $request->password,
            ])) {
            if(Auth::user()->is_admin === 1){
                return redirect()->route('admin.index')->with('status', "you are logged in!" );
            } else {
                return redirect()->route('home')->with('status', "you are logged in!" );;
            }
        }

        return redirect()->back()->with('status', "Incorrect mail or password!" );
    }

    /**
     * @return RedirectResponse
     */
    public function loguot()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}
