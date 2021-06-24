<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderable(){
        return $this->morphTo();
    }

    public function product(){
        return $this->belongsTo(Product::class,'orderable_id');
    }

    public function generate($length=10){
        $number = '';        
        
        for($i=0;$i<$length;$i++){                       
            $number = $number.strval(rand(0,9));
        }

        return $number;
    }

    public function getOrder($noOrder){
        return chunk_split($noOrder,4,' ');
    }

    public function statusText($shipcode=null,$status){
        switch ($status) {
            case 'shipping':
                return 'shipping code '.Str::upper($shipcode);
                break;            
            default:
                return Str::title($status);
                break;
        }
    }

    public function generateShipcode(){
        return strtoupper(Str::substr(Str::uuid(),0,8));
    }
}
