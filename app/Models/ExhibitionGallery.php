<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionGallery extends Model
{
    protected $fillable = [
        'exhibition_id',
        'image'
    ];

    /**
     * Relation: Gallery belongs to exhibition
     */
    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class);
    }
}