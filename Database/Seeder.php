<?php

namespace Database;

interface Seeder
{
    public function seed(string $imagePath, string $thumbnailPath, string $url): void;

    public function createRowData(string $imagePath, string $thumbnailPath, string $url): array;
}