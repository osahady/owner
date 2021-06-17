<?php

namespace App\Models\BusinessState;

class Plus extends BusinessState
{
    public static $name = 'plus';

    public function color(): string
    {
        return '#2980b9'; //plus
    }
}
