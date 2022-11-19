<?php


namespace App\Infrastructure\Interfaces;


interface DataInterface
{
    public function parseData($formatKeys = ['items' => 'data']): array;

    public function hasStandardFormat($formatKeys = ['items' => 'data']): bool;
}
