<?php

class AdminActivityView extends View {

    private $_entries;

    public function __construct($entries, $alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_entries = $entries;

        $this->title($STRINGS['activity']);
    }

    public function menu() {

        global $CONFIG;

        return '
			<ul class="nav">
				<li class="active"><a href="' . $CONFIG->wwwroot. '/admin/activity">Activity</a></li>
                <li><a href="' . $CONFIG->wwwroot . '/admin/users">Users</a></li>
				<li><a href="' . $CONFIG->wwwroot . '/admin/report">Report</a></li>
            </ul>
            <ul class="nav pull-right no-hover-a">
				<p class="navbar-text pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout">Log Out</a></p>
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
					<td><span class="label ' . Helper::get_label_for_action($entry['action']). '">' . Helper::get_event_description($entry['action']) . '</span></td>
					<td>' . date('D M j G:i:s Y', $entry['timestamp']) . '</td>
					<td>' . utf8_encode($entry['firstname']) . '</td>
                    <td>' . utf8_encode($entry['lastname']) . '</td>
					<td><a href="'.$CONFIG->wwwroot.'/admin/user_details/'.$entry['id'].'">' . $entry['email'] . '</a></td>
				 </tr>
				';
            }
        }

        return '
        <section id="activity">
        '.$this->_alert.'
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Time</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>' . $activity_table_content . '
                </tbody>
            </table>
        </section>';
    }
}
