<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false; 
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    protected $fillable = [
        'quantity',
    ];
}
