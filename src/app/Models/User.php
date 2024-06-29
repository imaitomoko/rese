<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //多対多のりレーションを描く
    public function favorites(){
        return $this->belongsToMany('App\Models\Shop','favorites','user_id','shop_id')->withTimestamps();
    }
    //この店に対してすでにfavoriteしたかどうかを判別
    public function isFavorite($shopId){
        return $this->favorite()->where('shop_id',$shopId)->exists();
    }
    //isFavoriteを使って、すでにfavoriteしたか確認したと、いいねする
    public function favorite($shopId){
        if($this->isFavorite($shopId)){
            //もしすでにお気に入りしてたら何もしない
        } else {
            $this->favorites()->attach($shopId);
        }
    }

    //isFavoriteを使って、すでにfavoriteしたか確認して、もししていたら解除する
    public function unfavorite($shopId){
        if($this->isFavorite($shopId)){
            $this->favorite()->detach($shopId);
        } else {

        }
    }
    public function reservations(){
        return $this->hasMany('App\Models\Rreservation');
    }
}
