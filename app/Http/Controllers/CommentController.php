<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(CreateCommentRequest $request){
        $data = $request->validated();
        
        $comment = $gradebook->comments()->create($data);
    }

    public function destroy(Comment $comment){
        
        $comment->delete();

        return response()->json($comment);
    }
}
