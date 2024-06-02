<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'is_favorite'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
