<?php

class AdminSettingsView extends View{

    function __construct() {

        global $string;

        $this->title($string['settings']);;
    }


    public function menu() {

        global $config;

        return '
        <div class="topbar" id="topbar-container">
			<div class="topbar-inner">
				<div class="container">
					<a class="brand" href="' . $config['wwwroot'] . '">Presence</a>
					<ul class="nav">
						<li><a href="' . $config['wwwroot'] . '/admin/activity">Activity</a></li>
						<li><a href="' . $config['wwwroot'] . '/admin/users">Users</a></li>
                        <li class="active"><a href="' . $config['wwwroot'] . '/admin/settings">Settings</a></li>
                        <li><a href="' . $config['wwwroot'] . '/admin/help">Help</a></li>
					</ul>
					<ul class="nav secondary-nav">
						<li><a href="' . $config['wwwroot'] . '/auth/logout">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>';
    }

    public function content() {

    }
}