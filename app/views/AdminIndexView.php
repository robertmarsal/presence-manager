<?php

class AdminIndexView extends View{
    
    public function head(){
        global $config;
        
        return '
        <head>
            <meta charset="utf-8">
            <title>Admin | Presence</title>
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/lib/twitter-bootstrap/bootstrap.css" type="text/css">
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/screen.css" type="text/css">
            <link rel="shortcut icon" href="'.$config['wwwroot'].'/public/img/favicon.ico">
        </head>';
    }
    
    public function body(){
        global $config;
        
        return '
        <body>
        <!-- Topbar
        ================================================== -->
        <div class="topbar" data-scrollspy="scrollspy" >
            <div class="topbar-inner">
                <div class="container">
                    <a class="brand" href="'.$config['wwwroot'].'">Presence</a>
                        <ul class="nav">
                            <li class="active"><a href="#overview">Home</a></li>
                            <li><a href="#">Messages</a></li>
                            <li><a href="#">Users</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                        <ul class="nav secondary-nav">
                            <li><a href="'.$config['wwwroot'].'/auth/logout">Log Out</a></li>
                        </ul>
                </div>
            </div>
        </div>
        </body>';
    }
}