<?php

class AdminHelpView extends View{

    function __construct() {

        global $string;

        $this->title($string['help']);
    }

    public function menu() {

        global $config;

        return '
			<ul class="nav">
				<li><a href="' . $config['wwwroot'] . '/admin/activity">Activity</a></li>
				<li><a href="' . $config['wwwroot'] . '/admin/users">Users</a></li>
                <li><a href="' . $config['wwwroot'] . '/admin/settings">Settings</a></li>
                <li class="active"><a href="' . $config['wwwroot'] . '/admin/help">Help</a></li>
			</ul>
			<ul class="nav secondary-nav">
				<li><a href="' . $config['wwwroot'] . '/auth/logout">Log Out</a></li>
			</ul>';
    }

    public function content() {

        return '
        <section id="help">
            <div class="page-header">
				<h3>Activity</h3>
			</div>
			<div class="container">
                <p> It displays the activity of all the users.
                </p>
			</div>

            <div class="page-header">
				<h3>Users</h3>
			</div>
			<div class="container">
                <p> It shows a list of all the users in the system and provides
                a link to edit the user data.
                </p>
			</div>

            <div class="page-header">
				<h3>Settings</h3>
			</div>
			<div class="container">
                <p> Provides a interface to configure the application.
                </p>
			</div>
        </section>';
    }
}