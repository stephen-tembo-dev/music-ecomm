<?php

namespace App\Services\Music;

interface SongContract
{
    public function getMusic();
    public function getSong($id);
    public function uploadHandler($request);
    public function updateSong($request);
    public function deleteSong($id);
}
