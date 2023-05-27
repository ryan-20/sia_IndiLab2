<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJob extends Model{

    protected $table = 'products';
    // column sa table
    protected $fillable = [
    'product_name'
    ];

    public $timestamps = false;
    protected $primaryKey = 'product_id';
}