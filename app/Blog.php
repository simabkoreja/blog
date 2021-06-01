<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
