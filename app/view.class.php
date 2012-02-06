<?php

abstract class View {

    private $_title;
    protected $_alert;

    public function __construct($alert){
        $this->_alert = $alert;
    }

    public function __destruct() {
        $this->render();
    }

    private function render() {

        global $CONFIG, $STRINGS;

        echo '<!DOCTYPE html>';
        echo '<html lang="en">
                <head>
                <meta charset="utf-8">
                    <title>' . $this->_title . ' | ' . $STRINGS['brand'] . '</title>
                    <link rel="stylesheet" href="' . $CONFIG['wwwroot'] . '/public/css/bootstrap.min.css" type="text/css">
                    <link rel="stylesheet" href="' . $CONFIG['wwwroot'] . '/public/css/presence.css" type="text/css">
                    <link rel="shortcut icon" href="' . $CONFIG['wwwroot'] . '/public/img/favicon.ico">
                    <script type="text/javascript" src="' . $CONFIG['wwwroot'] . '/public/js/jquery-1.7.1.min.js"></script>
                    <script type="text/javascript" src="' . $CONFIG['wwwroot'] . '/public/js/bootstrap-alert.js"></script>
                </head>
                <body>

                    <!--MENU-->
                    <div class="navbar navbar-fixed-top">
                        <div class="navbar-inner">
                            <div class="container">
                                <a class="brand" href="'.$CONFIG['wwwroot'].'">'.$STRINGS['brand'].'</a>
                                <div class="nav-collapse">
                                    '.$this->menu().'
                                </div>
                            </div>
                        </div>
                    </div>

					<!--MAIN-->
                    <div class="container">
                        <!--SUBNAV-->
                        <div class="subnav-fixed">
                            <div class="subnav-fixed-inner">
                                <div class="container">
                                    <ul class="subnav-pills">
                                        '.$this->subnav().'
                                    </ul>
                                </div>
                            </div>
                        </div>
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

    protected function subnav(){}

    abstract function content();
}
