<?php
namespace Core\Modules;
class Debugger {
    public static function this( $data ) {
        if (!\App\Config::DEBUG_MODE) {
            return false;
        }
        $output = $data;
        if ( is_array( $output ) )
            $output = json_encode($output);
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
}