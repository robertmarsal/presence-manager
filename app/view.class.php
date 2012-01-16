<?php

abstract class View {

    private $_title;

    public function __destruct() {
        $this->render();
    }

    private function render() {

        global $config, $string;

        echo '<!DOCTYPE html>';
        echo '<html lang="en">
                <head>
                <meta charset="utf-8">
                    <title>' . $this->_title . ' | ' . $string['brand'] . '</title>
                    <link rel="stylesheet" href="' . $config['wwwroot'] . '/public/css/lib/twitter-bootstrap/bootstrap.min.css" type="text/css">
                    <link rel="stylesheet" href="' . $config['wwwroot'] . '/public/css/screen.css" type="text/css">
                    <link rel="shortcut icon" href="' . $config['wwwroot'] . '/public/img/favicon.ico">
                    <script type="text/javascript" src="' . $config['wwwroot'] . '/public/js/jquery-1.7.1.min.js"></script>
                    <script type="text/javascript" src="' . $config['wwwroot'] . '/public/js/bootstrap-alerts.js"></script>
                </head>
                <body>
					<!--MENU-->
					<div class="topbar" id="topbar-container">
						<div class="topbar-inner">
							<div class="container">
								<a class="brand" href="' . $config['wwwroot'] . '">Presence</a>
                '.$this->menu().'
				            </div>
						</div>
					</div>
					<!--MAIN-->
                    <div class="container">
                    '.$this->content().'
                    </div>
                </body>
                  ';

        echo '</html>';
    }

    protected function title($title) {
        $this->_title = $title;
    }

    abstract function menu();
    abstract function content();
}