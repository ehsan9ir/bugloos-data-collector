<?php

namespace Tests\Feature;

use App\Infrastructure\ResourceData;
use App\Infrastructure\Utilities\Mock;
use App\Infrastructure\ObjectMapper;
use App\Models\User;
use App\Services\WebServiceClient;
use Faker\Provider\Lorem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;
use TCG\Voyager\Models\Post;
use Tests\TestCase;

class DataCollectionFromWebServices extends TestCase
{
    use RefreshDatabase;

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
        $resourceData->parseData(['data' => ['key' => 'list', 'type' => 'JSON']]);
        $this->assertArrayHasKey('list', $resourceData->data[0]);
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
        $resourceData->parseData(['data' => ['key' => 'list', 'type' => 'JSON']]);
        $this->assertArrayHasKey('list', $resourceData->data[0]);

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

    /**
     * @test
     *
     * @return void
     */
    public function testParseJsonNestedFormationAndStoreInDatabase()
    {
        Mock::fakeResponse('https://api.first.org/data/v1/teams', 'OrgApiFirstGetTeams.json');
        $webService = new WebServiceClient('https://api.first.org');

        $response = $webService->call(Request::METHOD_GET, '/data/v1/teams');
        $resourceData = new ResourceData($response);

        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertJson($resourceData->getContent());
        $this->assertIsObject($resourceData->toObject());
        $this->assertObjectHasAttribute('data', $resourceData->getResponse()->object());
        $resourceData->parseData([
            'data.team-full' => ['key' => 'title', 'type' => 'STRING'],
            'data.id' => ['key' => 'slug', 'type' => 'STRING'],
            'data.phone' => ['key' => 'meta_keywords', 'type' => 'JSON'],
            'data.constituency-description' => ['key' => 'body', 'type' => 'STRING'],
            'data.website' => ['key' => 'excerpt', 'type' => 'JSON'],
        ]);

        $this->assertArrayHasKey('title', $resourceData->data[0]);
        $this->assertArrayHasKey('slug', $resourceData->data[0]);
        $this->assertArrayHasKey('meta_keywords', $resourceData->data[0]);
        $this->assertArrayHasKey('body', $resourceData->data[0]);
        $this->assertArrayHasKey('excerpt', $resourceData->data[0]);
        $this->assertArrayNotHasKey('access', $resourceData->data[0]);

        $user = User::factory()->create();
        foreach ($resourceData->data as $item) {
            $objectMapper = new ObjectMapper(Post::class);
            $objectModel = $objectMapper->mapObjectToAttribute($item);
            $objectModel->author_id = $user->id;

            if(!$objectModel->body) {
                $objectModel->body = Lorem::text();
            }

            $objectModel->save();
        }

        $this->assertDatabaseCount('posts', count($resourceData->data));
    }
}
