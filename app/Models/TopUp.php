<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUp extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'topups';


    public function orders()
    {
        return $this->morphMany(Order::class, 'orderable');
    }

    public function getValueAttribute($value){
        return 'Rp. '.number_format($value,0,'','.');
    }
}
