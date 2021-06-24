<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Carbon\Carbon;

class OrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {                       
        $this->order = $order;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {    
        if(strtotime($this->order->created_at) > strtotime("10 seconds")){
            $this->order->update([
                'status'=>'cancelled'
            ]);
        }
        
    }
}
