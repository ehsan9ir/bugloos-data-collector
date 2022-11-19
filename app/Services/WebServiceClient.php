<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WebServiceClient {

    /** @var string  API base URL */
    private $url;

    /** @var string  API authentication token */
    private $token;

    /**
     * Client constructor.
     *
     * @param string $url
     * @param string|null $token
     */
    public function __construct(string $url, string $token = null)
    {
        $this->url = $url;
        $this->token = $token;
    }

    /**
     * Make a Guzzle call to the specified  API endpoint and retrieve the result
     *
     * @param string $method
     * @param string $endpoint
     * @param array|null $parameters
     * @param string $format
     * @return Response
     */
    public function call(string $method, string $endpoint, $parameters = NULL, string $format = 'json') {
        $contentType = $format == 'json' ? 'application/json' : 'application/xml';
        $headers = [
            'Content-Type' => $contentType,
        ];

        if($this->token){
            $headers['Authorization'] = "Bearer {$this->token}";
        }

        if ($method == 'POST') {
            $response = Http::withHeaders($headers)->post($this->url.$endpoint, $parameters);
        } else {
            $response = Http::withHeaders($headers)->get($this->url.$endpoint, $parameters);
        }

        return $response;
    }
}
