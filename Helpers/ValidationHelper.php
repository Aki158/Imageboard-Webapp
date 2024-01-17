<?php

namespace Helpers;

use Types\ValueType;
use Helpers\Generations;

class ValidationHelper
{
    public static function string($value): string
    {
        return is_string($value) ? $value : throw new \InvalidArgumentException("入力は、有効な文字列ではありません。");
    }

    public static function integer($value, float $min = -INF, float $max = INF): int
    {
        // PHPには、データを検証する組み込み関数があります。
        // 詳細は https://www.php.net/manual/en/filter.filters.validate.php を参照ください。
        $value = filter_var($value, FILTER_VALIDATE_INT, ["min_range" => (int) $min, "max_range"=>(int) $max]);

        // 結果がfalseの場合、フィルターは失敗したことになります。
        if ($value === false) throw new \InvalidArgumentException("入力は、有効な数字ではありません。");

        // 値がすべてのチェックをパスしたら、そのまま返します。
        return $value;
    }

    public static function validateDate(string $date, string $format = 'Y-m-d H:i:s'): string
    {
        $d = \DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) === $date) {
            return $date;
        }

        throw new \InvalidArgumentException(sprintf("%s の日付形式は無効です。\n必須の日付形式: %s", $date, $format));
    }

    public static function validateFile(array $file): array
    {
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        $allowedMimeType = ['image/jpeg', 'image/png', 'image/gif'];
        $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!(is_uploaded_file($fileTmpPath))) {
            throw new \InvalidArgumentException("ファイルのアップロードに失敗しました。\nファイルは、選択されているか確認してください。");
        }
        
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
       
        $date = date("Y-m-d H:i:s");
        $postFileName = hash("md5",$date);
        
        // 画像ファイルとして有効かチェック
        if(getimagesize($fileTmpPath) === false){
            throw new \InvalidArgumentException("アップロードされたファイルは、画像として認識できませんでした。\nメディアファイルを選択してください。");
        }
        // 許可されているMIMEタイプかチェック
        else if(!in_array($fileType, $allowedMimeType)){
            throw new \InvalidArgumentException("アップロードされたファイルの種類(MIMEタイプ)は、許可されていません。\n許可されているMIMEタイプは、下記になります。\n・image/jpeg\n・image/png\n・image/gif");
        }
        // 許可されている拡張子かチェック
        else if (!in_array($fileExtension, $allowedFileExtensions)) {
            throw new \InvalidArgumentException("アップロードされたファイルの拡張子は、許可されていません。\n許可されている拡張子は、下記になります。\n・jpg\n・jpeg\n・png\n・gif");
        }
        // 1度にアップロードできるファイルサイズ(最大5MBまで)を超えていないかチェック
        else if($fileSize > 5242880){
            throw new \InvalidArgumentException("アップロードできるファイルサイズ(最大:5MB)を超えています。");
        }

        $imageDirPath = Generations::directory(["Images", date('Y'), date('m'), date('d')]);
        $imagePath = $imageDirPath . "/im_" . $postFileName . "." . $fileExtension;
        
        // ファイルを移動する
        if(!move_uploaded_file($fileTmpPath, $imagePath)) {
            throw new \InvalidArgumentException("ファイルの移動中にエラーが発生しました。\n開発者に問い合わせてください。");
        }

        $thumbnailDirPath = Generations::directory(["Thumbnails", date('Y'), date('m'), date('d')]);
        $thumbnailPath = $thumbnailDirPath . "/th_" .  $postFileName . "." . $fileExtension;

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
            throw new \InvalidArgumentException("サムネイルの作成に失敗しました。\n開発者に問い合わせてください。\nステータス : $retval");
        }

        $filePaths = [
            'image_path' => $imagePath,
            'thumbnail_path' => $thumbnailPath
        ];
        return $filePaths;
    }

    public static function validateFields(array $fields, array $postData, array $fileData, string $postType): array
    {
        $validatedData = [];
        $errorMessage = '';

        foreach ($fields as $field => $type) {
            $data = $field !== 'file' ? $postData : $fileData;
            $validateFlag = false;

            if ($type !== ValueType::NULL) {
                if($field === 'subject' && mb_strlen($data[$field]) >= 50){
                    throw new \InvalidArgumentException("タイトルは、50文字以内で入力してください");
                }
                else if($field === 'content' && ($data[$field] === '' || mb_strlen($data[$field]) >= 400)){
                    $errorMessage .= "・コメント : 1~400文字で入力してください\n";
                    $validateFlag = true;
                }
                else if($field === 'file' && $data[$field]['name'] === ''){
                    $errorMessage .= "・画像 : 選択されているか確認してください\n";
                    $validateFlag = true;
                }
            }

            if($validateFlag === false) {
                $value = $data[$field];
                $validatedValue = match ($type) {
                    ValueType::STRING => self::string($value),
                    ValueType::INT => self::integer($value),
                    ValueType::FLOAT => filter_var($value, FILTER_VALIDATE_FLOAT),
                    ValueType::DATE => self::validateDate($value),
                    ValueType::FILE => self::validateFile($value),
                    ValueType::NULL => null,
                    default => throw new \InvalidArgumentException(sprintf("フィールド: %s, 型: %s は無効です。\n開発者に問い合わせてください。", $field, $type)),
                };

                if ($validatedValue === false) {
                    throw new \InvalidArgumentException(sprintf("入力した値は無効です: %s\nREADMEを確認してください\n解決しない場合は、開発者に問い合わせてください。", $field));
                }

                $validatedData[$field] = $validatedValue;
            }
        }

        if($errorMessage !== ''){
            if($postType === "thread"){
                $errorMessage = "コメントと画像の入力は必須です !\n".$errorMessage;
            }
            else if($postType === "reply"){
                $errorMessage = "コメントと画像どちらかの入力は必須です !\n".$errorMessage;
            }
            throw new \InvalidArgumentException($errorMessage);
        }
        return $validatedData;
    }
}