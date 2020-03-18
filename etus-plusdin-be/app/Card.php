<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'imagem',
        'limit',
        'limit_tax',
        'user_id',
        'brand_id',
        'category_id'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
        'user_id',
        'brand_id',
        'category_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function brand()
    {
        return $this->hasOne('App\Brand','id','brand_id');
    }

    public function Category()
    {
        return $this->hasOne('App\Category','id','category_id');
    }

}
