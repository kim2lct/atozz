@extends('welcome')
@section('title','Prepaid Balance Page')
@section('content')
	@include('member.profile')
	<form action="{{route('prepaid-balance.index')}}" method="POST">

	@csrf
	@include('success')
	<h1 class="center">Prepaid Balance</h1>
	@error('er')
         <div class="error mt-1">{{$message}}</div>
        @enderror	
	<div class="d-form">
		<input type="tel" name="mobile_phone" placeholder="Mobile Phone" value="{{old('mobile_phone')}}">
		@error('mobile_phone')
         <div class="error mt-1">{{$message}}</div>
        @enderror		
	</div>
	<div class="d-form">
		<select name="value" placeholder="-Select value-" id="">
			<option value="-">-Select value-</option>
			@foreach([10000,50000,100000] as $val)
				<option value="{{$val}}" {{old('value') == $val ? 'selected' : ''}}>{{$val}}</option>
			@endforeach
		</select>
		@error('value')
         <div class="error mt-1">{{$message}}</div>
        @enderror		
	</div>
	<div class="d-form  mt-1">
		<input type="submit">		
	</div>	
</form>
@endsection