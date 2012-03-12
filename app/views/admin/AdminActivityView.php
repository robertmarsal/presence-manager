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
        return MenuHelper::admin_base_menu('activity');
    }

    public function content() {

        global $CONFIG;

        $activity_table_content = '';
        if (!empty($this->_entries)) {
            foreach ($this->_entries as $entry) {
                $activity_table_content .=
                '<tr>
					<td>' . $entry->id . '</td>
					<td><span class="label ' . Helperx::get_label_for_action($entry->action). '">' . Helperx::get_event_description($entry->action) . '</span></td>
					<td>' . date('G:i:s', $entry->timestamp) . '</td>
					<td>' . date('D M j Y', $entry->timestamp) . '</td>
					<td>' . utf8_encode($entry->firstname) . '</td>
                    <td>' . utf8_encode($entry->lastname) . '</td>
					<td><a href="'.$CONFIG->wwwroot.'/admin/user_details/'.$entry->userid.'">' . $entry->email . '</a></td>
				 </tr>
				';
            }
        }

        return '
        <section id="activity">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Time</th>
						<th>Date</th>
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
