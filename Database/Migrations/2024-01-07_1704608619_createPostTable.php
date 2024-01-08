<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class createPostTable implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE Post (
                post_id INT PRIMARY KEY AUTO_INCREMENT,
                reply_to_id INT,
                subject VARCHAR(255),
                content TEXT,
                image_path VARCHAR(255),
                thumbnail_path VARCHAR(255),
                url VARCHAR(255) NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )"
        ];
    }

    public function down(): array
    {
        return [
            "DROP TABLE Post"
        ];
    }
}