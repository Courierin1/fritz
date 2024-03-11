<?php
namespace App\Helper;

class Helper
{
    public static function getKeyEmbedCode($link) {
        $regex = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($regex, $link, $matches);
        return $matches[1] ?? '';
    }
}
