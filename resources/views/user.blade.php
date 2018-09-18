@extends('layouts.app')

@section('content')



      <div class="container">
          
          <h2>People You May Know</h2>
          <br>
        <div class="shadow">

         <div class="row ">
          
                
                    
                        
                        
                    @foreach($users as $user)

                           
                          
                          
                            <div class="col-sm-2">
                              
                              <img src="https://www.infrascan.net/demo/assets/img/avatar5.png" class="img-circle" width="60px">
                            </div>

                            <div class="col-sm-8 ">
                              <h4><a href="/peoples/{{$user->id}}" > {{$user->name}}</a></h4>
                       
                              <p>4 followers</p>
                            </div>

                          
                              <div class="col-sm-2">
                                
                                    
                              </div>

                         

                              
                  @endforeach
            </div>
      </div>
         
      </div>

@endsection

