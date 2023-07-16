<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class DemoController extends Controller
{
    /**
     * @soap
     * @return string
     */
    public function hello(): string
    {
        return 'hello friend';
    }
}
