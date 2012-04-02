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
        
        global $STRINGS;
        
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
            '.MenuHelper::admin_submenu('summary', $this->_user).'
				<table class="table inline-table">
					<thead>
						<tr>
							<th>'.$STRINGS['interval'].'</th>
							<th>'.$STRINGS['starttime'].'</th>
							<th>'.$STRINGS['startdate'].'</th>
							<th>'.$STRINGS['endtime'].'</th>
							<th>'.$STRINGS['enddate'].'</th>
							<th>'.$STRINGS['week'] .'</th>
							<th>'.$STRINGS['month'] .'</th>
							<th>'.$STRINGS['year'] .'</th>
						</tr>
					</thead>
					<tbody>' . $summary_table_content . '
					</tbody>
				</table>
			</section>';
	}

}
