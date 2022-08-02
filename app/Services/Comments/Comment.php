<?php

namespace App\Services\Comments;

use App\Models\Song;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;

class Comment
{
    public function commentHandler($request)
    {

        # Set of validation rules

        $validator = Validator::make($request->all(), [
            'comment' => 'required',
            'song_id' => 'required',
        ]);

        # Check if validation failed

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        # Build associative array with keys and values

        $commentData = [
            'comment' => $request->comment,
            'user_id' => 1,
            //'user_id' => Auth::user()->id
        ];

        # Save record to database

        $song = Song::find($request->song_id);

        if ($song) {

            $commented = $song->comments()->create($commentData);

            if ($commented) {
                return new CommentResource($commented);
            }

        } else {
            return response()->json("No song with that id found.", 200);
        }

    }
}
