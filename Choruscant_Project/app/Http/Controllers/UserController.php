<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('welcome', compact('users'));
    }

    public function myConstellation()
    {
        $user = auth()->user()->load('musics');

        return view('auth.MyConstellation', compact('user'));
    }

    public function search(Request $request)
    {
        $query = $request->validate([
            'query' => 'required|string|max:20',
        ])['query'];

        $users = User::all();
        $searchResults = User::whereRaw('LOWER(name) LIKE ?', ['%' . Str::lower($query) . '%'])
            ->get();

        return view('welcome', compact('users', 'searchResults', 'query'));
    }


    public function discovery(User $user)
    {
        $user->load('musics');

        return view('auth.Discovery', compact('user'));
    }


}
