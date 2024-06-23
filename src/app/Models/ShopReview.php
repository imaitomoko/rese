<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopReview extends Model
{
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;

    protected $fillable = ['shop_id', 'user_id', 'starts', 'comment'];
}
