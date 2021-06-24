<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Order extends Model
{
    use HasFactory,SoftDeletes;

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

    public function mappingData($data){
        $price = $this->convertToNumber($data->price??$data->value);
        $inRupiah = $data->price??$data->value;
        $item = $data->mobile_number??$data->product;
        return json_encode([
            'id'=>$data->id,
            'data'=>$item,
            'price'=>$price,
            'priceInRupiah'=>$inRupiah,
            'total'=>$data->price?$price:$price+=$price*.05,
            'totalInRupiah'=>$data->price?$inRupiah:$this->convertRp($price),
            'address'=>$data->shipping_address??''
        ]);
    }

        public function convertRP($value){
            return 'Rp. '.number_format($value,0,'','.');
        }

        public function convertToNumber($value){
            return intval(preg_replace('/[^0-9]/', '', $value));
        }



}
