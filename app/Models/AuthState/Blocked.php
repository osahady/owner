<?php

namespace App\Models\AuthState;


class Blocked extends AuthState
{
    public static $name = 'blocked';

    public function color(): string
    {
        return '#c0392b'; // red
    }
}
