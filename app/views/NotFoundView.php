<?php

class NotFoundView extends View {

    public function __construct() {

        global $string;

        $this->title($string['404']);
    }

    public function body() {
        global $config;

        return '
        <body>
            <div class="container">
                <h2>Ooops! This is a 404...quick, go <a href="' . $config['wwwroot'] . '">back!</a></h2>
            </div>
        </body>';
    }

}