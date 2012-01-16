<?php

class LoginView extends View {

    public function __construct() {

        global $string;

        $this->title($string['home']);
    }

    public function menu() {

        global $config, $string;

        return '
			<ul class="nav">
				<li class="active"><a href="' . $config['wwwroot'] . '">' . $string['login'] . '</a></li>
                <li><a href="' . $config['wwwroot'] . '/help/main">' . $string['help'] . '</a></li>
            </ul>';
    }

    public function content() {

        global $config;
        
        return '
        <section id="login">
                    <form id="login-form" class="form-stacked" action="' . $config['wwwroot'] . '/auth/login/index.php" method="post">
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
            </section>
        <footer id="footer">
            <div class="container">
                <p>Developed by <a href="http://twitter.com/robertboloc" target="_blank">@robertboloc</a><br/>
                Licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License v2.0</a>
                </p>
            </div>
        </footer>';
    }

}