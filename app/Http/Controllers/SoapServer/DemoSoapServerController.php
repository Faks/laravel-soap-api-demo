<?php

declare(strict_types=1);

namespace App\Http\Controllers\SoapServer;

use App\Http\Controllers\DemoController;
use SoapServer;

class DemoSoapServerController
{
    public function __invoke(): void
    {
        $server = new SoapServer(null, [
                'cache_wsdl' => WSDL_CACHE_NONE,
                'uri' => route('soap.v1.demos')
            ]
        );

        $server->setClass(DemoController::class);

        $server->handle();
    }
}
