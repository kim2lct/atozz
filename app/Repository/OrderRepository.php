<?php 

namespace App\Repository;
use Illuminate\Http\Request;

use App\Models\Order;
use Carbon\Carbon;
use Str;

class OrderRepository implements RepositoryInterface{
	public function all(){
		$orders = Order::where('user_id',auth()->user()->id)->orderByDesc('created_at');
        if(request('no_order')){          	      
            $orders->where('no_order','like','%'.request('no_order').'%');
        }
        $orders = $orders->paginate(20)->withQueryString();
        return $orders;
	}

	public function findIdNewRow($id){
		return Order::whereId($id)->where('status','new')->first();        
	}

	public function checkPayment($id){
		$order = Order::find($id);
		$orderTime = trim($order->created_at->format('H'),'0');				
		$probality=0;			
		// check order time for 9.00 to 17.00 for success
		// success 
		if($orderTime >= 9 && $orderTime <= 17){			
			$probality = mt_rand(0,10);
			// for($i=0;$i<=10;$i++){
			// 	if($i == mt_rand(1,10)*1){
			// 		$step[]=$i; 
			// 	}
			// 	if(count($step) == 5){
			// 		break;
			// 	}
			// }
		// failed
		}else{
			// for($i=0;$i<=10;$i++){
			// 	if($i == mt_rand(0,10)*0.1){					
			// 		$step[]=$i; 
			// 	}
			// 	if($step < 5){
			// 		break;
			// 	}
			// }
			$probality = mt_rand(0,mt_rand(0,1));
		}			
		
		return ($probality == 0?false:true);
	}

	public function findUnpaid(){
		return Order::where('status','new')->get();
	}
	


}