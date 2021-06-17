<?php

namespace App\Models\AuthState;

class Pending extends AuthState
{
    public static $name = 'pending';

    public function color(): string
    {
        return '#7f8c8d'; //grey
    }
}
