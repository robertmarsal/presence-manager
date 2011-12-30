<?php

class NotFoundView extends View{
    
    public function head() {
        global $config;
        
        return '
        <head>
            <meta charset="utf-8">
            <title>404 | Presence</title>
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/lib/twitter-bootstrap/bootstrap.min.css" type="text/css">
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/screen.css" type="text/css">
            <link rel="shortcut icon" href="'.$config['wwwroot'].'/public/img/favicon.ico">
        </head>';
    }
    
    public function body() {
        global $config;
        
        return '
        <body>
            <div class="container">
                <h2>Ooops! This is a 404...quick, go <a href="'.$config['wwwroot'].'">back!</a></h2>
            </div>
        </body>';
    }
}