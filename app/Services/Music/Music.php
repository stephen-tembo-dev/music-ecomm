<?php

namespace App\Services\Music;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\MusicResource;
use App\Models\Song;
use Storage;
use Auth;


class Music implements SongContract
{

    public function getMusic()
    {

        # Get music

        $music = Song::paginate(20);

        # Return collection as music as resource

        return MusicResource::collection($music);

    }

    public function getSong($id)
    {

        # Get song

        $song = Song::with('comments')->findOrFail($id);

        # Return a single song as a resource

        return new MusicResource($song);

    }

    public function uploadHandler($request)
    {

        # Set of validation rules

        $validator = Validator::make($request->all(), [
            'artist' => 'required',
            'title' => 'required',
            'genre' => 'required',
            'year' => 'required',
            'song' => 'required|max:6548',
            'cover' => 'required|max:348',
        ]);

        # Check if validation failed

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        # Get original filenames for both cover and song

        $songTitle = time() . $request->song->getClientOriginalName();
        $coverTitle = time() . $request->cover->getClientOriginalName();

        # Build associative array with keys and values

        $songData = [
            'song' => $songTitle,
            'artist' => $request->artist,
            'title' => $request->title,
            'featuring' => $request->featuring,
            'genre' => $request->genre,
            'year' => $request->year,
            'cover' => $coverTitle,
            'uploaded_by' => Auth::user()->id,
        ];

        # Save record to database

        $saved = Song::create($songData);

        if ($saved) {

            # Save song to music folder on server

            if ($request->song->storeAs('music', $songTitle, 'public')) {

                # Save song to covers folder on server

                $request->cover->storeAs('covers', $coverTitle, 'public');

                return new MusicResource($saved);

            }
        }
    }


    public function updateSong($request)
    {

        # Set of validation rules

        $validator = Validator::make($request->all(), [
            'artist' => 'required',
            'title' => 'required',
            'genre' => 'required',
            'year' => 'required',
            'song' => 'required',
            'cover' => 'required'
        ]);

        # Check if validation failed

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        # Assign updated values

        $song = Song::findOrFail($request->id);
        $song->artist = $request->artist;
        $song->title = $request->title;
        $song->feature = $request->feature;
        $song->genre = $request->genre;
        $song->year = $request->year;
        $song->song = $request->song;
        $song->cover = $request->cover;

        # Check if song needs to be updated

        if ($request->hasFile('song')) {

            $songPathToDelete = "music/$song->song";

            $songTitle = time() . $request->song->getClientOriginalName();
            $song->song = $songTitle;

            $request->song->storeAs('music', $songTitle, 'public');

            Storage::disk('public')->delete([$songPathToDelete]);
        }

        # Check if cover needs to be updated

        if ($request->hasFile('cover')) {

            $coverPathToDelete = "covers/$song->cover";

            $coverTitle = time() . $request->song->getClientOriginalName();
            $song->cover = $coverTitle;

            $request->cover->storeAs('covers', $coverTitle, 'public');

            Storage::disk('public')->delete([$coverPathToDelete]);

        }

        # Save updated record and return updated song resource

        if ($song->save()) {
            return new MusicResource($song);
        }

    }

    public function deleteSong($id)
    {

        # Get song

        $song = Song::findOrFail($id);

        $pathToSong = "music/$song->song";
        $pathToCover = "covers/$song->cover";

        if (Storage::disk('public')->exists($pathToSong) && Storage::disk('public')->exists($pathToCover)) {

            if (Storage::disk('public')->delete([$pathToSong, $pathToCover])) {
                if ($song->delete()) {
                    return new MusicResource($song);
                }
            }
        }
    }
}
