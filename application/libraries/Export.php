<?php
class Export
{
    static $read;

    public static function findFile($filepath = null)
    {
        if (file_exists($filepath)) {
            $handle = fopen($filepath, "r+");
            self::$read = fread($handle, filesize($filepath));
            fclose($handle);
        }
        return new static;
    }
    public static function replace($data = array())
    {
        foreach (array_keys($data) as $key) {
            self::$read = str_replace($key, $data[$key], self::$read);
        }
        return new static;
    }
    public static function write($filepath = null)
    {
        $result = $filepath;
        $handle = fopen($result, "w+");
        fwrite($handle, self::$read);
        fclose($handle);
        return $result;
    }
    public static function debug()
    {
        echo self::$read;
    }
}
