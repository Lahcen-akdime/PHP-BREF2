<?php
class Console {
    public function input($label){
        echo $label ." : ";
        return trim(fgets(STDIN));
    }

    // public function clear(): void {
    //     passthru(PHP_OS_FAMILY === 'Windows' ? 'cls' : 'clear');
    // }
}