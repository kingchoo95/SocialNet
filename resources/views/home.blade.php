@extends('layouts.app')

@section('content')

                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>

  <script>
  
        
        $(document).ready(function(){
            
            //hide and show comment
            $(".hide").hide();
            
           var id;
          $('.commentTitle').on('click',function(){
               id = $(this).attr("id");
                $(".comments_"+id).toggle(300);
         
            });

          //hide and show edit stuff
          $(".allEditStuff").hide();

          
          $('.editButton').on('click',function(){
              id = $(this).attr("id");
              
              $(".editStuff_"+id).show();
              $(".displayStuff_"+id).hide();
            });

           $('.cancelButton').on('click',function(){
              id = $(this).attr("id");
              
              $(".editStuff_"+id).hide();
              $(".displayStuff_"+id).show();
            });
          

});
</script>

</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>{{Auth::user()->name}}'s Home</h4>
      <p>{{Auth::user()->bio}}</p>
      <h5>Your Followers</h5>
      <ul >
            @foreach($followers as $follower)

              <p><a href="/peoples/{{$follower->followers_id}}">{{$follower->user->name}}</a></p>
            
            @endforeach
      </ul>
      
    </div>

    <div class="col-sm-9">
        <h4><small>YOUR THOUGHT</small></h4>
      <hr>

    <form  method="post" action="{{route('posts.store')}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="post">
        <div class="form-group">
          <textarea class="form-control" rows="3" required name="post" placeholder="What's on your mind, {{Auth::user()->name}}?"> </textarea>
        </div>
        <button type="submit" class="btn btn-success float-right">POST</button>
    </form>
        <br>




      <h4><small>RECENT POSTS</small></h4>
      <hr>

      @foreach($posts as $post)

      <div class="jumbotron" style="background-color:#b3e0ff">
        @if(Auth::user()->id == $post->user->id)
        <div class="btn-group float-right">
          <span  class="btn btn-default dropdown-toggle " id="editStuff_{{$post->id}}" data-toggle="dropdown">
             </span>
          
              <ul class="dropdown-menu"  role="menu" >
                <li>

                  <a class="editButton" id="{{$post->id}}">Edit</a>

                </li>
                <li>
                  
                  <a  onclick=" 
                      var result = confirm('Are you sure you wish to delete this post?');
                          if( result ){
                                  event.preventDefault();
                                  document.getElementById('delete-form_{{$post->id}}').submit();

                          } "> Delete
                  </a>
                     
                  <form id="delete-form_{{$post->id}}" action="{{ url('posts',['$id'=> $post->id])}}"  method="POST" style="display: none;">

                            <input type="hidden" name="_method" value="delete">
                            {{ csrf_field() }}

                           {!! method_field('DELETE') !!}
                  </form>

              </li>
                
              </ul>
        </div>
        @endif

      <h5 style="font-size: 30px"><b><span class="label label-success displayStuff_{{$post->id}}"  >{{$post->content}}</span>  

         

      </b>

      <form method="post" action="{{route('posts.update',[$post->id])}}" class="allEditStuff editStuff_{{$post->id}}"  >
          {{csrf_field()}}
          <input type="hidden" name="_method" value="put">
             <textarea class="form-control" rows="3" required name="content"> {{$post->content}}</textarea>  
          <button type="submit" class="btn btn-warning float-right ">CONFIRM</button>
          
      </form>

      <button  class="btn btn-danger float-right allEditStuff editStuff_{{$post->id}} cancelButton"   id="{{$post->id}}">CANCEL</button>



    </h5>
    <?php $i=0 ?>
      <p><small><span class="glyphicon glyphicon-time"></span><a href="/peoples/{{$post->user->id}}">{{$post->user->name}}</a> ,{{$post->updated_at}}</small></p>
       
      <div class="row displayStuff_{{$post->id}}" >
        <div class="comments_{{$post->id}} col-sm-12 hide">
          
          @foreach($comments as $comment)

            @if($post->id == $comment->post_id)

            <?php $i++ ?>
            <b><a href="/peoples/{{$comment->user->id}}">{{$comment->user->name}} </a>{{$comment->content}}</b>
            <p><small>{{$comment->created_at}}</small></p>
            @endif
          @endforeach
        </div>
        
      </div>
      <p class="displayStuff_{{$post->id}}" ><b> <span class="vote" style="color: black">

        <form  method="post" action="{{route('votes.store')}}">
           {{csrf_field()}}
           <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="hidden" name="user_id" value="11">
            
           <button type="submit"> Votes</button>
        </form>

       

      </span><span class="comment_{{$post->id}} commentTitle" id="{{$post->id}}" style="color: black"> {{$i}} Comments:</span></b></p>
      

      <h4 class="displayStuff_{{$post->id}}">Leave a Comment:</h4>
   

      <form  class="displayStuff_{{$post->id}}" method="post" action="{{route('comments.store')}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="form-group">
          <textarea class="form-control" rows="2" required name="comment" required placeholder="Write a comment..."> </textarea>
        </div>
        <button type="submit" class="btn btn-success float-right">Submit</button>
    </form>
      </div>

      @endforeach


      {{ $posts->links() }}

    </div>
    

  </div>
</div>



</div>


<!--
<b><a href="">John Row </a> I am so happy for you man!.</b>
 <b><a href="">Anja </a>Keep up the GREAT work!</b>
-->
  
@endsection
