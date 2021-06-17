<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    /**
     * Get all of the audio's media.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
