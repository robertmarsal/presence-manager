<?php

abstract class View {

    /**
     * Title of the view. Used as a page title in the html render
     * 
     * @var String
     */
    private $_title;
    
    /**
     * Contains the current alert
     * 
     * @var Html
     */
    protected $_alert;

    /**
     * Renders the view
     */
    public function __destruct() {
        $this->render();
    }

    /**
     * It contains the base html template. 
     * Builds the html of the view
     * 
     * @global Object $CONFIG
     * @global Array $STRINGS 
     */
    private function render() {
        global $CONFIG, $STRINGS;
        echo '<!DOCTYPE html>
              <html lang="en">
                <head>
                <meta charset="utf-8">
                  <title>' . $this->_title . ' | ' . $STRINGS['brand'] . '</title>
                    <link rel="stylesheet" href="' . $CONFIG->wwwroot . '/public/css/bootstrap.min.css" type="text/css">
                    <link rel="stylesheet" href="' . $CONFIG->wwwroot . '/public/css/presence.css" type="text/css">
                    <link rel="stylesheet" href="' . $CONFIG->wwwroot . '/public/css/datepicker.css" type="text/css">
                    <link rel="shortcut icon" href="' . $CONFIG->wwwroot . '/public/img/favicon.ico">
                    <script type="text/javascript" src="' . $CONFIG->wwwroot . '/public/js/jquery-1.7.1.min.js"></script>
                    <script type="text/javascript" src="' . $CONFIG->wwwroot . '/public/js/bootstrap-alert.js"></script>
                    <script type="text/javascript" src="' . $CONFIG->wwwroot . '/public/js/bootstrap-datepicker.js"></script>
                </head>
                <body>
                  <!--MENU-->
                  <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                      <div class="container">
                        <a class="brand" href="'.$CONFIG->wwwroot.'">'.$STRINGS['brand'].'</a>
                          <div class="nav-collapse">
                            '.$this->menu().'
                          </div>
                       </div>
                    </div>
                  </div>
				  <!--MAIN-->
                    <div class="container">
                      '.$this->_alert.'
					  '.$this->content().'
                    </div>
                </body>
              </html>';
    }

    /**
     * Sets the title of the view
     * 
     * @param String $title 
     */
    protected function title($title) {
        $this->_title = $title;
    }

    /**
     * Builds the html containing the menu 
     */
    abstract function menu();

    /**
     * Builds the html with the content of the page 
     */
    abstract function content();
}
