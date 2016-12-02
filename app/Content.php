<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isAllowedBy($user)
    {
        return $user->is_admin || $this->user_id === $user->id;
    }
}
