<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'customers';
    // column sa table
    protected $fillable = [
    'customer_name', 'customer_age', 'customer_sex'
    ];

    public $timestamps = false;
    protected $primaryKey = 'customer_id';
}