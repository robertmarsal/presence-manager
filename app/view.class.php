<?php

abstract class View{
        
    public function __destruct() {
        $this->render();
    }
    
    private function render(){
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo $this->head();
        echo $this->body();
        echo '</html>';
    }
    
    abstract function head();
    
    abstract function body();
	
	protected function get_navigation($user_type = null){
		
		global $config;
		
		switch($user_type){
			case 'admin':
				return '
				    <div class="topbar" id="topbar-container">
						<div class="topbar-inner">
							<div class="container">
								<a class="brand" href="'.$config['wwwroot'].'">Presence</a>
								<ul class="nav">
									<li class="active"><a href="'.$config['wwwroot'].'/admin/activity">Activity</a></li>
									<li><a href="'.$config['wwwroot'].'/admin/users">Users</a></li>
								</ul>
								<ul class="nav secondary-nav">
									<li><a href="'.$config['wwwroot'].'/auth/logout">Log Out</a></li>
								</ul>
							</div>
						</div>
					</div>';
			case 'user':
				return '
				    <div class="topbar" id="topbar-container">
						<div class="topbar-inner">
							<div class="container">
								<a class="brand" href="'.$config['wwwroot'].'">Presence</a>
								<ul class="nav">
									<li class="active"><a href="'.$config['wwwroot'].'/user/activity">Activity</a></li>
								</ul>
								<ul class="nav secondary-nav">
									<li><a href="'.$config['wwwroot'].'/auth/logout">Log Out</a></li>
								</ul>
							</div>
						</div>
					</div>';
			default:
				return '           
					<div class="topbar" data-scrollspy="scrollspy">
						<div class="topbar-inner">
							<div class="container">
								<a class="brand" href="index.php">Presence</a>
								<ul class="nav">
									<li class="active"><a href="'.$config['wwwroot'].'">Login</a></li>
									<li><a href="'.$config['wwwroot'].'/help/main">Help</a></li>
								</ul>     
							</div>
						</div>
					</div>';
		}
	}
}