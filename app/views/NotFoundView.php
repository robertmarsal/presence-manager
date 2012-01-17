<?php

class NotFoundView extends View {

    public function __construct() {

        global $STRINGS;

        $this->title($STRINGS['404']);
    }

    public function menu(){
        return null;
    }

    public function content(){

        global $CONFIG;

        return '
        <div class="container">
            <h2>Ooops! This is a 404...quick, go <a href="' . $CONFIG['wwwroot'] . '">back!</a></h2>
        </div>';
    }

}