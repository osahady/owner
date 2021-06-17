<?php

namespace App\Models\AuthState;


class Fake extends AuthState
{
    public static $name = 'fake';

    public function color(): string
    {
        return '#d35400'; //orange
    }
}
