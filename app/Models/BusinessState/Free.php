<?php

namespace App\Models\BusinessState;

class Free extends BusinessState
{
    public static $name = 'free';

    public function color(): string
    {
        return '#8e44ad'; //purple
    }
}
