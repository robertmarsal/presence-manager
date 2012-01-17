<?php

class UserActivityView extends View {

    private $_entries;

    public function __construct($entries) {

        global $STRINGS;

        $this->_entries = $entries;
        $this->title($STRINGS['activity']);
    }

    public function menu() {

        global $CONFIG;

        return '
			<ul class="nav">
				<li class="active"><a href="' . $CONFIG['wwwroot'] . '/user/activity">Activity</a></li>
            </ul>
            <ul class="nav secondary-nav">
				<li><a href="' . $CONFIG['wwwroot'] . '/auth/logout">Log Out</a></li>
            </ul>';
    }

    public function content() {

        global $CONFIG;

        $activity_table_content = '';
        if (!empty($this->_entries)) {
            foreach ($this->_entries as $entry) {
                $activity_table_content .=
                        '<tr>
					<td>' . $entry['id'] . '</td>
					<td><span class="label ' . $entry['action'] . '">' . $this->get_event_description($entry['action']) . '</span></td>
					<td>' . date('D M j G:i:s Y', $entry['timestamp']) . '</td>
				 </tr>
				';
            }
        }

        return '
			<table class="activity_table">
				<thead>
					<tr>
						<th>#</th>
						<th>Action</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>' . $activity_table_content . '
				</tbody>
			</table>
			<form class="form-stacked" action="' . $CONFIG['wwwroot'] . '/' . $_SESSION['role'] . '/activity/index.php" method="post">
				<input type="hidden" value="20" name="activity_maxrecords"/>
				<button class="btn right_aligned">More</button>
			</form>';
    }

    private function get_event_description($event) {
        switch ($event) {
            case 'success': return 'Check-In';
            case 'important': return 'Check-Out';
            case 'warning': return 'Incidence';
        }
    }

}