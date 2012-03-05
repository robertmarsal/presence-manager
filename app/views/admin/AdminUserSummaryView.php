 <?php

class AdminUserSummaryView extends View{

	private $_user;
	private $_intervals;

    public function __construct($user, $intervals, $alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_user = $user;
		$this->_intervals = $intervals;
        $this->_alert = $alert;

        $this->title($STRINGS['user']);
    }

	public function menu(){

		global $CONFIG;

        return '
			<ul class="nav">
				<li><a href="' . $CONFIG->wwwroot . '/admin/activity">Activity</a></li>
				<li class="active"><a href="' . $CONFIG->wwwroot . '/admin/users">Users</a></li>
				<li><a href="' . $CONFIG->wwwroot . '/admin/report">Report</a></li>
			</ul>
			<ul class="nav pull-right no-hover-a">
				<p class="navbar-text pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout">Log Out</a></p>
			</ul>';
	}

    public function subnav(){

        global $CONFIG;

        return '
		<ul class="nav nav-tabs">
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_details/'.$this->_user->id.'">Details</a></li>
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_activity/'.$this->_user->id.'">Activity</a></li>
            <li class="active"><a href="'.$CONFIG->wwwroot.'/admin/user_summary/'.$this->_user->id.'">Summary</a></li>
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_account/'.$this->_user->id.'">Account</a></li>
            <li class="id-tab">'.$this->_user->firstname.' '.$this->_user->lastname.'</li>
		</ul>';
    }

	public function content(){

		global $CONFIG;

		$summary_table_content = null;
		if($this->_intervals){
			foreach ($this->_intervals as $interval){
				$summary_table_content .= '
					<tr>
						<td>'.$interval->h.' h '.$interval->i.' m '.$interval->s.' s</td>
						<td>'.date('G:i:s', $interval->timestart).'</td>
						<td>'.date('D j', $interval->timestart).'</td>
						<td>'.date('G:i:s', $interval->timestop).'</td>
						<td>'.date('D j', $interval->timestop).'</td>
						<td>'.$interval->week.'</td>
						<td>'.date('F', mktime(0,0,0,$interval->month)).'</td>
						<td>'.$interval->year.'</td>
					</tr>';
			}

			return '
			<section id="user-summary">
				<table class="table">
					<thead>
						<tr>
							<th>Interval</th>
							<th>Start Time</th>
							<th>Start Date</th>
							<th>End Time</th>
							<th>End Date</th>
							<th>Week</th>
							<th>Month</th>
							<th>Year</th>
						</tr>
					</thead>
					<tbody>' . $summary_table_content . '
					</tbody>
				</table>
			</section>';
		}else{
			return Helper::alert('info', 'No Summary!');
		}
	}

}
