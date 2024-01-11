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
    'newThread'=>function(): HTTPRenderer{
        return new HTMLRenderer('component/newThread', [''=>null]);
    },
    'form/create/post' => function(): HTTPRenderer {
        try {
            // リクエストメソッドがPOSTかどうかをチェックします
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method!');
            }

            $postType = $_POST['postType'];
            $postId = $_POST['postId'];
            $subject = $_POST['subject'];
            $content = $_POST['content'];
            $file = $_FILES['file'];

            $required_fields = [
                'postId' => ValueType::INT,
                'subject' => ValueType::STRING,
                'content' => ValueType::STRING,
                'file' => ValueType::FILE
            ];

            // subjectは、任意入力なので値がなければValueTypeをnullに変更する
            if(!isset($subject) || $subject === ''){
                $required_fields['subject'] = ValueType::NULL;
            }

            // スレッドへの返信は、contentとfileのどちらかの入力が必須
            if($postType === 'reply'){
                // contentがnullまたは空文字 かつ fileがnullでない
                if((!isset($content) || $content === '') && isset($file)){
                    $required_fields['content'] = ValueType::NULL;
                }
                // contentがnullでない かつ fileがnull
                else if((isset($content) || $content !== '') && !isset($file)){
                    $required_fields['file'] = ValueType::NULL;
                }
            }

            $postDao = new PostDAOImpl();

            // 入力に対する単純なバリデーション。実際のシナリオでは、要件を満たす完全なバリデーションが必要になることがあります。
            $validatedData = ValidationHelper::validateFields($required_fields, $_POST, $_FILES);

            // 名前付き引数を持つ新しいPostオブジェクトの作成
            if($postType === 'thread'){
                $post = new Post(null, null, $validatedData['subject'], $validatedData['content'], $validatedData['file']['image_path'], $validatedData['file']['thumbnail_path'], Generations::url(hash("sha1",date("Y-m-d H:i:s"))));
            }
            else if($postType === 'reply'){
                // fileがnullでない
                if($required_fields['file'] === ValueType::NULL){
                    $post = new Post(null, $validatedData['postId'], null, $validatedData['content'], null, null, null);
                }else{
                    $post = new Post(null, $validatedData['postId'], null, $validatedData['content'], $validatedData['file']['image_path'], $validatedData['file']['thumbnail_path'], null);
                }
            }

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
        $url = ValidationHelper::string($url);
        $postDao = new PostDAOImpl();
        $thread = $postDao->getThread($url);
        $replies = null;
        $repliesData = [];

        if(isset($thread)){
            $replies = $postDao->getReplies($thread, 0, 100);
        }

        foreach($replies as $reply){
            $repliesData[] = [
                "content" => $reply->getContent(),
                "image_path" => $reply->getImagePath(),
                "thumbnail_path" => $reply->getThumbnailPath(),
                "created_at" => $reply->getTimeStamp()->getCreatedAt()
            ];
        }

        $posts = [
            "thread" => $thread,
            "replies" => $repliesData
        ];

        return new HTMLRenderer('component/thread', ['posts'=>$posts]);
    },


    // 'random/part'=>function(): HTTPRenderer{
    //     $partDao = new ComputerPartDAOImpl();
    //     $part = $partDao->getRandom();

    //     if($part === null) throw new Exception('No parts are available!');

    //     return new HTMLRenderer('component/computer-part-card', ['part'=>$part]);
    // },
    // 'parts'=>function(): HTTPRenderer{
    //     // IDの検証
    //     $id = ValidationHelper::integer($_GET['id']??null);

    //     $partDao = new ComputerPartDAOImpl();
    //     $part = $partDao->getById($id);

    //     if($part === null) throw new Exception('Specified part was not found!');

    //     return new HTMLRenderer('component/computer-part-card', ['part'=>$part]);
    // },
    // 'update/part' => function(): HTMLRenderer {
    //     $part = null;
    //     $partDao = new ComputerPartDAOImpl();
    //     if(isset($_GET['id'])){
    //         $id = ValidationHelper::integer($_GET['id']);
    //         $part = $partDao->getById($id);
    //     }
    //     return new HTMLRenderer('component/update-computer-part',['part'=>$part]);
    // },
    // 'form/update/part' => function(): HTTPRenderer {
    //     try {
    //         // リクエストメソッドがPOSTかどうかをチェックします
    //         if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //             throw new Exception('Invalid request method!');
    //         }

    //         $required_fields = [
    //             'name' => ValueType::STRING,
    //             'type' => ValueType::STRING,
    //             'brand' => ValueType::STRING,
    //             'modelNumber' => ValueType::STRING,
    //             'releaseDate' => ValueType::DATE,
    //             'description' => ValueType::STRING,
    //             'performanceScore' => ValueType::INT,
    //             'marketPrice' => ValueType::FLOAT,
    //             'rsm' => ValueType::FLOAT,
    //             'powerConsumptionW' => ValueType::FLOAT,
    //             'lengthM' => ValueType::FLOAT,
    //             'widthM' => ValueType::FLOAT,
    //             'heightM' => ValueType::FLOAT,
    //             'lifespan' => ValueType::INT,
    //         ];

    //         $partDao = new ComputerPartDAOImpl();

    //         // 入力に対する単純なバリデーション。実際のシナリオでは、要件を満たす完全なバリデーションが必要になることがあります。
    //         $validatedData = ValidationHelper::validateFields($required_fields, $_POST);

    //         if(isset($_POST['id'])) $validatedData['id'] = ValidationHelper::integer($_POST['id']);

    //         // 名前付き引数を持つ新しいComputerPartオブジェクトの作成＋アンパッキング
    //         $part = new ComputerPart(...$validatedData);

    //         error_log(json_encode($part->toArray(), JSON_PRETTY_PRINT));

    //         // 新しい部品情報でデータベースの更新を試みます。
    //         // 別の方法として、createOrUpdateを実行することもできます。
    //         if(isset($validatedData['id'])) $success = $partDao->update($part);
    //         else $success = $partDao->create($part);

    //         if (!$success) {
    //             throw new Exception('Database update failed!');
    //         }

    //         return new JSONRenderer(['status' => 'success', 'message' => 'Part updated successfully']);
    //     } catch (\InvalidArgumentException $e) {
    //         error_log($e->getMessage()); // エラーログはPHPのログやstdoutから見ることができます。
    //         return new JSONRenderer(['status' => 'error', 'message' => 'Invalid data.']);
    //     } catch (Exception $e) {
    //         error_log($e->getMessage());
    //         return new JSONRenderer(['status' => 'error', 'message' => 'An error occurred.']);
    //     }
    // },
    // 'delete/part' => function(): HTMLRenderer {
    //     $part = null;
    //     $partDao = new ComputerPartDAOImpl();
    //     if(isset($_GET['id'])){
    //         $id = ValidationHelper::integer($_GET['id']);
    //         $part = $partDao->getById($id);
    //     }
    //     return new HTMLRenderer('component/delete-computer-part',['part'=>$part]);
    // },
    // 'form/delete/part' => function(): HTTPRenderer {
    //     try {
    //         // リクエストメソッドがDELETEかどうかをチェックします
    //         if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //             throw new Exception('Invalid request method!');
    //         }

    //         $required_fields = [
    //             'name' => ValueType::STRING,
    //             'type' => ValueType::STRING,
    //             'brand' => ValueType::STRING,
    //             'modelNumber' => ValueType::STRING,
    //             'releaseDate' => ValueType::DATE,
    //             'description' => ValueType::STRING,
    //             'performanceScore' => ValueType::INT,
    //             'marketPrice' => ValueType::FLOAT,
    //             'rsm' => ValueType::FLOAT,
    //             'powerConsumptionW' => ValueType::FLOAT,
    //             'lengthM' => ValueType::FLOAT,
    //             'widthM' => ValueType::FLOAT,
    //             'heightM' => ValueType::FLOAT,
    //             'lifespan' => ValueType::INT,
    //         ];

    //         $partDao = new ComputerPartDAOImpl();

    //         // 入力に対する単純なバリデーション。実際のシナリオでは、要件を満たす完全なバリデーションが必要になることがあります。
    //         $validatedData = ValidationHelper::validateFields($required_fields, $_POST);

    //         if(isset($_POST['id'])) $validatedData['id'] = ValidationHelper::integer($_POST['id']);

    //         // 名前付き引数を持つ新しいComputerPartオブジェクトの作成＋アンパッキング
    //         $part = new ComputerPart(...$validatedData);

    //         error_log(json_encode($part->toArray(), JSON_PRETTY_PRINT));

    //         // 新しい部品情報でデータベースの削除を試みます。
    //         if(isset($validatedData['id'])) $success = $partDao->delete($part->getId());

    //         if (!$success) {
    //             throw new Exception('Database delete failed!');
    //         }

    //         return new JSONRenderer(['status' => 'success', 'message' => 'Part deleted successfully']);
    //     } catch (\InvalidArgumentException $e) {
    //         error_log($e->getMessage()); // エラーログはPHPのログやstdoutから見ることができます。
    //         return new JSONRenderer(['status' => 'error', 'message' => 'Invalid data.']);
    //     } catch (Exception $e) {
    //         error_log($e->getMessage());
    //         return new JSONRenderer(['status' => 'error', 'message' => 'An error occurred.']);
    //     }
    // },
    // 'parts/all' => function(): HTMLRenderer {
    //     $parts = null;
    //     $partDao = new ComputerPartDAOImpl();
    //     if(isset($_GET['pagenation'])){
    //         $pagenation = ValidationHelper::integer($_GET['pagenation']);
    //         $parts = $partDao->getAll(0,$pagenation);
    //     }
    //     else{
    //         $parts = $partDao->getAll(0,15);
    //     }
    //     return new HTMLRenderer('component/all-computer-parts',['parts'=>$parts]);
    // },
    // 'parts/type' => function(): HTMLRenderer {
    //     $parts = null;
    //     $partDao = new ComputerPartDAOImpl();
    //     if(isset($_GET['type'])){
    //         $parts = $partDao->getAllByType($_GET['type'],0,15);
    //     }
    //     return new HTMLRenderer('component/all-computer-parts-type',['parts'=>$parts]);
    // },
    
];
