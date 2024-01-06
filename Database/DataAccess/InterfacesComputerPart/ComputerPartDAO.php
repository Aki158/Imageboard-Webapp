<?php

// namespace Database\DataAccess\Interfaces;
namespace Database\DataAccess\InterfacesComputerPart;

use Models\ComputerPart;

interface ComputerPartDAO {
    public function create(ComputerPart $partData): bool;
    public function getById(int $id): ?ComputerPart;
    public function update(ComputerPart $partData): bool;
    public function delete(int $id): bool;
    public function createOrUpdate(ComputerPart $partData): bool;

    public function getRandom(): ?ComputerPart;

    /**
     * @param int $offset
     * @param int $limit
     * @return ComputerPart[]
     */
    public function getAll(int $offset, int $limit): array;

    /**
     * @param string $type
     * @param int $offset
     * @param int $limit
     * @return ComputerPart[]
     */
    public function getAllByType(string $type, int $offset, int $limit): array;
}