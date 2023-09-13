<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $timestamps = false; 
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'category',
        'price',
        'condition'];
}
