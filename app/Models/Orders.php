<?php

namespace App\Models;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Orders extends Model
{
    public $timestamps = false; 
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status',
        'if_paid',
        'order_date',
        'comment',
        'gift'
    ];
    public function order_details()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
