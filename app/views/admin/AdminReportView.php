<?php

class AdminReportView extends View{

    public function __construct($alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_alert = $alert;

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
        
		return '
        <section id="report-build">
        
        </section>';
	}

}
