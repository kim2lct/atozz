@extends('welcome')
@section('title','Register Page')
@section('content')
<form action="{{route('register.index')}}" method="POST">
    @csrf    
    <h1 class="center">Register</h1>
    <div class="d-form">        
        <input type="text" name="name" placeholder="Name" value="{{old('name')}}">
        @error('name')
         <div class="error mt-1">{{$message}}</div>
        @enderror
    </div>
    <div class="d-form">        
        <input type="email" name="email" placeholder="Email" value="{{old('email')}}">
        @error('email')
         <div class="error mt-1">{{$message}}</div>
        @enderror
    </div>
    <div class="d-form">
        <input type="password" name="password" placeholder="Password">     
        @error('password')
         <div class="error mt-1">{{$message}}</div>
        @enderror 
    </div>
    <div class="d-form  mt-1">
        <input type="submit" value="Register">     
    </div>
    <div class="d-form">
        <a class="p-10 block register center" href="{{route('login.index')}}">Login</a>
    </div>

</form>
@endsection