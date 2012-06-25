<?php

class UserReportView extends View {

	private $_user;
	
	public function __construct($user, $alert = null) {
		
		global $STRINGS;
		
		$this->_user = $user;
		
		$this->title($STRINGS['user']);
	}
	
	public function menu() {
		return MenuHelper::user_base_menu('report');
	}
	
	public function content(){
	
		global $CONFIG, $STRINGS;
	
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
			<form action="'.$CONFIG->wwwroot.'/user/report/new/build" method="post" >
					<label><i class="icon-calendar"></i>&nbsp;'.$STRINGS['startdate'].'</label>
                    <input type="text" class="span2" value="'.date('d-m-Y').'" id="dp_start" name="dp_start">

                    <label><i class="icon-calendar"></i>&nbsp;'.$STRINGS['enddate'].'</label>
                    <input type="text" class="span2" value="'.date('d-m-Y').'" id="dp_end" name="dp_end">

					<input type="hidden" name="user" value="'.$this->_user->id.'">
					
					<label></label>
					<button type="submit" class="btn">'.$STRINGS['build:report'].'</button>
                </form>
            </section>';
	}
	
}