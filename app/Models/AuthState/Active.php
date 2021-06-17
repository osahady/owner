<?php

namespace App\Models\AuthState;;

class Active extends AuthState
{
    public static $name = 'active';
    public function color(): string
    {
        return '#27ae60'; //green
    }
}
