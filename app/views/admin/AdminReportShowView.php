<?php

class AdminReportShowView extends View{

    private $_user;
	private $_range;

    public function __construct($user, $range, $intervals, $alert = null) {

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
        global $STRINGS;
        if(empty($this->_intervals)){
            return BootstrapHelper::alert('info',
                    $STRINGS['event:noactivity'],
                    $STRINGS['event:noactivityinterval:message']);
        }

        $intervals_list = '<table class="table table-bordered table-condensed">';
        foreach($this->_intervals as $interval){
            $intervals_list .='<tr>
                <td>'.$interval->h.'h  '.$interval->i.'m  '.$interval->s.'s </td>
                <td>'.date('G:i:s D M j Y', $interval->timestart).' </td>
                <td>'.date('G:i:s D M j Y', $interval->timestop).' </td>
                </tr>';
        }
        $intervals_list.= '</table>';

		return '
            <section id="report-show" class="well">
				<div id="report-actions" class="pull-right">
					<a class="btn" href="#"><i class="icon-eye-open"></i>&nbsp;JSON</a>
				</div>

			<table >
				<tr>
				<td style="min-width:80px;"></td>
				</tr>
				<tr>
					<td><strong>'.$STRINGS['user'].': </strong></td>
					<td>'.$this->_user->firstname.' '.$this->_user->lastname.'</td>
				</tr>
				<tr>
					<td><strong>'.$STRINGS['issued'].':</strong></td>
					<td>'.date("F j, Y, g:i a").'</td>
				</tr>
				<tr>
					<td><strong>'.$STRINGS['period'].': </strong></td>
					<td>'.$this->_range->timestart.' to '.$this->_range->timeend.'</td>
				</tr>
                <tr>
					<td><strong>'.$STRINGS['intervals'].': </strong></td>
					<td><br>'.$intervals_list.'</td>
				</tr>
                <tr>
					<td><strong>'.$STRINGS['total'].': </strong></td>
					<td>'.$this->_range->total.'</td>
				</tr>
			</table>

            </section>';

	}

}
