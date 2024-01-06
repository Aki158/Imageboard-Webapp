<?php

namespace Database;

use Exception;
use mysqli;
use Helpers\Settings;

class MySQLWrapper extends mysqli{
    public function __construct(?string $hostname = 'localhost', ?string $username = null, ?string $password = null, ?string $database = null, ?int $port = null, ?string $socket = null)
    {
        // 接続失敗時に例外を投げ、エラーを報告します。どんなデータベース接続を初期化する前にこの設定を行ってください。これをテストするには、.env設定に誤った情報を入れてください。
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $username = $username??Settings::env('DATABASE_USER');
        $password = $password??Settings::env('DATABASE_USER_PASSWORD');
        $database = $database??Settings::env('DATABASE_NAME');

        parent::__construct($hostname, $username, $password, $database, $port, $socket);
    }

    // 実行されたクエリに対してデフォルトのデータベースを取得します。失敗時にエラーが投げられます（例：クエリがfalseを返す、または取得された行がない場合）
    // if文やcatch文を使用してこれらを処理することもできます。
    public function getDatabaseName(): string{
        return $this->query("SELECT database() AS the_db")->fetch_row()[0];
    }

    public function prepareAndFetchAll(string $prepareQuery, string $types, array $data): ?array{
        $this->typesAndDataValidationPass($types, $data);

        $stmt = $this->prepare($prepareQuery);
        if(count($data) > 0) $stmt->bind_param($types, ...$data);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result === false) throw new Exception(sprintf('Error fetching data on query %s', $prepareQuery));

        // 連想モードを使用して、列名も取得します。
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function prepareAndExecute(string $prepareQuery, string $types, array $data): bool{
        $this->typesAndDataValidationPass($types, $data);

        $stmt = $this->prepare($prepareQuery);
        if(count($data) > 0) $stmt->bind_param($types, ...$data);
        return $stmt->execute();
    }

    private function typesAndDataValidationPass(string $types, array $data): void{
        if (strlen($types) !== count($data)) throw new Exception(sprintf('Type and data must equal in length %s vs %s', strlen($types), count($data)));
    }
}