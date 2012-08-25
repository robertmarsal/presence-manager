<?php

class AdminReportView extends View{

	public function title(){
		global $STRINGS;
		return $STRINGS['report'];
	}

	public function menu(){
		return MenuHelper::admin_base_menu('report');
	}

	public function content(){

		global $STRINGS, $CONFIG;

		$users_options = null;
		if(isset($this->_data->users)){
			foreach($this->_data->users as $user){
				$users_options .= '<option value="'.$user->id.'">
				'.$user->firstname.' '.$user->lastname.'</option>';
			}

		return '
		<script>
			$(function(){
			$("#dp_start").datepicker({
			format: "dd-mm-yyyy"
			});

			$("#dp_end").datepicker({
			format: "dd-mm-yyyy"
			});
			});
		</script>
		<section id="report-build" class="well">
		<form action="'.$CONFIG->wwwroot.'/admin/report/new/build" method="post" >
		<label><i class="icon-user"></i>&nbsp;'.$STRINGS['user'].'</label>
		<select id="user" name="user">
		'.$users_options.'
		</select>
		<label><i class="icon-calendar"></i>&nbsp;'.$STRINGS['startdate'].'</label>
		<input type="text" class="span2" value="'.date('d-m-Y').'" id="dp_start" name="dp_start">

		<label><i class="icon-calendar"></i>&nbsp;'.$STRINGS['enddate'].'</label>
		<input type="text" class="span2" value="'.date('d-m-Y').'" id="dp_end" name="dp_end">

		<label></label>
		<button type="submit" class="btn">'.$STRINGS['build:report'].'</button>
		</form>
		</section>';
		}
	}

}
