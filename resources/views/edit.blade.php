@extends('layouts.app')

@section('content')
@if(Auth::user()->id == $user->id)
<div class="container">
<form method="post" action="{{route('users.update',[$user->id])}}">
          {{csrf_field()}}
          <input type="hidden" name="_method" value="put">
          
          <div class="form-group">
            <label for="company-name">Name<span class="required" >*</span></label>
            <input placeholder="Enter name" id="name" required name="name" spellcheck="false" class="form-control" value="{{$user->name}}"/>
          </div>

          <div class="form-group">
            <label for="company-name">Gender<span class="required" >*</span></label></br></br>
          
            <label class="radio-inline"><input type="radio" name="gender" value="Male">Male</label>
            <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
          </div>

          <div class="form-group">
            <label for= "company-content">Bio</label>
            <textarea placeholder="Enter Bio" style="resize:vertical" id="company-content" name="bio" rows="5" spellcheck="false" class="form-control autosizze-target text-left  ">{{$user->bio}}</textarea>
          </div>
         
          <div class="form-group">
            <label for= "company-content">Email</label>
            <input placeholder="Enter email" id="email" required name="email" spellcheck="false" class="form-control" value="{{$user->email}}"/>
          </div>
          
          <div class="form-group"> <!-- Date input -->
            <label class="control-label" for="date">Date</label>
            <input class="form-control" id="date_of_birth" name="date_of_birth" value="{{$user->date_of_birth}}" type="date"/>
          </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit"/>

        </div>

 </form>
</div>
@else 
  <script>window.location = "/dashboard";</script>
@endif

 @endsection