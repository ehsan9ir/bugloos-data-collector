<?php

namespace Tests\Feature;

use App\Infrastructure\ResourceData;
use App\Infrastructure\Utilities\Mock;
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
        $resourceData = new ResourceData($response);

        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertJson($resourceData->getContent());
        $this->assertIsObject($resourceData->toObject());
        $this->assertObjectHasAttribute('data', $resourceData->getResponse()->object());
        $this->assertArrayHasKey('list', $resourceData->parseData(['list' => 'data']));
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

        $resourceData = new ResourceData($response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertIsObject($resourceData->toObject());
        $this->assertObjectHasAttribute('data', $resourceData->toObject());
        $this->assertArrayHasKey('list', $resourceData->parseData(['list' => 'data']));

    }

    public function testDetectionOfJsonResponse()
    {
        Mock::fakeResponse('https://api.first.org/data/v1/countries', 'OrgApiFirstGetCountries.json');
        $webService = new WebServiceClient('https://api.first.org');
        $response = $webService->call(Request::METHOD_GET, '/data/v1/countries');

        $resourceData = new ResourceData($response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertEquals('json', $resourceData->getFormat());
    }

    public function testDetectionOfXmlResponse()
    {
        Mock::fakeResponse('https://api.first.org/data/v1/countries.xml', 'OrgApiFirstGetCountries.xml');
        $webService = new WebServiceClient('https://api.first.org');
        $response = $webService->call(Request::METHOD_GET, '/data/v1/countries.xml');

        $resourceData = new ResourceData($response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertEquals('xml', $resourceData->getFormat());
    }
}
