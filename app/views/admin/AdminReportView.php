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

        $users_options = null;
        if($this->_users){

            foreach($this->_users as $user){
                $users_options .= '<option value="'.$user->id.'">
                                      '.$user->firstname.' '.$user->lastname.'</option>';
            }
            return '
            <section id="report-build">
                <form>
                    <label>User</label>
                    <select id="user">
                        '.$users_options.'
                    </select>
                </form>
            </section>';
        }
	}

}