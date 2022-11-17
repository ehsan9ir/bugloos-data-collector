<?php

namespace Tests\Feature;

use App\Services\WebServiceClient;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;

class DataCollectionFromWebServices extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function testCallJsonWebService()
    {
        $webService = new WebServiceClient('https://api.first.org');
        $response = $webService->call(Request::METHOD_GET, '/data/v1/countries');

        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertJson($response->body());
        $this->assertIsObject($response->object());
        $this->assertObjectHasAttribute('data', $response->object());
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCallXmlWebService()
    {
        $webService = new WebServiceClient('https://api.first.org');
        $response = $webService->call(Request::METHOD_GET, '/data/v1/countries.xml', null, 'xml');
        $xmlArray = $webService->xmlToArray($response);

        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertIsArray($xmlArray);
        $this->assertArrayHasKey('data', $xmlArray);
    }
}
