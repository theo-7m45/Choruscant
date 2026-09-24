<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myConstellation()
    {
        $user = auth()->user()->load('musics');

        return view('auth.MyConstellation', compact('user'));
    }

    public function index()
    {
        $users = User::latest()->get();

        return view('welcome', compact('users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function discovery(User $user)
    {
        $user->load('musics');

        return view('auth.Discovery', compact('user'));
    }
}
