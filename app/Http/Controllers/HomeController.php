<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\comments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
                $comments = comments::all();

                return view('Home', compact('comments'));
            }



        public function store(Request $request)
            {

                $user = Auth::user()->name;

                $comment = new comments();
                $comment->text = $request->input('comment');
                $comment->user = $user;
                $comment->save();

                return redirect('/');
            }



    public function delete(Request $request)
                {

                    $id = $request->id;

                    $comment = comments::find($id);

                    $comment->likes()->delete();
                    
                    comments::where('id' , $id)->delete();                    
                    return redirect('/');
                }


                public function like($id)
                    {
                        $comment = comments::find($id);

                        if ($comment->likes()->where('user_id', auth()->id())->where('liked', true)->exists()) {
                            // if the user already liked the comment, do nothing and redirect back
                            return back();
                        }

                        $comment->likes()->create([
                            'user_id' => auth()->id(),
                            'liked' => true,
                        ]);
                        return back();
                    }           
                
}
