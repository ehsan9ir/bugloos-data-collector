<?php

namespace App\Infrastructure\Utilities;

use Illuminate\Support\Facades\Http;

class Mock
{
    public static function fakeResponse($url, $responsePath)
    {
        if (app()->runningUnitTests() && env('APP_DEBUG')) {
            $mockDirectory = base_path() . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR .
                'mock' . DIRECTORY_SEPARATOR;
            $responseFile = file_get_contents($mockDirectory . $responsePath);

            Http::fake([
                $url => Http::response($responseFile)
            ]);
        }
    }
}
