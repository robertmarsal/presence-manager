<?php

class HelpView extends View{

	public function __construct() {

        global $STRINGS;

        $this->title($STRINGS['help']);
    }

	public function menu() {

        global $CONFIG, $STRINGS;

        return '
			<ul class="nav">
				<li><a href="' . $CONFIG['wwwroot'] . '">' . $STRINGS['login'] . '</a></li>
                <li class="active"><a href="' . $CONFIG['wwwroot'] . '/help/main">' . $STRINGS['help'] . '</a></li>
            </ul>';
    }

	public function content() {

        return '
        <section id="help">
            <div class="page-header">
				<h3>Acces problems</h3>
			</div>
			<div class="container">
			</div>
        </section>';
	}
}