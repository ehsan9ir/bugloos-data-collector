<?php


namespace App\Infrastructure\Abstracts;


use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

abstract class ObjectResponseAbstract extends WebServiceResponseAbstract
{
    public function toObject(): object
    {
        return $this->getFormat() == 'json' ?
            $this->getResponse()->object() : $this->xmlToObject($this->getResponse());
    }

    /**
     * @param PromiseInterface|Response $response
     * @return mixed
     */
    private function xmlToObject(PromiseInterface|Response $response): mixed
    {
        $xml = simplexml_load_string($response->body());
        $json = json_encode($xml);

        return json_decode($json, false);
    }
}
