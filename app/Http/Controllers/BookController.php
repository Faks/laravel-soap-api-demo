<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use stdClass;

class BookController extends Controller
{
    private array $books = [
        [
            'id' => '5409',
            'name' => 'Programming for Dummies',
            'year' => 2011,
            'price' => '12.09'
        ],
        [
            'id' => '2311',
            'name' => 'Project Management 101',
            'year' => 2017,
            'price' => '20.09'
        ],
        [
            'id' => '98777',
            'name' => 'Rust Development',
            'year' => 2020,
            'price' => '32.09'
        ],
    ];

    /**
     * @soap
     * @param string $id
     * @return mixed
     */
    public function year(string $id): mixed
    {
        $validator = Validator::make(
            [
                'id' => $id
            ],
            [
                'id' => [
                    'required',
                    'string',
                    'min:1',
                    'max:255'
                ],
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->toArray();
        }

        foreach ($this->books as $bk) {
            if ($bk['id'] === $id) {
                return $bk['year'];
            }
        }

        return 'Not found';
    }

    /**
     * @soap
     */
    public function details(string|stdClass $object): mixed
    {
        $validator = Validator::make(
            (array)$object,
            [
                'title' => [
                    'required',
                    'string',
                    'min:1',
                    'max:255'
                ],
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->toArray();
        }

        foreach ($this->books as $book) {
            if ($book['name'] === $object?->title) {
                return $book;
            }
        }

        return 'Not found';
    }
}
