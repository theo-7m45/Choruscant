<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function create()
    {
        
    }

    public function edit($id)
    {
        $music = Music::findOrFail($id);

        return view('musics.edit', compact('music'));
    }

    public function update(Request $request, $id)
    {
        $music = Music::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'genre' => 'nullable|string|max:255',
            'url' => 'nullable|url',
        ]);

        $music->update($request->all());

        return redirect()->route('musics.index')->with('success', 'Music updated successfully.');
    }
}