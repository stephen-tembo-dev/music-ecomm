<?php

namespace App\Http\Controllers;

use App\Services\Comments\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Comment $comment, Request $request)
    {
        return $comment->commentHandler($request);
    }
}
