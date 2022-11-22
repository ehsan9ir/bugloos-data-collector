<?php

namespace Tests\Feature;

use App\Infrastructure\ResourceData;
use App\Infrastructure\Utilities\Mock;
use App\Infrastructure\ObjectMapper;
use App\Models\GeneralDataResponses;
use App\Models\User;
use App\Models\Webservice;
use App\Models\WebserviceRequests;
use App\Services\WebServiceClient;
use Faker\Provider\Lorem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Request;
use TCG\Voyager\Models\Post;
use Tests\TestCase;

class DataStoreWithLaravelScheduler extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function testStoreObjectIndexUseScheduler()
    {
        $this->artisan('migrate:fresh');
        Mock::fakeResponse('https://api.first.org/data/v1/countries/', 'OrgApiFirstGetCountries.json');
        $webService = new WebServiceClient('https://api.first.org');
        $response = $webService->call(Request::METHOD_GET, '/data/v1/countries');

        $resourceData = new ResourceData($response);
        $templateArray = [
            'data.{}' => ['key' => 'data', 'type' => 'JSON'],
        ];
        $resourceData->parseData($templateArray);

        $templateArray = [
            'data.{}' => ['key' => 'data', 'type' => 'JSON'],
        ];

        Webservice::factory()->create([
            'response_template' => json_encode($templateArray),
            'url' => 'https://api.first.org/data/v1/countries',
            'request_method' => Request::METHOD_GET,
            'response_type' => Webservice::JSON_TYPE_RESPONSE,
            'schedule_frequency' => 'everyMinute()',
            'storage_model' => GeneralDataResponses::class,
        ]);

        $this->travelTo('2022-11-24 01:59:30');
        $this->artisan('schedule:run');

        $this->assertDatabaseCount('general_data_responses', count($resourceData->data));
    }
}
