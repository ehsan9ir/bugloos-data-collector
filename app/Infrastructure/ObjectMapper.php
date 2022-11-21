<?php


namespace App\Infrastructure;


class ObjectMapper
{

    protected string $modelClass = '';

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function mapObjectToAttribute(array $values)
    {
        $object = new $this->modelClass();
        foreach ($values as $key => $value) {
            $object->{$key} = $value;
        }
        return $object;
    }

}
