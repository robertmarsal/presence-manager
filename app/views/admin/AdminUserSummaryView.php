 <?php

class AdminUserSummaryView extends View{

	private $_user;
	private $_intervals;

    public function __construct($user, $intervals, $alert = null) {

        global $STRINGS;

        $this->_user = $user;
		$this->_intervals = $intervals;
        $this->_alert = $alert;

        $this->title($STRINGS['user']);
    }

	public function menu(){
        return MenuHelper::admin_base_menu('users');
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
        }

		return '
			<section id="user-summary" class="well min-table">

                <ul class="nav nav-list well inline-menu">
                    <li class="id-tab">
                        <i class="icon-user"></i>&nbsp;'.$this->_user->firstname.' '.$this->_user->lastname.'
                    </li>
                    <li>&nbsp;</li>

                    <li>
                        <a href="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/details">
                            <i class="icon-edit"></i>&nbsp;Details</a>
                    </li>
                    <li>
                        <a href="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/activity">
                            <i class="icon-map-marker"></i>&nbsp;Activity</a></li>
                    <li class="active">
                        <a href="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/summary">
                            <i class="icon-list"></i>&nbsp;Summary</a></li>
                    <li>
                        <a href="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/account">
                            <i class="icon-cog"></i>&nbsp;Account</a></li>
                </ul>

				<table class="table inline-table">
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
	}

}
