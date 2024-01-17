<?php

namespace Database\Seeds;

use Faker\Factory;

use Database\AbstractSeeder;

class PostSeeder1_Thread extends AbstractSeeder {
    protected ?string $tableName = 'Post';

    protected array $tableColumns = [
        [
            'data_type' => 'string',
            'column_name' => 'subject'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'content'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'image_path'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'thumbnail_path'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'url'
        ]
    ];

    public function createRowData(string $imagePath, string $thumbnailPath, string $url): array
    {
        $faker = Factory::create();

        return [
            [
                $faker->realText(50),
                $faker->realText(400),
                $imagePath,
                $thumbnailPath,
                $url
            ]
        ];
    }
}