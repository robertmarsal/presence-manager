<?php

class Lang {

    static function get($string){
        global $STRINGS;
        return $STRINGS[$string];
    }
}
