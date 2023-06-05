<?php

namespace LaravelLatam\Epayco;

use Epayco\Epayco;
class EpaycoClient extends Epayco
{
    public $epayco;
    public function boot()
    {
        /*(array(
            "apiKey" => "YOU_PUBLIC_API_KEY",
            "privateKey" => "YOU_PRIVATE_API_KEY",
            "lenguage" => "ES",
            "test" => true
        ))*/
    }
}
