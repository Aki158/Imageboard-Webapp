<?php
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__DIR__ . '/..'));
spl_autoload_extensions(".php");
spl_autoload_register();

$DEBUG = true;

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

if (preg_match('/\.(?:png|jpg|jpeg|gif|js|css|html)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

// ルートを読み込みます
$routes = include('Routing/routes.php');

// リクエストURIからパスだけを解析して取得します
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = ltrim($path, '/');
$prefix = 'thread';

if (substr($path, 0, strlen($prefix)) === $prefix) {
    $path = $prefix;
}

// パスがルートに存在するかチェックします
if (isset($routes[$path])) {
    // レンダラーを作成するコールバックを呼び出します
    $renderer = $routes[$path]();

    try{
        // ヘッダーを設定します
        foreach ($renderer->getFields() as $name => $value) {
            // ヘッダーに対して単純なバリデーションを実行します
            $sanitized_value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

            if ($sanitized_value && $sanitized_value === $value) {
                header("{$name}: {$sanitized_value}");
            } else {
                // ヘッダーの設定が失敗した場合のログを取るか、または処理します
                // エラー処理に応じて、例外を投げるか、またはデフォルトで続行するかもしれません
                http_response_code(500);
                if($DEBUG) print("Failed setting header - original: '$value', sanitized: '$sanitized_value'");
                exit;
            }

            print($renderer->getContent());
        }
    }
    catch (Exception $e){
        http_response_code(500);
        print("Internal error, please contact the admin.<br>");
        if($DEBUG) print($e->getMessage());
    }
} else {
    // ルートが一致しない場合は、404エラーを表示します
    http_response_code(404);
    echo "404 Not Found: The requested route was not found on this server.";
}