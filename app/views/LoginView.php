<?php

class LoginView extends View{
    
    public function head(){
        global $config;
        
        return 
        '<head>
            <meta charset="utf-8">
            <title>Home | Presence</title>
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/lib/twitter-bootstrap/bootstrap.css" type="text/css">
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/screen.css" type="text/css">
            <link rel="shortcut icon" href="'.$config['wwwroot'].'/public/img/favicon.ico">
        </head>';
    }
    
    public function body(){
        global $config;
        
        return
        '<body>
			'.$this->get_navigation().'
            <div class="container">
                <section id="login">
                    <div class="row">
                        <div class="span6">
                            <h2>Users</h2>
                            <p>Log in to ...</p>
                            <h2>Admins</h2>
                            <p>Log in to manage users, check system status,...</p>
                        </div>
                    <div class="span10">
                        <form class="form-stacked" action="'.$config['wwwroot'].'/auth/login/index.php" method="post">
						<fieldset>
                            <div class="clearfix">
                                <label for="email">Email</label>
                                <div class="input">
                                    <input class="xlarge" id="email" name="email" size="30" type="text" />
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="password">Password</label>
                                <div class="input">
                                    <input class="xlarge" id="password" name="password" size="30" type="password" />
                                </div>
                            </div>
                            <div class="clearfix">
                                <input type="submit" class="btn primary" value="&nbsp;Login&nbsp;">&nbsp;
                                <button type="reset" class="btn">Cancel</button>
                            </div>
    					</fieldset>
                        </form>
                    </div>
                </section>
            <footer class="footer">
                <div class="container">
                    <p>Developed by <a href="http://twitter.com/robertboloc" target="_blank">@robertboloc</a><br/>
                    Licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License v2.0</a>
                    </p>
                </div>
            </footer>
            </div>
        </body>';
    }
}