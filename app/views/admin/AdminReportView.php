<?php

class AdminReportView extends View{

    private $_users;

    public function __construct($users, $alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_users = $users;

        $this->title($STRINGS['user']);
    }

	public function menu(){
        return MenuHelper::admin_base_menu('report');
	}

	public function content(){

		global $STRINGS, $CONFIG;
	
        $users_options = null;
        if($this->_users){

            foreach($this->_users as $user){
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
                <form action="'.$CONFIG->wwwroot.'/admin/report_build" method="post" >
                    <label><i class="icon-user"></i>&nbsp;User</label>
                    <select id="user" name="user">
                        '.$users_options.'
                    </select>
					<label><i class="icon-calendar"></i>&nbsp;Start Date</label>
                    <input type="text" class="span2" value="02-16-2012" id="dp_start" name="dp_start">
                    
                    <label><i class="icon-calendar"></i>&nbsp;End Date</label>
                    <input type="text" class="span2" value="02-16-2012" id="dp_end" name="dp_end">
					
                    <label><i class="icon-time"></i>&nbsp;Hour Rate / Currency</label>
					<input type="text" class="span0" name="rate">
					<input type="text" class="span1" name="currency">
                    
					<label></label>
					<button type="submit" class="btn">'.$STRINGS['build:report'].'</button>
                </form>
            </section>';
        }
	}

}
