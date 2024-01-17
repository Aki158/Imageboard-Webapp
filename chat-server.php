<?php

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

$loop   = React\EventLoop\Factory::create();
$pusher = new WebSocket\Pusher;

// リアルタイムのアップデートを求めるクライアントのためにWebSocketサーバーをセットアップする
$webSock = new React\Socket\Server('0.0.0.0:8080', $loop); // 0.0.0.0へのバインディングは、リモートが接続できることを意味する
$webServer = new Ratchet\Server\IoServer(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            new Ratchet\Wamp\WampServer(
                $pusher
            )
        )
    ),
    $webSock
);

$loop->run();