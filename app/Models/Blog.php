<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = ['title', 'description', 'image', 'status',];
    
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}

