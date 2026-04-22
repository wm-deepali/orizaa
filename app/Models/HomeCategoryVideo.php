<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCategoryVideo extends Model
{
    protected $fillable = [
        'title',
        'video',
        'link',
        'order',
        'status'
    ];
}