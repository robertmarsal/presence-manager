<?php

class UserActivityView extends View {
	
	public function title(){
		global $STRINGS;
		return $STRINGS['activity'];
	}
	
    public function menu() {
    	return MenuHelper::user_base_menu('activity');
    }

    public function content() {
        global $STRINGS;

        if(empty($this->_data->intervals)){
        	return BootstrapHelper::alert('info',
        			Lang::get('event:noactivity'),
        			Lang::get('event:noactivity:message'));
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
		<section id="user-activity" class="well">
		<table class="table report-table">
		<tr>
		<td><strong>'.$STRINGS['intervals'].' </strong></td>
		<td>'.$intervals_list.'</td>
		</tr>
		<tr>
		<td><strong>'.$STRINGS['incidences'].'</strong></td>
		<td>'.$incidences_list.'</td>
		</tr>
		</table>
		</section>';
    }

}
