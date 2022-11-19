<?php


namespace App\Infrastructure\Abstracts;


use Illuminate\Http\Client\Response;

abstract class WebServiceResponseAbstract
{
    protected Response $response;
    protected string $content;
    public $data;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->content = $response->body();
    }

    /**
     * @return object
     */
    abstract public function toObject(): object;


    public function getFormat(): string
    {
        return $this->isXml() ? 'xml' : 'json';
    }


    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    private function isXml(): bool
    {
        return is_null($this->response->object()) &&
            (str_contains($this->content, '<?xml') or str_starts_with($this->content, '<'));
    }

}
