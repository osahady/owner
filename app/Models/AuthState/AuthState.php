<?php

namespace App\Models\AuthState;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;


abstract class AuthState extends State
{
    abstract public function color(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Active::class)
            ->allowTransition(Fake::class, Active::class)
            ->allowTransition(Blocked::class, Active::class)
            ->allowTransition(Pending::class, Fake::class)
            ->allowTransition(Active::class, Blocked::class);
    }
}
