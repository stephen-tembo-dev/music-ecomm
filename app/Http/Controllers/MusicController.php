<?php

namespace App\Http\Controllers;

use App\Services\Music\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{

    public function index(Music $music)
    {
        return $music->getMusic();
    }

    public function show(Music $music, $id)
    {
        return $music->getSong($id);
    }

    public function store(Music $music, Request $request)
    {
        return $music->uploadHandler($request);
    }

    public function update(Music $music, Request $request)
    {
        return $music->updateSong($request);
    }

    public function destroy(Music $music, $id)
    {
        return $music->deleteSong($id);
    }
}
