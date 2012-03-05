<?php

class AdminReportView extends View{

    private $_users;

    public function __construct($users, $alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_users = $users;

        $this->title($STRINGS['user']);
    }

	public function menu(){

		global $CONFIG;

        return '
			<ul class="nav">
				<li><a href="' . $CONFIG->wwwroot . '/admin/activity">Activity</a></li>
				<li><a href="' . $CONFIG->wwwroot . '/admin/users">Users</a></li>
				<li class="active"><a href="' . $CONFIG->wwwroot . '/admin/report">Report</a></li>
			</ul>
			<ul class="nav pull-right no-hover-a">
				<p class="navbar-text pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout">Log Out</a></p>
			</ul>';
	}

	public function content(){

		global $STRINGS, $CONFIG;
	
        $users_options = null;
        if($this->_users){

            foreach($this->_users as $user){
                $users_options .= '<option value="'.$user->id.'">
                                      '.$user->firstname.' '.$user->lastname.'</option>';
            }
			
            return '
            <section id="report-build">
                <form action="'.$CONFIG->wwwroot.'/admin/report_build" method="post" >
                    <label>User</label>
                    <select id="user">
                        '.$users_options.'
                    </select>
					<label>Date Range</label>
					<input type="text" name="timestart" placeholder="dd/mm/yyyy"> to <input type="text" name="timeend" placeholder="dd/mm/yyyy">
					<label>Hour Rate</label>
					<input type="text" name="rate">
					
					<label></label>
					<button type="submit" class="btn">'.$STRINGS['build:report'].'</button>
                </form>
            </section>';
        }
	}

}
