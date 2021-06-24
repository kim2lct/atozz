@extends('welcome')
@section('title','Product Page')
@section('content')
<form action="{{route('order.update',$order->id)}}" method="POST">
	@csrf
	@method('PATCH')	
	@include('member.profile')
	<h1>Pay Your Order</h1>
	<div class="d-form">			
		<input type="text" name="no_order" placeholder="Order no." value="{{chunk_split($order->no_order,4,' ')}}" readonly="">		
	</div>	
	
	<div class="d-form  mt-1">
		<input type="submit" value="Pay Now">		
	</div>
	
</form>
@endsection