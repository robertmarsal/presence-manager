<?php

class NotFoundView extends View {

    public function __construct() {

        global $string;

        $this->title($string['404']);
    }

    public function menu(){

        global $CONFIG, $string;

        return '
			<ul class="nav">
				<li class="active"><a href="' . $CONFIG['wwwroot'] . '">' . $string['login'] . '</a></li>
                <li><a href="' . $CONFIG['wwwroot'] . '/help/main">' . $string['help'] . '</a></li>
            </ul>';
    }

    public function content(){

        global $CONFIG;

        return '
        <div class="container">
            <h2>Ooops! This is a 404...quick, go <a href="' . $CONFIG['wwwroot'] . '">back!</a></h2>
        </div>';
    }

}