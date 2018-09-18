@extends('layouts.app')

@section('content')


<div class="container">
	<div class="jumbotron">
   <div class="row">
		<div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
    	 <div class="well profile">
            <div class="col-sm-12">
                <div class="col-xs-12 col-sm-12">
                	<h1>{{$numfollowers}} Followers</h1>
                	                        
                    <h2>{{$user->name}}</h2>
                     <p><strong>Email: </strong> {{$user->email}} </p>
                    <p><strong>Gender: </strong>{{$user->gender}}</p>
                     <p><strong>Birthday: </strong> {{$user->date_of_birth}} </p>
                    <p><strong>Bio: </strong> {{$user->bio}} </p>

                    @if(Auth::user()->id == $user->id)
                       
                       <a href='/peoples/{{Auth::user()->id}}/edit'  class="btn btn-info" role="button">Edit Profile</a>
                  
                    
                    @elseif($follower==null)

                     <div>
                            <form  method="post" action="{{route('followers.store')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                 
                                <button type="submit" class="btn btn-success ">Follow {{$user->name}}</button>
                            </form>
                        </div>


                    @else
                        <div>
                             <form      action="{{route('followers.destroy',[$follower])}}"  method="POST" >
                                {{ method_field('DELETE') }}
                                 
                                 <input type="hidden" name="_method" value="delete">
                               
                                {{csrf_field()}}
                                
                             <button type="submit" class="btn btn-danger">Unfollow {{$user->name}}</button>
                            </form>
                            
                        </div>



                   
                    @endif
                </div>             
              
            </div>            
   
            </div>
    	 </div>                 
		</div>
	</div>
</div>
</div>

@endsection

