<?php

namespace App\Services\Search\Contracts;

interface SearchStrategyInterface
{
    public function supports(string $type): bool;

    public function search(array $filters): mixed;
}
