<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogsubscriber extends Model
{
    use HasFactory;
    protected $table='blogsubscribers';
    protected $fillable=['email','status'];


}
