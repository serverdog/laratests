<?php

namespace serverdog\laratests\Facades;

use Illuminate\Support\Facades\Facade;

class laratests extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laratests';
    }
}
