<?php

use Helpers\Generations;
use Helpers\ValidationHelper;
use Models\Post;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Database\DataAccess\Implementations\PostDAOImpl;
use Response\Render\JSONRenderer;
use Types\ValueType;

return [
    '' => function(): HTMLRenderer {
        $postDao = new PostDAOImpl();
        $threads = $postDao->getAllThreads(0, 100);
        $threadsData = [];
        $replies = null;
        $repliesData = [];

        for($i = 0; $i < count($threads); $i++){
            $replies = $postDao->getReplies($threads[$i], 0, 100);
            $repliyNum = count($replies) < 5 ? count($replies) : 5;
            $threadsData[] = [
                "count" => count($replies),
                "subject" => htmlspecialchars($threads[$i]->getSubject()),
                "content" => nl2br(htmlspecialchars($threads[$i]->getContent())),
                "image_path" => $threads[$i]->getImagePath(),
                "thumbnail_path" => $threads[$i]->getThumbnailPath(),
                "url" => $threads[$i]->getUrl(),
                "created_at" => $threads[$i]->getTimeStamp()->getCreatedAt()                
            ];

            for($j = 0; $j < $repliyNum; $j++){
                $repliesData[$i][$j] = [
                    "content" => nl2br(htmlspecialchars($replies[$j]->getContent())),
                    "image_path" => $replies[$j]->getImagePath(),
                    "thumbnail_path" => $replies[$j]->getThumbnailPath(),
                    "created_at" => $replies[$j]->getTimeStamp()->getCreatedAt()
                ];
            }
        }

        $posts = [
            "threads" => $threadsData,
            "replies" => $repliesData
        ];

        return new HTMLRenderer('component/home', ['posts'=>$posts]);
    },
    'newThread'=>function(): HTTPRenderer{
        return new HTMLRenderer('component/newThread', [''=>null]);
    },
    'form/create/thread' => function(): HTTPRenderer {
        try {
            // リクエストメソッドがPOSTかどうかをチェックします
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method!');
            }

            $subject = $_POST['subject'];
            $required_fields = [
                'subject' => ValueType::STRING,
                'content' => ValueType::STRING,
                'file' => ValueType::FILE
            ];

            // subjectは、任意入力なので値がなければValueTypeをnullに変更する
            if(!isset($subject) || $subject === ''){
                $required_fields['subject'] = ValueType::NULL;
            }

            $postDao = new PostDAOImpl();

            // 入力に対する単純なバリデーション。実際のシナリオでは、要件を満たす完全なバリデーションが必要になることがあります。
            $validatedData = ValidationHelper::validateFields($required_fields, $_POST, $_FILES, "thread");

            // 名前付き引数を持つ新しいPostオブジェクトの作成
            $post = new Post(null, null, $validatedData['subject'], $validatedData['content'], $validatedData['file']['image_path'], $validatedData['file']['thumbnail_path'], Generations::url(hash("sha1",date("Y-m-d H:i:s"))));

            error_log(json_encode($post->toArray(), JSON_PRETTY_PRINT));

            // データベースの作成を試みます。
            $success = $postDao->create($post);

            if (!$success) {
                throw new Exception('Database update failed!');
            }

            return new JSONRenderer(['status' => 'success', 'message' => 'Post updated successfully']);
        } catch (\InvalidArgumentException $e) {
            error_log($e->getMessage()); // エラーログはPHPのログやstdoutから見ることができます。
            return new JSONRenderer(['status' => 'error', 'message' => $e->getMessage()]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return new JSONRenderer(['status' => 'error', 'message' => $e->getMessage()]);
        }
    },
    'thread' => function(): HTMLRenderer {
        $protocol= isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = $protocol.$host.$uri;
        $postDao = new PostDAOImpl();
        $thread = $postDao->getThread($url);
        $replies = null;
        $threadData = [];
        $repliesData = [];

        if(isset($thread)){
            $replies = $postDao->getReplies($thread, 0, 100);

            $threadData = [
                "post_id" => $thread->getPostId(),
                "subject" => htmlspecialchars($thread->getSubject()),
                "content" => nl2br(htmlspecialchars($thread->getContent())),
                "image_path" => $thread->getImagePath(),
                "thumbnail_path" => $thread->getThumbnailPath(),
                "url" => $thread->getUrl(),
                "created_at" => $thread->getTimeStamp()->getCreatedAt()                
            ];
        }

        foreach($replies as $reply){
            $repliesData[] = [
                "content" => nl2br(htmlspecialchars($reply->getContent())),
                "image_path" => $reply->getImagePath(),
                "thumbnail_path" => $reply->getThumbnailPath(),
                "created_at" => $reply->getTimeStamp()->getCreatedAt()
            ];
        }

        $posts = [
            "thread" => $threadData,
            "replies" => $repliesData
        ];

        return new HTMLRenderer('component/thread', ['posts'=>$posts]);
    },
    'form/create/reply' => function(): HTTPRenderer {
        try {
            // リクエストメソッドがPOSTかどうかをチェックします
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method!');
            }

            $content = $_POST['content'];
            $filename = $_FILES['file']['name'];
            $required_fields = [
                'postId' => ValueType::INT,
                'content' => ValueType::STRING,
                'file' => ValueType::FILE
            ];

            // スレッドへの返信は、contentとfileのどちらかの入力が必須
            if($content === '' && $filename !== ''){
                $required_fields['content'] = ValueType::NULL;
            }
            else if($content !== '' && $filename === ''){
                $required_fields['file'] = ValueType::NULL;
            }

            $postDao = new PostDAOImpl();

            // 入力に対する単純なバリデーション。実際のシナリオでは、要件を満たす完全なバリデーションが必要になることがあります。
            $validatedData = ValidationHelper::validateFields($required_fields, $_POST, $_FILES, "reply");

            // 名前付き引数を持つ新しいPostオブジェクトの作成
            if($required_fields['file'] === ValueType::NULL){
                $post = new Post(null, $validatedData['postId'], null, $validatedData['content'], null, null, null);
            }else{
                $post = new Post(null, $validatedData['postId'], null, $validatedData['content'], $validatedData['file']['image_path'], $validatedData['file']['thumbnail_path'], null);
            }

            error_log(json_encode($post->toArray(), JSON_PRETTY_PRINT));

            // データベースの作成を試みます。
            $success = $postDao->create($post);

            if (!$success) {
                throw new Exception('Database update failed!');
            }

            $postId = $postDao->getCreateOrUpdateId();

            if(isset($postId)){
                $reply = $postDao->getReply($postId);
            }

            $replyData = [
                "count" => 0,
                "content" => nl2br(htmlspecialchars($reply->getContent())),
                "image_path" => $reply->getImagePath(),
                "thumbnail_path" => $reply->getThumbnailPath(),
                "created_at" => $reply->getTimeStamp()->getCreatedAt()
            ];

            return new JSONRenderer(['status' => 'success', 'message' => $replyData]);
        } catch (\InvalidArgumentException $e) {
            error_log($e->getMessage()); // エラーログはPHPのログやstdoutから見ることができます。
            return new JSONRenderer(['status' => 'error', 'message' => $e->getMessage()]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return new JSONRenderer(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
];
