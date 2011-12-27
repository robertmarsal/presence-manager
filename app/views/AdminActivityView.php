<?php

class AdminActivityView extends View{
    
	private $_entries;
	
	public function __construct($entries){
		$this->_entries = $entries;
	}
	
    public function head(){
        global $config;
        
        return '
        <head>
            <meta charset="utf-8">
            <title>Admin | Presence</title>
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/lib/twitter-bootstrap/bootstrap.css" type="text/css">
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/screen.css" type="text/css">
			<script src="'.$config['wwwroot'].'/public/css/lib/twitter-bootstrap/js/bootstrap-dropdown.js" type="text/javascript"></script>
			<script src="'.$config['wwwroot'].'/public/js/lib/jquery-1.7.1.min.js"></script>
			
            <link rel="shortcut icon" href="'.$config['wwwroot'].'/public/img/favicon.ico">
        </head>';
    }
    
    public function body(){
        global $config;
        
		$activity_table_content = '';
		if(!empty($this->_entries)){
			foreach($this->_entries as $entry){
				$activity_table_content .=
				'<tr>
					<td>'.$entry['id'].'</td>
					<td><span class="label '.$entry['action'].'">'.$this->get_event_description($entry['action']).'</span></td>
					<td>'.date('D M j G:i:s Y',$entry['timestamp']).'</td>
					<td>'.$entry['firstname'].' '.$entry['lastname'].'</td>
					<td>'.$entry['userid'].'</td>
				 </tr>
				';
			}
		}
		
        return '
        <body>
        <div class="topbar" id="topbar-container" data-dropdown="dropdown">
            <div class="topbar-inner">
                <div class="container">
                    <a class="brand" href="'.$config['wwwroot'].'">Presence</a>
                        <ul class="nav">
                            <li class="active"><a href="'.$config['wwwroot'].'/admin/activity">Activity</a></li>
                            <li><a href="'.$config['wwwroot'].'/admin/users">Users</a></li>
                        </ul>
                        <ul class="nav secondary-nav">
							<li class="dropdown" data-dropdown="dropdown" >
								<a href="#" class="dropdown-toggle">'.$_SESSION['user'].'</a>
								<ul class="dropdown-menu">
									<li class="dropdown_mod"><a href="#">Profile</a></li>
									<li class="divider"></li>
									<li class="dropdown_mod"><a href="'.$config['wwwroot'].'/auth/logout">Log Out</a></li>
								</ul>
							</li>
						</ul>
                </div>
            </div>
        </div>
		<div class="container">
			<table class="activity_table">
				<thead>
					<tr>
						<th>#</th>
						<th>Action</th>
						<th>Time</th>
						<th>User</th>
						<th>Contact</th>
					</tr>
				</thead>
				<tbody>'.$activity_table_content.'
				</tbody>
			</table>
			<form class="form-stacked" action="'.$config['wwwroot'].'/admin/activity/index.php" method="post">
				<input type="hidden" value="20" name="activity_maxrecords"/>
				<button class="btn right_aligned">More</button>
			</form>
		</div><script src="'.$config['wwwroot'].'/public/js/app.js"></script>
        </body>';
    }
	
	private function get_event_description($event){
		switch($event){
			case 'success': return 'Check-In';
			case 'important': return 'Check-Out';
			case 'warning': return 'Incidence';
		}
	}
}