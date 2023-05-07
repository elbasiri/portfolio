<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comments;

class CommentsController extends Controller
{
    public function index() {
        $comments = comments::all();

        return view('Home', compact('comments'));
    }

        public function store(Request $request)
    {
        $comment = new comments();
        $comment->text = $request->input('comment');
        $comment->save();

        return redirect('/');
    }

    public function delete()
    {
        DB::table('comments')->delete();

        return redirect('/');
    }
}
