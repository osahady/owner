<?php

namespace App\Models\BusinessState;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class BusinessState extends State
{
    abstract public function color(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Free::class)
            ->allowTransition(Plus::class, Premium::class)
            ->allowTransition(Free::class, Premium::class)
            ->allowTransition(Free::class, Plus::class)
            ->allowTransition(Premium::class, Plus::class)
            ->allowTransition(Plus::class, Free::class)
            ->allowTransition(Premium::class, Free::class);
    }
}
