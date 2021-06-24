<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Order;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        
        $schedule->call(function(){
            $orders = Order::where('status','new')->orderByDesc('created_at')->get();
            
            foreach($orders as $order){                
                $diff = strtotime(Carbon::now()->format('Y-m-d H:i:s')) - strtotime($order->created_at);
                $hour   = floor($diff / (60 * 60));  
                $minutes = $diff - $hour * (60 * 60);
                $minutes = intval( $minutes / 60 );                           
                if($minutes > 5){
                    Order::find($order->id)->update([
                        'status'=>'cancelled'
                    ]);
                }
                
            }
        })->everyMinute();

        echo "job sukses";
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
