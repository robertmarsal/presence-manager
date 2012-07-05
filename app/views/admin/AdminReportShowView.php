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

        $intervals_list = '<ul>';
        foreach($this->_data->intervals as $interval){
            $intervals_list .='<li>
                '.$interval->h.'h  '.$interval->i.'m  '.$interval->s.'s
                '.date('G:i:s D M j Y', $interval->timestart).'
                '.date('G:i:s D M j Y', $interval->timestop).'
                </li>';
        }
        $intervals_list.= '</ul>';

        $incidences_list = '<ul>';
        foreach($this->_data->incidences as $incidence){
            $incidences_list .= '<li>
                '.date('G:i:s D M j Y', $incidence->timestamp).'
                </li>';
        }
        $incidences_list.= '</ul>';

        return '
            <section id="report-show" class="well">


			<table class="table report-table">
				<tr>
					<td><strong>'.$STRINGS['user'].': </strong></td>
					<td>'.$this->_data->user->firstname.' '.$this->_data->user->lastname.'</td>
				</tr>
				<tr>
					<td><strong>'.$STRINGS['issued'].':</strong></td>
					<td>'.date("F j, Y, g:i a").'</td>
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