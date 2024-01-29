<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Database\MySQLWrapper;
use Database\Seeder;
use Helpers\Generations;

class Seed extends AbstractCommand
{
    // コマンド名を設定します
    protected static ?string $alias = 'seed';

    public static function getArguments(): array
    {
        return [];
    }

    public function execute(): int
    {
        $this->runAllSeeds();
        return 0;
    }

    function runAllSeeds(): void {
        $directoryPath = __DIR__ . '/../../Database/Seeds';

        // ディレクトリをスキャンしてすべてのファイルを取得します。
        $files = scandir($directoryPath);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                // ファイル名からクラス名を抽出します。
                $className = 'Database\Seeds\\' . pathinfo($file, PATHINFO_FILENAME);

                // シードファイルをインクルードします。
                include_once $directoryPath . '/' . $file;

                if (class_exists($className) && is_subclass_of($className, Seeder::class)) {
                    $seeder = new $className(new MySQLWrapper());
                    $this->log("className : ".$className);
                    for($i = 0;$i < 101;$i++){
                        $pathArr = $this->seedTestData($i+1);
                        $seeder->seed($pathArr["imagePath"], $pathArr["thumbnailPath"], $pathArr["url"]);
                    }
                }
                else throw new \Exception('Seeder must be a class that subclasses the seeder interface');
            }
        }
    }

    private function seedTestData(int $index): array{
        $fileExtension = 'png';
        $sourceFile = "Dummies/dummyImage.png";
        $imageDirPath = Generations::directory(["Images", date('Y'), date('m'), date('d')]);
        $thumbnailDirPath = Generations::directory(["Thumbnails", date('Y'), date('m'), date('d')]);
        $date = date("Y-m-d H:i:s", strtotime("+".$index." seconds"));
        $postFileName = hash("md5",$date);
        $imagePath = $imageDirPath . "/im_" . $postFileName . "." . $fileExtension;
        $thumbnailPath = $thumbnailDirPath . "/th_" .  $postFileName . "." . $fileExtension;
        // ローカル環境用
        // $url = "http://localhost:8000/thread/".$postFileName;
        // 本番環境用
        $url = "https://pixathread.aki158-website.blog/thread/".$postFileName;

        // Dummiesフォルダから画像をコピーしてImagesフォルダにおく
        if(copy($sourceFile, $imagePath)){
            $this->log($index." : Successfully copied files from Dummies folder.");
        }
        else{
            $this->log($index." : Failed to copy files from Dummies folder.");
        }

        // $image_pathのファイルを、exec関数を使用してサムネイルに変換する
        $output=null;
        $retval=null;
        if($fileExtension !== 'gif'){
            $command = sprintf("convert %s -resize 300x300! %s", $imagePath, $thumbnailPath);
        }
        else{
            $command = sprintf("convert %s[0] -resize 300x300! %s", $imagePath, $thumbnailPath);
        }

        exec($command, $output, $retval);

        if((int)$retval) {
            $this->log("Failed to create thumbnail.\nstatus : $retval");
        }

        $pathArr = [
            "imagePath" => $imagePath,
            "thumbnailPath" => $thumbnailPath,
            "url" => $url
        ];
        return $pathArr;
    }
}
