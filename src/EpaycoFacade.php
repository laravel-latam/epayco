<?php

namespace LaravelLatam\Epayco;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelLatam\Epayco\Epayco
 */
class EpaycoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'epayco';
    }
}
