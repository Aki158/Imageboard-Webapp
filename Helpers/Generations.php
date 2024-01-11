<?php

namespace Helpers;

class Generations
{
    public static function directory(array $dirArr): string{
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

    public static function url(string $hash): string{
        // debug_start
        // protocolが自動的にけずられるのでコメントアウトしておく
        $protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $url = $protocol.$host."/thread/".$hash;
        // debug_end

        // $host = $_SERVER['HTTP_HOST'];
        // $url = $host."/thread/".$hash;

        return $url;
    }
}