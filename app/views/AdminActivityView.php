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
            <title>Activity | Presence</title>
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/lib/twitter-bootstrap/bootstrap.min.css" type="text/css">
            <link rel="stylesheet" href="'.$config['wwwroot'].'/public/css/screen.css" type="text/css">			
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
					<td>'.utf8_encode($entry['firstname']).'</td>
                                        <td>'.utf8_encode($entry['lastname']).'</td>
					<td>'.$entry['userid'].'</td>
				 </tr>
				';
			}
		}
		
        return '
        <body>
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
		</div>
		<div class="container">
			<table class="activity_table">
				<thead>
					<tr>
						<th>#</th>
						<th>Action</th>
						<th>Time</th>
						<th>First Name</th>
                                                <th>Last Name</th>
						<th>User</th>
					</tr>
				</thead>
				<tbody>'.$activity_table_content.'
				</tbody>
			</table>
			<form class="form-stacked" action="'.$config['wwwroot'].'/'.$_SESSION['role'].'/activity/index.php" method="post">
				<input type="hidden" value="20" name="activity_maxrecords"/>
				<button class="btn right_aligned">More</button>
			</form>
		</div>
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