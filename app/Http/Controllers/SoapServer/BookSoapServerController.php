<?php

declare(strict_types=1);

namespace App\Http\Controllers\SoapServer;

use App\Http\Controllers\BookController;
use SoapServer;

class BookSoapServerController
{
    public function __invoke(): void
    {
        $server = new SoapServer(null, [
                'cache_wsdl' => WSDL_CACHE_NONE,
                'uri' => route('soap.v1.books')
            ]
        );

        $server->setClass(BookController::class);

        $server->handle();
    }
}
