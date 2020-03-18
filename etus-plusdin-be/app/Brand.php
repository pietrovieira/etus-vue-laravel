<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}
