<?php

namespace App\Models\BusinessState;

class Premium extends BusinessState
{
    public static $name = 'premium';

    public function color(): string
    {
        return '#2c3e50'; //midnight
    }
}
