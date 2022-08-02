<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Music\MusicInStore;

class MusicStoreController extends Controller
{

    public function index(MusicInStore $music)
    {
        return $music->getMusic();
    }

    public function show(MusicInStore $music, $id)
    {
        return $music->getSong($id);
    }

    public function store(MusicInStore $music, Request $request)
    {
        return $music->uploadHandler($request);
    }

    public function update(MusicInStore $music, Request $request)
    {
        return $music->updateSong($request);
    }

    public function destroy(MusicInStore $music, $id)
    {
        return $music->deleteSong($id);
    }
}
