<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{


    public function create(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_video_id' => [
                'required',
                'regex:/^[A-Za-z0-9_-]{11}$/',
            ],
        ]);

        $request->user()->musics()->create($data);

        return back()->with('success', 'Musique ajoutée.');
    }
//________________________________


    public function edit_views(Music $music)
    {
        abort_unless($music->user_id === auth()->id(), 403);

        return view('auth.edit_views', compact('music'));
    }

//_________________________________

    public function edit(Request $request, Music $music)
    {
        abort_unless($music->user_id === auth()->id(), 403);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_video_id' => [
                'required',
                'regex:/^[A-Za-z0-9_-]{11}$/',
            ],
        ]);

        $music->update($data);

        return redirect()
            ->route('MyConstellation')
            ->with('success', 'Musique modifiée.');
    }

//_____________________

public function delete(Music $music)
{
    abort_unless($music->user_id === auth()->id(), 403);

    $music->delete();

    return redirect()
        ->route('MyConstellation')
        ->with('success', 'Musique supprimée.');
}
}