<?php
namespace Core\Modules\Benchmark;
class Timer {
    
    public static $start;
    public static $end;
    
    public static function start() {
        self::$start = microtime(true);
    }

    public static function end() {
        self::$end = microtime(true);
        $creationtime = (self::$end - self::$start);
        return $creationtime;
    }
}
