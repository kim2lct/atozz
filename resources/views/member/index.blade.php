@extends('welcome')
@section('title','Member Area Page')
@section('content')

	@include('member.profile')
	@include('success')
	<h1>Order History</h1>
	<form action="" method="GET">	
	<div class="d-form">
		<input type="number" name="no_order" placeholder="Search by Order no" value="{{request('no_order')}}">		
	</div>	
	<div class="history">
	@forelse($orders as $order)	
		@php
			if($order->orderable_type == 'App\Models\Product'){
				$product =$order->orderable->product.' that costs '.$order->orderable->price;
				$type = 'product';						
			}else{
				$type = 'topup';
				$product = $order->orderable->value.' for '.$order->orderable->mobile_number;				
			}
		@endphp
		<div class="show flex justify-between aligns-center">	
			<div class="p-1" style="width: 66.6%;">
				<div class="mb-1"><ul class="none_strip flex justify-between text-default"><li>{{$order->getOrder($order->no_order)}}</li><li>{{(new \App\Models\Order)->convertRp($order->price)}}</li></ul></div>
				<div>
					<strong>{{$product}}</strong>
				</div>
			</div>
			
			<div class="p-1">
				@if($order->status == 'new')
					<a href="{{url('member-area/payment/'.$order->id)}}" class="pay">Pay now</a>
				@else
					<div class="status {{$order->status}}" style="text-align:right"><strong>{{$order->statusText($order->shipping_code,$order->status)}}</strong></div>
				@endif

			</div>

			
		</div>
	@empty
		<div class="empty">
			No Order history
		</div>
	@endforelse
	{{$orders->links()}}
	</div>
	
	</form>
	
		
@endsection