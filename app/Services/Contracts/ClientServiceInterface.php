<?php

namespace App\Services\Contracts;

interface ClientServiceInterface
{
    public function list(?string $name, ?int $perPage): array;

    public function getById(int $id): array;

    public function delete(int $id): array;

    public function blockAndUnblock(int $id): array;
}
