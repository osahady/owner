<?php

namespace App\Models\Media;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * Get all of the video's media.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
