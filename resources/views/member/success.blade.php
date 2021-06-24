@extends('welcome')
@section('title','Create Order Success')
@section('content')
<form action="{{route('order.index')}}" method="POST">
	@csrf	
	@include('member.profile')
	<div class="orderPage">
		@include('success')
	</div>
	<div class="text-default">
	<div class="d-form-clean flex justify-between">	
		<label for="order_no"><strong>Order no.</strong></label>	
		<input type="text" name="no_order" value="{{chunk_split($data['no_order'],4,' ')}}" readonly="">			
	</div>
	<div class="d-form-clean flex justify-between">
		<label for="total"><strong>Total</strong></label>	
		<input type="total" name="total" value="{{$data['data']->value??$data['data']->price}}" readonly="">			
	</div>
	<br>
	<div class="d-form my-10">
	@if($data['type'] <> 'product')	
		Your mobile phone {{$data['data']->mobile_number}} will received {{$data['data']->value}}		
	@else
		{{$data['data']->product}} that costs {{$data['data']->price}} will be shipped to:
		<div class="shipped mt-1">
			{{$data['data']->shipping_address}}
		</div>
		<div class="only mt-1">
			only after you pay
		</div>	
	@endif
	</div>
	<div class="d-form  mt-1">
		<input type="submit">	
		<input type="hidden" name="{{$data['type']}}" value="{{$data['data']->id}}"/>			
	</div>
	</div>
	
</form>
@endsection