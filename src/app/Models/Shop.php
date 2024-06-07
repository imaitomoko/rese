<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'category_id',
        'shop_name',
        'detail',
        'image'
    ];
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function scopeAreaSearch($query, $area_id)
    {
        if(!empty($area_id)) {
            $query->where('area_id', $area_id);
        }
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if(!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if(!empty($keyword)) {
            $query->where('shop_name', 'like', '%'. $keyword . '%');
        }
    }

    public function isFavoritedBy($user)
    {
        return Favorite::where('user_id', $user->id)->where('shop_id', $this->id)->exists();
    }
}
