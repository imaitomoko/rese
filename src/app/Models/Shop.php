<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany('App\Models\Reservation');
    }

    public function favorites(){
        return $this->hasMany('App\Models\Favorite');
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
}
