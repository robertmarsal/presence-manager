<?php

class NotFoundView extends View {

    public function __construct() {

        global $string;

        $this->title($string['404']);
    }

    public function menu(){

        global $config, $string;

        return '
        <div class="topbar" data-scrollspy="scrollspy">
        <div class="topbar-inner">
            <div class="container">
                <a class="brand" href="index.php">' . $string['brand'] . '</a>
                <ul class="nav">
                    <li class="active"><a href="' . $config['wwwroot'] . '">' . $string['login'] . '</a></li>
                    <li><a href="' . $config['wwwroot'] . '/help/main">' . $string['help'] . '</a></li>
                </ul>
            </div>
        </div>
        </div>';
    }

    public function content(){

        global $config;

        return '
        <div class="container">
            <h2>Ooops! This is a 404...quick, go <a href="' . $config['wwwroot'] . '">back!</a></h2>
        </div>';
    }

}