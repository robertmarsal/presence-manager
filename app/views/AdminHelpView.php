<?php

class AdminHelpView extends View{

    function __construct() {

        global $STRINGS;

        $this->title($STRINGS['help']);
    }

    public function menu() {

        global $CONFIG;

        return '
			<ul class="nav">
				<li><a href="' . $CONFIG['wwwroot'] . '/admin/activity">Activity</a></li>
				<li><a href="' . $CONFIG['wwwroot'] . '/admin/users">Users</a></li>
                <li class="active"><a href="' . $CONFIG['wwwroot'] . '/admin/help">Help</a></li>
			</ul>
			<ul class="nav secondary-nav">
				<li><a href="' . $CONFIG['wwwroot'] . '/auth/logout">Log Out</a></li>
			</ul>';
    }

    public function content() {

        global $STRINGS;

        return '
        <section id="help">
            <div class="page-header">
				<h3>FAQ</h3>
			</div>
			<div class="container">
                <p><b>Q:</b> When trying to create a new user I get the message: '.$STRINGS['user:create:failed'].'
                </p>
                <p><b>A:</b> All the fields in the form are mandatory, if one is empty you will get this message.
                </p>
			</div>

        </section>';
    }
}