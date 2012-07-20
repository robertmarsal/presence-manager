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
        global $CONFIG, $STRINGS;

        $this->_data->week == date('W')
        ? $next = false
        : $next = true;
        
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
		
		$monday = date('d/m/Y', strtotime('Last Monday', mktime (1,1,1,1,7*$this->_data->week,date('Y'))));
		$sunday = date('d/m/Y', strtotime('Next Sunday', mktime (1,1,1,1,7*$this->_data->week,date('Y'))));
		
		return '
		<section id="user-activity" class="well">
		<div class="week-header">
		<b>'.Lang::get('period').'</b> '.$monday.' - '.$sunday.'
		</div>
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
		'.MenuHelper::get_pagination_links($CONFIG->wwwroot.'/user/activity/',$this->_data->week, $next).'
		<div class="container"></div>
		</section>';
    }

}
