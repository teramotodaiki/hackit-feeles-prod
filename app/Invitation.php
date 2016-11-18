<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use SoftDeletes;

    protected $casts = [
        'id' => 'integer',
    ];
    
    protected $fillable = ['expired_at'];
    protected $dates = ['expired_at', 'deleted_at'];
}
