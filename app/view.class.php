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
                  </head>';
        echo $this->body();
        echo '</html>';
    }

    protected function title($title) {
        $this->_title = $title;
    }

    abstract function body();
}