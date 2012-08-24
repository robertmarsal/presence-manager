<?php

class LoginView extends View {

    public function title(){
       return Lang::get('home');
    }
    
    public function menu() {
        return null;
    }

    public function content() {
        global $CONFIG;

        return '
        <section id="login" class="well">
            <form action="'.$CONFIG->wwwroot.'/auth/login" method="post">
                <input type="text" name="identifier" placeholder="'.Lang::get('identifier').'"><br/>
                <input type="password" name="password" placeholder="'.Lang::get('password').'"><br/>
                <button type="submit" class="btn btn-success">'.Lang::get('login').'</button>
                <select id="lang-selector" name="lang">
                    <option value="en">english</option>
                    <option value="ca">català</option>
                    <option value="es">castellano</option>
                </select>
                <div class="container" id="login-footer">
                    <p>'.Lang::get('developer').' <a href="http://twitter.com/robertboloc" target="_blank">@robertboloc</a><br/>
                    </p>
                </div>
            </form>
        <section>
        ';
    }

}
