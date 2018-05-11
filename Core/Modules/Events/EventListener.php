<?php
namespace Core\Modules\Events;
class EventListener {
    
    public static $hooks = [];
    
    public static function register($event, $function) {
        array_push(self::$hooks, ['event' => $event, 'function' => $function]);
    }

    public static function run($event) {
        $returns = [];
        foreach(self::$hooks as $hook) {
            if ($hook['event'] == $event) {
                $hook['function']();
            }
        }
    }
}
