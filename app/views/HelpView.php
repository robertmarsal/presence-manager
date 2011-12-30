<?php

class HelpView extends View{
	
	public function __construct() {

        global $string;

        $this->title($string['help']);
    }
	
	public function menu() {

        global $config, $string;

        return '
        <div class="topbar" data-scrollspy="scrollspy">
        <div class="topbar-inner">
            <div class="container">
                <a class="brand" href="index.php">' . $string['brand'] . '</a>
                <ul class="nav">
                    <li><a href="' . $config['wwwroot'] . '">' . $string['login'] . '</a></li>
                    <li class="active"><a href="' . $config['wwwroot'] . '/help/main">' . $string['help'] . '</a></li>
                </ul>
            </div>
        </div>
        </div>';
    }
	
	public function content() {
		
		global $config;
        
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