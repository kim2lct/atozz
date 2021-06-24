@extends('welcome')
@section('title','Product Page')
@section('content')
	@include('member.profile')
	<form action="{{route('product.index')}}" method="POST">
	@csrf
	@include('success')
	<h1 class="center">Product Page</h1>
	@error('er')
         <div class="error mt-1">{{$message}}</div>
        @enderror
	<div class="d-form">	
		<textarea name="product" id="product" cols="30" rows="5" placeholder="Product">{{old('product')}}</textarea>			
		@error('product')
         <div class="error mt-1">{{$message}}</div>
        @enderror
	</div>
	<div class="d-form">
		<textarea name="shipping_address" id="shipping_address" cols="30" rows="5" placeholder="Shipping Address">{{old('shipping_address')}}</textarea>			
		@error('shipping_address')
         <div class="error mt-1">{{$message}}</div>
        @enderror		
	</div>
	<div class="d-form">
		<input type="number" name="price" placeholder="Price" value="{{old('price')}}">
		@error('price')
         <div class="error mt-1">{{$message}}</div>
        @enderror		
	</div>
	<div class="d-form  mt-1">
		<input type="submit">		
	</div>	
</form>
@endsection