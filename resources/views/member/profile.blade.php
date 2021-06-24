<div class="flex justify-between aligns-center bg-secondary p-10">

	<div class="flex-1" style="font-size: 13px;">
		<div style="margin-bottom:2px">Hola, <a class="text-none text-user" href="{{url('member-area')}}">{{Auth::user()->name}}</a></div>
		<div class="order-count"><a class="bagde" href="{{url('member-area')}}">{{(new App\Repository\OrderRepository)->findUnpaid()->count()}}</a> unpaid order</div>
	</div>
	<div class="flex-1">
		<nav class="menu">
			<ul class="flex font-12">
				<li><a class="text-primary text-none" href="{{url('member-area/prepaid-balance')}}">Prepaid Balance</a></li>
				<li><a class="text-primary text-none" href="{{url('member-area/product')}}">Product Page</a></li>
			</ul>
		</nav>
	</div>

</div>