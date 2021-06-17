<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * Get all of the image's media.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
