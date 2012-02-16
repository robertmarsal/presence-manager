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

		global $CONFIG;
 
        return '
        <ul class="nav">
            <li><a href="' . $CONFIG->wwwroot . '/admin/activity">Activity</a></li>
            <li class="active"><a href="' . $CONFIG->wwwroot . '/admin/users">Users</a></li>
        </ul>
        <ul class="nav pull-right">
            <a class="btn btn-warning" href="' .$CONFIG->wwwroot . '/auth/logout">Log Out</a>
        </ul>';
	}

    public function subnav(){
    
        global $CONFIG;

        return '
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_details/'.$this->_user['id'].'">Details</a></li>
            <li class="active-pill"><a href="'.$CONFIG->wwwroot.'/admin/user_activity/'.$this->_user['id'].'">Activity</a></li>
            <li><a href="#">Statistics</a></li>
            <li><a href="#">Summary</a></li>
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_account/'.$this->_user['id'].'">Account</a></li>
            <li class="id-tab">'.$this->_user['firstname'].' '.$this->_user['lastname'].'</li>';
    }
    
	public function content(){

		$activity_table_content = '';
        if (!empty($this->_activity)) {
            foreach ($this->_activity as $entry) {
                $activity_table_content .=
                '<tr>
					<td><span class="label ' . Helper::get_label_for_action($entry['action']) . '">' . Helper::get_event_description($entry['action']) . '</span></td>
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
}