<?php

class AdminUserActivityView extends View{

	private $_user;
    private $_activity;

    public function __construct($user, $activity) {

        global $STRINGS;

        $this->_user = $user;
        $this->_activity = $activity;
        $this->title($STRINGS['user']);
    }

	public function menu(){
        return MenuHelper::admin_base_menu('users');
	}

    public function content(){

        global $STRINGS;

		$activity_table_content = '';
        if ($this->_activity) {
            foreach ($this->_activity as $entry) {
                $activity_table_content .=
                '<tr>
					<td><span class="label ' . BootstrapHelper::get_label_for_action($entry->action) . '">' . BootstrapHelper::get_event_description($entry->action) . '</span></td>
					<td>' . date('G:i:s', $entry->timestamp) . '</td>
					<td>' . date('D M j Y', $entry->timestamp) . '</td>
				 </tr>
				';
            }

        }
        return '
			<section id="user-activity" class="well min-table">
            '.MenuHelper::admin_submenu('activity', $this->_user).'
				<table class="table inline-table">
					<thead>
						<tr>
							<th>'.$STRINGS['action'].'</th>
							<th>'.$STRINGS['time'].'</th>
							<th>'.$STRINGS['date'].'</th>
						</tr>
					</thead>
					<tbody>' . $activity_table_content . '
					</tbody>
				</table>
			</section>';

  	}
}
