<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Comment;





class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('home'); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

            if(Auth::check()){

                    $post = Post::create([
                        'content' => $request->input('post'),
                        'user_id' => Auth::user()->id
                    ]);

            }

            if($post){
                $posts = Post::orderBy('created_at','ASC')->paginate(5);
               
                    
                    return redirect()->back()->with('home', ['posts' => $posts]);

            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

         $posts = Post::all();

        return view('home',['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $postUpdate = Post::where('id',$id)
        ->update([
            'content' =>$request->input('content'),
            
        ]);

        if($postUpdate){
            return redirect()->route('home')
            ->with('success', 'Your Profile is updated!');
        }
        return back()->withInput();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $findPost =  Post::find($id);
        $findComment = Comment::where('post_id',$id);

        
        if($findPost->delete()){
            if($findComment->delete()){
                return redirect()->route('home')->with('success','company deleted successfully');
            }

        }

        return back()->withInput()->with('error', 'post not deleted');

    }
}
