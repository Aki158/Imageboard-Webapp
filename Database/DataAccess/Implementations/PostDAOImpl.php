<?php

namespace Database\DataAccess\Implementations;

use Database\DataAccess\Interfaces\PostDAO;
use Database\DatabaseManager;
use Models\Post;
use Models\DataTimeStamp;

class PostDAOImpl implements PostDAO
{
    private ?int $post_id = null;

    public function create(Post $postData): bool
    {
        if($postData->getPostId() !== null) throw new \Exception('Cannot create a post with an existing ID. id: ' . $postData->getPostId());
        return $this->createOrUpdate($postData);
    }
    public function getById(int $id): ?Post{
        $mysqli = DatabaseManager::getMysqliConnection();
        $post = $mysqli->prepareAndFetchAll("SELECT * FROM Post WHERE post_id = ?",'i',[$id])[0]??null;

        return $post === null ? null : $this->resultToPost($post);
    }
    public function update(Post $postData): bool{
        if($postData->getPostId() === null) throw new \Exception('Post specified has no ID.');

        $current = $this->getById($postData->getPostId());
        if($current === null) throw new \Exception(sprintf("Post %s does not exist.", $postData->getPostId()));

        return $this->createOrUpdate($postData);
    }
    public function delete(int $id): bool{
        $mysqli = DatabaseManager::getMysqliConnection();
        return $mysqli->prepareAndExecute("DELETE FROM post WHERE id = ?", 'i', [$id]);
    }
    public function createOrUpdate(Post $postData): bool{
        $mysqli = DatabaseManager::getMysqliConnection();

        $query =
        <<<SQL
            INSERT INTO Post (post_id, reply_to_id, subject, content, image_path, thumbnail_path, url)
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE post_id = ?,
            post_id = VALUES(post_id),
            reply_to_id = VALUES(reply_to_id),
            subject = VALUES(subject),
            content = VALUES(content),
            image_path = VALUES(image_path),
            thumbnail_path = VALUES(thumbnail_path),
            url = VALUES(url)
        SQL;

        $result = $mysqli->prepareAndExecute(
            $query,
            'iisssssi',
            [
                $postData->getPostId(), // on null ID, mysql will use auto-increment.
                $postData->getReplyToId(),
                $postData->getSubject(),
                $postData->getContent(),
                $postData->getImagePath(),
                $postData->getThumbnailPath(),
                $postData->getUrl(),
                $postData->getPostId()
            ],
        );

        if(!$result) return false;

        // insert_id returns the last inserted ID.
        if($postData->getPostId() === null){
            $postData->setPostId($mysqli->insert_id);
            $this->setCreateOrUpdateId($mysqli->insert_id);
            $timeStamp = $postData->getTimeStamp()??new DataTimeStamp(date('Y-m-h'), date('Y-m-h'));
            $postData->setTimeStamp($timeStamp);
        }
        else{
            $this->setCreateOrUpdateId($postData->getPostId());
        }

        return true;
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return Post[] メインスレッドであるすべての投稿、つまり他の投稿への返信でない投稿、つまりreplyToIDがnullである投稿
     */
    public function getAllThreads(int $offset, int $limit): array{
        $mysqli = DatabaseManager::getMysqliConnection();

        $query = "SELECT * FROM Post WHERE reply_to_id IS NULL ORDER BY created_at DESC LIMIT ?, ?";

        $results = $mysqli->prepareAndFetchAll($query, 'ii', [$offset, $limit]);

        return $results === null ? [] : $this->resultsToPosts($results);
    }
    
    /**
     * @param Post $postData - すべての返信が属する投稿
     * @param int $offset
     * @param int $limit
     * @return Post[] 本スレッドへの返信であるすべての投稿、つまりreplyToID = $postData->getId()となります。
     */
    public function getReplies(Post $postData, int $offset, int $limit): array{
        $mysqli = DatabaseManager::getMysqliConnection();

        $query = "SELECT * FROM Post WHERE reply_to_id = ? LIMIT ?, ?";

        $results = $mysqli->prepareAndFetchAll($query, 'iii', [$postData->getPostId(), $offset, $limit]);

        return $results === null ? [] : $this->resultsToPosts($results);        
    }
    
    private function resultsToPosts(array $results): array{
        $posts = [];

        foreach($results as $result){
            $posts[] = $this->resultToPost($result);
        }
        return $posts;
    }

    private function resultToPost(array $data): Post{
        return new Post(
            post_id: $data['post_id'],
            reply_to_id: $data['reply_to_id'],
            subject: $data['subject'],
            content: $data['content'],
            image_path: $data['image_path'],
            thumbnail_path: $data['thumbnail_path'],
            url: $data['url'],
            timeStamp: new DataTimeStamp($data['created_at'], $data['updated_at'])
        );
    }

    public function getThread(string $url): ?Post{
        $mysqli = DatabaseManager::getMysqliConnection();

        $post = $mysqli->prepareAndFetchAll("SELECT * FROM Post WHERE url = ?",'s',[$url])[0]??null;

        return $post === null ? null : $this->resultToPost($post);
    }

    public function getReply(string $postId): ?Post{
        $mysqli = DatabaseManager::getMysqliConnection();

        $post = $mysqli->prepareAndFetchAll("SELECT * FROM Post WHERE post_id = ?",'s',[$postId])[0]??null;

        return $post === null ? null : $this->resultToPost($post);
    }

    public function getCreateOrUpdateId(): ?int {
        return $this->post_id;
    }

    public function setCreateOrUpdateId(int $id): void {
        $this->post_id = $id;
    }
}