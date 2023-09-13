<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false; 
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'quantity',
        'order_price'
    ];
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
