<?php

class AdminActivityView extends View {

    private $_entries;
	private $_alert;

    public function __construct($entries, $alert = null) {

        global $string;

        $this->_entries = $entries;
		$this->_alert = $alert;
		
        $this->title($string['activity']);
    }

    public function menu() {

        global $config;

        return '
			<ul class="nav">
				<li class="active"><a href="' . $config['wwwroot'] . '/admin/activity">Activity</a></li>
                <li><a href="' . $config['wwwroot'] . '/admin/users">Users</a></li>
                <li><a href="' . $config['wwwroot'] . '/admin/settings">Settings</a></li>
                <li><a href="' . $config['wwwroot'] . '/admin/help">Help</a></li>
            </ul>
            <ul class="nav secondary-nav">
				<li><a href="' . $config['wwwroot'] . '/auth/logout">Log Out</a></li>
            </ul>';
    }

    public function content() {

        global $config, $string;

        $activity_table_content = '';
        if (!empty($this->_entries)) {
            foreach ($this->_entries as $entry) {
                $activity_table_content .=
                '<tr>
					<td>' . $entry['id'] . '</td>
					<td><span class="label ' . $entry['action'] . '">' . Helper::get_event_description($entry['action']) . '</span></td>
					<td>' . date('D M j G:i:s Y', $entry['timestamp']) . '</td>
					<td>' . utf8_encode($entry['firstname']) . '</td>
                    <td>' . utf8_encode($entry['lastname']) . '</td>
					<td><a href="'.$config['wwwroot'].'/admin/user_details/'.$entry['id'].'">' . $entry['email'] . '</a></td>
				 </tr>
				';
            }
        }

        return '
		'.$this->_alert.'		
			<table id="activity_table" class="zebra-striped">
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
				<tbody>' . $activity_table_content . '
				</tbody>
			</table>
			';
    }
}