<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    /**
     * Get all of the ads for the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }
}
