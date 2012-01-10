<?php

class AdminUserActivityView extends View{

	private $_user;
    private $_activity;

    public function __construct($user, $activity) {

        global $string;

        $this->_user = $user;
        $this->_activity = $activity;

        $this->title($string['user']);
    }

	public function menu(){

		global $config;

        return '
        <div class="topbar" id="topbar-container">
			<div class="topbar-inner">
				<div class="container">
					<a class="brand" href="' . $config['wwwroot'] . '">Presence</a>
					<ul class="nav">
						<li><a href="' . $config['wwwroot'] . '/admin/activity">Activity</a></li>
						<li class="active"><a href="' . $config['wwwroot'] . '/admin/users">Users</a></li>
                        <li><a href="' . $config['wwwroot'] . '/admin/settings">Settings</a></li>
                        <li><a href="' . $config['wwwroot'] . '/admin/help">Help</a></li>
					</ul>
					<ul class="nav secondary-nav">
						<li><a href="' . $config['wwwroot'] . '/auth/logout">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>';
	}

	public function content(){

		global $config;

		$activity_table_content = '';
        if (!empty($this->_activity)) {
            foreach ($this->_activity as $entry) {
                $activity_table_content .=
                '<tr>
					<td><span class="label ' . $entry['action'] . '">' . $this->get_event_description($entry['action']) . '</span></td>
					<td>' . date('D M j G:i:s Y', $entry['timestamp']) . '</td>
				 </tr>
				';
            }
        }

		return '
        <ul class="tabs">
            <li><a href="'.$config['wwwroot'].'/admin/user_details/'.$this->_user['id'].'">Details</a></li>
            <li class="active"><a href="'.$config['wwwroot'].'/admin/user_activity/'.$this->_user['id'].'">Activity</a></li>
            <li><a href="#">Statistics</a></li>
            <li><a href="#">Summary</a></li>
            <li class="id-tab">'.$this->_user['firstname'].' '.$this->_user['lastname'].'</li>
        </ul>
		<section id="activity">
            <table class="activity_table zebra-striped">
				<thead>
					<tr>
						<th>Action</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>' . $activity_table_content . '
				</tbody>
			</table>
		</section>
		';

	}

    private function get_event_description($event) {
        switch ($event) {
            case 'success': return 'Check-In';
            case 'important': return 'Check-Out';
            case 'warning': return 'Incidence';
        }
    }

}