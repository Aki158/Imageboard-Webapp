<?php

namespace Database\DataAccess\Interfaces;

use Models\Post;

interface PostDAO {
    public function create(Post $postData): bool;
    public function getById(int $id): ?Post;
    public function update(Post $postData): bool;
    public function delete(int $id): bool;
    public function createOrUpdate(Post $postData): bool;

    /**
     * @param int $offset
     * @param int $limit
     * @return Post[] メインスレッドであるすべての投稿、つまり他の投稿への返信でない投稿、つまりreplyToIDがnullである投稿
     */
    public function getAllThreads(int $offset, int $limit): array;
    
    /**
     * @param Post $postData - すべての返信が属する投稿
     * @param int $offset
     * @param int $limit
     * @return Post[] 本スレッドへの返信であるすべての投稿、つまりreplyToID = $postData->getId()となります。
     */
    public function getReplies(Post $postData, int $offset, int $limit): array;
}