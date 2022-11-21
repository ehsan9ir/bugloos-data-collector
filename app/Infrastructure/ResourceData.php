<?php


namespace App\Infrastructure;


use App\Infrastructure\Abstracts\ObjectResponseAbstract;
use App\Infrastructure\Interfaces\DataInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class ResourceData extends ObjectResponseAbstract implements DataInterface
{
    public function parseData($formatKeys = ['data' => ['key' => 'item', 'type' => 'JSON']]): array
    {
        $object = $this->toObject();
        $this->data = [];

        if ($object && $this->hasStandardFormat($formatKeys)) {
            $mappedKeys = $this->getMappedKeys($formatKeys, $object);

            $duplicatedIndexValues = [];
            foreach ($mappedKeys as $key => $indexes) {
                if (is_array($object->{$key}) || is_object($object->{$key})) {
                    $i = 0;
                    foreach ($object->{$key} as $item) {

                        foreach ($indexes as $keyIndex => $valIndex) {
                            $this->data[$i][$keyIndex] =
                                $this->getValueWithKeyFormation($valIndex, $item, $key, $formatKeys);
                        }

                        foreach ($duplicatedIndexValues as $duplicatedIndexValue) {
                            $this->data[$i][$duplicatedIndexValue['key']] = $duplicatedIndexValue['value'];
                        }

                        $i++;
                    }
                } else {
                    $duplicatedIndexValues[] = [
                        'key' => array_key_first($indexes),
                        'value' => isset($object->{$key}) ? $object->{$key} : null,
                    ];
                    $this->data[][array_key_first($indexes)] = isset($object->{$key}) ? $object->{$key} : null;
                }
            }
        }

        return $this->data;
    }

    public function hasStandardFormat($formatKeys = ['data' => ['key' => 'item', 'type' => 'JSON']]): bool
    {
        $object = $this->toObject();
        foreach ($formatKeys as $key => $value) {
            $nestedArray = explode('.', $key);
            if (count($nestedArray) > 1 && !$nestedArray[1] == '{}') {
                if (!is_array($object->{$nestedArray[0]}) &&
                    !property_exists($object->{$nestedArray[0]}[0], $nestedArray[1])) {
                    return false;
                }
            } else {
                if (!property_exists($object, $nestedArray[0])) {
                    Log::error('format for parsing not valid: ', [$key, $object]);
                    return false;
                }
            }
        }

        return true;
    }

    private function convert($value, string $keyIndex, $formatKeys): mixed
    {
        if($formatKeys[$keyIndex]['type'] == 'JSON') {
            return json_encode($value);
        }

        return $value;
    }

    /**
     * @param array $formatKeys
     * @param object $object
     * @return array
     */
    private function getMappedKeys(array $formatKeys, object $object): array
    {
        $mappedKeys = [];
        foreach ($formatKeys as $key => $value) {
            $nestedArray = explode('.', $key);
            if (count($nestedArray) > 1 && is_array($object->{$nestedArray[0]})) {
                $mappedKeys[$nestedArray[0]][$value['key']] = $nestedArray[1];
            } else if (count($nestedArray) > 1 && str_starts_with($nestedArray[1], '{') &&
                    is_object($object->{$nestedArray[0]})) {
                $mappedKeys[$nestedArray[0]][$value['key']] = $nestedArray[1];
            } else {
                $mappedKeys[$nestedArray[0]] = [$value['key'] => $key];
            }
        }
        return $mappedKeys;
    }

    /**
     * @param mixed $valIndex
     * @param mixed $item
     * @param int|string $key
     * @param array $formatKeys
     */
    private function getValueWithKeyFormation(mixed $valIndex, mixed $item, int|string $key, array $formatKeys)
    {
        if($rawIndex = $this->hasIndexOfObjectType($valIndex)) {
            $value = $rawIndex != '$this' && property_exists($item, $rawIndex)
                ? $item->{$rawIndex} : $item;
            return $this->convert($value, "$key.$valIndex", $formatKeys);
        }
        return isset($item->{$valIndex}) ?
            $this->convert($item->{$valIndex}, "$key.$valIndex", $formatKeys) : null;
    }

    /**
     * @param mixed $valIndex
     * @return string|null
     */
    private function hasIndexOfObjectType(mixed $valIndex): ?string
    {
        if (str_starts_with($valIndex, '{') && str_ends_with($valIndex, '}')) {
            $rawIndex = str_replace(['{', '}'], '', $valIndex);

            return $rawIndex != "" ? $rawIndex : '$this';
        }

        return null;
    }
}
