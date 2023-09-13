<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false; 
    protected $table = 'shipping';
    protected $primaryKey = 'id';
    protected $fillable = [
        'shipping_method',
        'shipping_price'
    ];
}