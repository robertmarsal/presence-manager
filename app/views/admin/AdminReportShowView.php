<?php

class AdminReportShowView extends View{

    public function __construct($data, $alert = null) {
        global $STRINGS;
        $this->_data = $data;
        $this->title($STRINGS['user']);
    }

	public function menu(){
        return MenuHelper::admin_base_menu('report');
	}

	public function content(){
        global $STRINGS;
        if(empty($this->_data->intervals)){
            return BootstrapHelper::alert('info',
                    $STRINGS['event:noactivity'],
                    $STRINGS['event:noactivityinterval:message']);
        }

        $intervals_list = '<table class="table inner-table">';
        foreach($this->_data->intervals as $interval){
            $intervals_list .='<tr>
                <td>'.$interval->h.'h  '.$interval->i.'m  '.$interval->s.'s</td>
                <td><span class="label label-success">
				'.date('G:i:s D M j Y', $interval->timestart).'
				</span></td>
                <td><span class="label label-important">
				'.date('G:i:s D M j Y', $interval->timestop).'
				</span></td>
                </tr>';
        }
        $intervals_list.= '</table>';

        $incidences_list = '<ul>';
        foreach($this->_data->incidences as $incidence){
            $incidences_list .= '<li>
				<span class="label label-warning">
                '.date('G:i:s D M j Y', $incidence->timestamp).'
				</span>
                </li>';
        }
        $incidences_list.= '</ul>';

        return '
            <section id="report-show" class="well">


			<table class="table report-table">
				<tr>
					<td><strong>'.$STRINGS['user'].': </strong></td>
					<td>'.$this->_data->user->firstname.' '.$this->_data->user->lastname.' (<b>'.$this->_data->user->identifier.'</b>)</td>
				</tr>
				<tr>
					<td><strong>'.$STRINGS['issued'].':</strong></td>
					<td>'.date("F j Y g:i a").'</td>
				</tr>
				<tr>
					<td><strong>'.$STRINGS['period'].': </strong></td>
					<td>'.$this->_data->range->timestart.' to '.$this->_data->range->timeend.'</td>
				</tr>
                <tr>
					<td><strong>'.$STRINGS['intervals'].': </strong></td>
					<td>'.$intervals_list.'</td>
				</tr>
                <tr>
                    <td><strong>'.$STRINGS['incidences'].':</strong></td>
                    <td>'.$incidences_list.'</td>
                </tr>
                <tr>
					<td><strong>'.$STRINGS['total'].': </strong></td>
					<td>'.$this->_data->range->total.'</td>
				</tr>
			</table>

            </section>';

	}

}