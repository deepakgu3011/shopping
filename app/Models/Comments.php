<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable=['blog_id','comment','user_id'];

    public function blog(){
        return $this->belongsTo(Blog::class,'blog_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}