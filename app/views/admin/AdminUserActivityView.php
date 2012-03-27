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

        global $CONFIG;
        
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
                
                <ul class="nav nav-list well inline-menu">
                    <li class="id-tab">
                        <i class="icon-user"></i>&nbsp;'.$this->_user->firstname.' '.$this->_user->lastname.'
                    </li>
                    <li>&nbsp;</li>

                    <li>
                        <a href="'.$CONFIG->wwwroot.'/admin/user_details/'.$this->_user->id.'">
                            <i class="icon-edit"></i>&nbsp;Details</a>
                    </li>
                    <li class="active">
                        <a href="'.$CONFIG->wwwroot.'/admin/user_activity/'.$this->_user->id.'">
                            <i class="icon-map-marker"></i>&nbsp;Activity</a></li>
                    <li>
                        <a href="'.$CONFIG->wwwroot.'/admin/user_summary/'.$this->_user->id.'">
                            <i class="icon-list"></i>&nbsp;Summary</a></li>
                    <li>
                        <a href="'.$CONFIG->wwwroot.'/admin/user_account/'.$this->_user->id.'">
                            <i class="icon-cog"></i>&nbsp;Account</a></li>
                </ul>

				<table class="table inline-table" >
					<thead>
						<tr>
							<th>Action</th>
							<th>Time</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>' . $activity_table_content . '
					</tbody>
				</table>
			</section>';
        
  	}
}
