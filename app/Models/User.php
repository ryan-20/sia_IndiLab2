<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'student';
    // column sa table
    protected $fillable = [
    'student_name', 'student_age', 'student_sex'
    ];

    public $timestamps = false;
    protected $primaryKey = 'customer_id';
}