@extends('welcome')
@section('title','Login Page')
@section('content')
<form action="{{route('login.index')}}" method="POST">
	@csrf
	@include('success')
	<h1 class="center">Login</h1>
	@error('er')
         <div class="error mt-1">{{$message}}</div>
        @enderror
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
		<input type="submit" value="Login">		
	</div>
	<div class="d-form">
		<a class="p-10 block register center" href="{{route('register.index')}}">Register</a>
	</div>
</form>
@endsection