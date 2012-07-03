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
        <section id="login" class="well">
            <form action="'.$CONFIG->wwwroot.'/auth/login" method="post">
                <input type="text" name="email" placeholder="Email"><br/>
                <input type="password" name="password" placeholder="Password"><br/>
                <button type="submit" class="btn btn-success">Login</button>
                <select id="lang-selector" name="lang">
                    <option value="en">english</option>
                    <option value="ca">català</option>
                    <option value="es">castellano</option>
                </select>
                <div class="container" id="login-footer">
                    <p>Developed by <a href="http://twitter.com/robertboloc" target="_blank">@robertboloc</a><br/>
                     Licensed under the <a href="http://www.opensource.org/licenses/mit-license.html" target="_blank">MIT Licence</a>
                    </p>
                </div>
            </form>
        <section>
        ';
    }

}
