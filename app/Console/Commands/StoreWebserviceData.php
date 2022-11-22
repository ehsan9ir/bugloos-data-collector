<?php

namespace App\Console\Commands;

use App\Infrastructure\ObjectMapper;
use App\Infrastructure\ResourceData;
use App\Models\Webservice;
use App\Models\WebserviceRequests;
use App\Services\WebServiceClient;
use Illuminate\Console\Command;


class StoreWebserviceData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webservice:store-data' . ' {webserviceId : The webservice id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'call webservice and store data to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $webserviceId = $this->argument('webserviceId');
        $webservice = Webservice::query()->findOrFail($webserviceId);

        $webServiceClient = new WebServiceClient($webservice->url);
        $response = $webServiceClient->call(
            $webservice->request_method,
            '/',
            $webservice->getPayloadArray(),
            $webservice->response_type
        );
        $resourceData = new ResourceData($response);
        $resourceData->parseData($webservice->getResponseTemplateArray());

        $requestModel = WebserviceRequests::query()->create([
            'webservice_id' => $webservice->id,
            'status_code' => $resourceData->getResponse()->status(),
            'is_success' => $resourceData->getResponse()->ok(),
        ]);

        //ToDo use job for reduce speed
        foreach ($resourceData->data as $item) {
            $objectMapper = new ObjectMapper($webservice->storage_model);
            $objectModel = $objectMapper->mapObjectToAttribute($item);
            $objectModel->request_id = $requestModel->id;
            $objectModel->save();
        }

        return Command::SUCCESS;
    }
}
