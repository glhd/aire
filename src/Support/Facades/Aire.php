<?php

namespace Galahad\Aire\Support\Facades;

use Galahad\Aire\Elements\Button;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Galahad\Aire\Elements\Form open()
 * @method static \Galahad\Aire\Elements\Form close()
 * @method static \Galahad\Aire\Elements\Button button(string $label)
 */
class Aire extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'galahad.aire';
    }
}
