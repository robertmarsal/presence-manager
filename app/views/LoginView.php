<?php

class LoginView extends View {

    public function __construct() {

        global $STRINGS;

        $this->title($STRINGS['home']);
    }

    public function menu() {
        return null;
    }

    public function content() {

        global $CONFIG;

        return '
        <section id="login">
            <form class="well" action="'.$CONFIG['wwwroot'].'/auth/login/index.php" method="post">
                <input class="span3" type="text" name="email" placeholder="Email"><br/>
                <input class="span3" type="password" name="password" placeholder="Password"><br/>
                <button type="submit" class="btn">Login</button>
                <div class="container" id="login-footer">
                    <p>Developed by <a href="http://twitter.com/robertboloc" target="_blank">@robertboloc</a><br/>
                     Licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License v2.0</a>
                    </p>
                </div>
            </form>
        <section>
        ';
    }

}
