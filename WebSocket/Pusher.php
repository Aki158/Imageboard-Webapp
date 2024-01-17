<?php
namespace WebSocket;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class Pusher implements WampServerInterface {
    protected $subscribedTopics = array();

    public function onSubscribe(ConnectionInterface $conn, $topic) {

    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
    
    }
    public function onOpen(ConnectionInterface $conn) {
    
    }
    public function onClose(ConnectionInterface $conn) {
    
    }
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {

    }
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        // クライアントがデータを送信した場合、すべてのクライアントにデータを共有します        
        $topic->broadcast($event);
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}
