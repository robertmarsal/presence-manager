<?php

class Alert{

    static function show($type, $message){

        return '
            <div class="alert-message '.$type.' fade in" data-alert="alert">
                <a class="close" href="#">×</a>
                <p><strong>'.$message.'</strong></p>
            </div>';
    }
}