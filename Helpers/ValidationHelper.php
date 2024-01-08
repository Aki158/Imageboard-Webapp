<?php

namespace Helpers;

use Types\ValueType;

class ValidationHelper
{
    public static function integer($value, float $min = -INF, float $max = INF): int
    {
        // PHPには、データを検証する組み込み関数があります。詳細は https://www.php.net/manual/en/filter.filters.validate.php を参照ください。
        $value = filter_var($value, FILTER_VALIDATE_INT, ["min_range" => (int) $min, "max_range"=>(int) $max]);

        // 結果がfalseの場合、フィルターは失敗したことになります。
        if ($value === false) throw new \InvalidArgumentException("The provided value is not a valid integer.");

        // 値がすべてのチェックをパスしたら、そのまま返します。
        return $value;
    }

    public static function validateDate(string $date, string $format = 'Y-m-d'): string
    {
        $d = \DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) === $date) {
            return $date;
        }

        throw new \InvalidArgumentException(sprintf("Invalid date format for %s. Required format: %s", $date, $format));
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
        $protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $url = $protocol.$host."/thread".$postFileName;
        
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

        $imageDirPath = self::generateDir(["Images", date('Y'), date('m'), date('d')]);
        $image_path = $imageDirPath . "/" . $postFileName . "." . $fileExtension;
        
        // ファイルを移動する
        if(!move_uploaded_file($fileTmpPath, $image_path)) {
            throw new \InvalidArgumentException("ファイルの移動中にエラーが発生しました。\n開発者に問い合わせてください。");
        }

        $thumbnailDirPath = self::generateDir(["Thumbnails", date('Y'), date('m'), date('d')]);
        $thumbnail_path = $thumbnailDirPath . "/" .  $postFileName . "." . $fileExtension;

        // $image_pathのファイルを、exec関数を使用してサムネイルに変換する
        $output=null;
        $retval=null;
        $command = sprintf("convert %s -resize 300x300! %s", $image_path, $thumbnail_path);
        exec($command, $output, $retval);

        if((int)$retval) {
            throw new \InvalidArgumentException("サムネイルの作成に失敗しました。\n開発者に問い合わせてください。\nステータス : $retval");
        }

        $filePaths = [
            'image_path' => $image_path,
            'thumbnail_path' => $thumbnail_path,
            'url' => $url
        ];
        return $filePaths;
    }

    public static function generateDir(array $dirArr){
        $dirPath = '';
        
        foreach($dirArr as $dir_name){
            $dirPath .= ($dirPath === '' ? '' : '/') . $dir_name;

            if(!file_exists($dirPath)){
                mkdir($dirPath, 0777);
                chmod($dirPath, 0777);
            }
        }
        return $dirPath;
    }

    public static function validateFields(array $fields, array $postData, array $fileData): array
    {
        $validatedData = [];

        foreach ($fields as $field => $type) {
            $data = $field !== 'file' ? $postData : $fileData;

            if ($type !== ValueType::NULL && (!isset($data[$field]) || ($data)[$field] === '')) {
                if($field === 'content'){
                    throw new \InvalidArgumentException("コメントが入力されていません。\nコメントは1文字以上400文字以内で入力してください。");
                }
                else if($field === 'file'){
                    throw new \InvalidArgumentException("ファイルがアップロードされていません。\nファイルは、選択されているか確認してください。");
                }
                // throw new \InvalidArgumentException("Missing field: $field");
            }

            $value = $data[$field];

            $validatedValue = match ($type) {
                ValueType::STRING => is_string($value) ? $value : throw new \InvalidArgumentException("The provided value is not a valid string."),
                ValueType::INT => self::integer($value), // You can further customize this method if needed
                ValueType::FLOAT => filter_var($value, FILTER_VALIDATE_FLOAT),
                ValueType::DATE => self::validateDate($value),
                ValueType::FILE => self::validateFile($value),
                ValueType::NULL => null,
                default => throw new \InvalidArgumentException(sprintf("Invalid type for field: %s, with type %s", $field, $type)),
            };

            if ($validatedValue === false) {
                throw new \InvalidArgumentException(sprintf("Invalid value for field: %s", $field));
            }

            $validatedData[$field] = $validatedValue;
        }

        return $validatedData;
    }
}