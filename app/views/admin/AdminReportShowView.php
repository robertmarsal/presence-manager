<?php

class AdminReportShowView extends View{

    private $_user;
	private $_range;

    public function __construct($user, $range, $intervals, $alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_user = $user;
		$this->_range = $range;
        $this->_intervals = $intervals;

        $this->title($STRINGS['user']);
    }

	public function menu(){
        return MenuHelper::admin_base_menu('report');
	}

	public function content(){

        $intervals_list = '<ol>';
        foreach($this->_intervals as $interval){
            $intervals_list .='<li>'.$interval->h.'h  '.$interval->i.'m  '.$interval->s.'s ||
                '.date('G:i:s D M j Y', $interval->timestart).' @ '.
                  date('G:i:s D M j Y', $interval->timestop).'

            </li>';
        }
        $intervals_list.= '</ol>';

		return '
            <section id="report-show" class="well">
				<div id="report-actions" class="pull-right">
					<a class="btn" href="#"><i class="icon-eye-open"></i>&nbsp;JSON</a>
					<a class="btn" href="#"><i class="icon-eye-open"></i>&nbsp;HTML</a>
				</div>

			<div class="page-header">
			</div>
			<table>
				<tr>
				<td style="min-width:80px;"></td>
				</tr>
				<tr>
					<td><strong>User: </strong></td>
					<td>'.$this->_user->firstname.' '.$this->_user->lastname.'</td>
				</tr>
				<tr>
					<td><strong>Issued:</strong></td>
					<td>'.date("F j, Y, g:i a").'</td>
				</tr>
				<tr>
					<td><strong>Period: </strong></td>
					<td>'.$this->_range->timestart.' to '.$this->_range->timeend.'</td>
				</tr>
                <tr>
					<td><strong>Intervals: </strong></td>
					<td>'.$intervals_list.'</td>
				</tr>
                <tr>
					<td><strong>Total: </strong></td>
					<td>'.$this->_range->total.'</td>
				</tr>
			</table>

            </section>';

	}

}
