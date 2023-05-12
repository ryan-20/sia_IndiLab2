<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'customer';
    // column sa table
    protected $fillable = [
    'customer_name', 'customer_age', 'customer_sex', 'customer_id'
    ];

    public $timestamps = false;
    protected $primaryKey = 'customer_id';
}