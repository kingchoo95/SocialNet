<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Vote;
use App\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $followers = Follower::where('user_id',Auth::user()->id)->get();
        $comments = Comment::orderBy('created_at','ASC')->get();
        $posts = Post::orderBy('updated_at','desc')->paginate(5);
        //$posts = Post::join('followers','Post.user_id','=','Follower.followers_id')

        return view('home',['comments' => $comments,'posts' => $posts,'followers' => $followers]);
    }
}//