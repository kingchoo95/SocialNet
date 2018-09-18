<?php

namespace App\Http\Controllers;

use App\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $unfollowinguser = Follower::where
                (
                   'followers_id','!=',Auth::user()->id
                
               )->get();
            
            
          
          
                    
            return view('user',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
            //dd($request->input('followers_id'));
            $result1 = Follower::where
                ([
                    ['followers_id','=',Auth::user()->id
                ],
                [
                    'user_id','=',$request->input('user_id')]
                ])->get();
            
            //dd($result1);
          
            if($result1->count() > 0){
                 return redirect()->back()->with('home');

                    
              }else{
                    if(Auth::check()){

                            $follower = Follower::create([
                              
                                'user_id' => $request->input('user_id'),
                                'followers_id' => Auth::user()->id
                            ]);

                    }
                
              }
                    
            return redirect()->back()->with('home');

          
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function show(Follower $follower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function edit(Follower $follower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follower $follower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follower $follower)
    {
        //

        //
        
        $findFollower =  Follower::find($follower->id);
      

        
        if($findFollower->delete()){
            
                return redirect()->route('peoples')->with('success','peoples deleted successfully');
            

        }

        return back()->withInput()->with('error', 'peoples not deleted');

    }


    
}
