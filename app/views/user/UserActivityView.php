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
				<li class="active"><a href="' . $CONFIG->wwwroot . '/user/activity">Activity</a></li>
            </ul>
            <ul class="nav pull-right">
                <a class="btn btn-warning" href="' . $CONFIG->wwwroot . '/auth/logout">Log Out</a>
            </ul>';
    }

    public function content() {

        $activity_table_content = '';
        if (!empty($this->_entries)) {
            foreach ($this->_entries as $entry) {
                $activity_table_content .=
                '<tr>
					<td>' . $entry['id'] . '</td>
					<td><span class="label ' . Helper::get_label_for_action($entry['action']). '">' . Helper::get_event_description($entry['action']) . '</span></td>
                    <td>' . date('D M j G:i:s Y', $entry['timestamp']) . '</td>
				 </tr>
				';
            }
        }

        return '
            <section id="user-activity" class="well">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Action</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    '.$activity_table_content.'
                    </tbody>
                </table>
            </section>';
    }

}
