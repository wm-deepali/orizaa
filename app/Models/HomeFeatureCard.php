<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFeatureCard extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'button_text',
        'link'
    ];
}
