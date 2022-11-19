<?php


namespace App\Infrastructure;


use App\Infrastructure\Abstracts\ObjectResponseAbstract;
use App\Infrastructure\Interfaces\DataInterface;

class ResourceData extends ObjectResponseAbstract implements DataInterface
{
    public function parseData($formatKeys = ['items' => 'data']): array
    {
        $object = $this->toObject();
        $this->data = null;

        if ($object && $this->hasStandardFormat($formatKeys)) {
            foreach ($formatKeys as $key => $value) {
                $this->data[$key] = $object->{$value};
            }
        }

        return $this->data;
    }

    public function hasStandardFormat($formatKeys = ['items' => 'data']): bool
    {
        $object = $this->toObject();
        foreach ($formatKeys as $key => $value) {
            if (!property_exists($object, $value)) {
                return false;
            }
        }

        return true;
    }
}
