<?php

class CronController extends Controller{

    private $_activity_model;
    private $_user_model;
    
    public function __construct($dependencies, $action, $params) {
  
        global $CONFIG;
            
        // get the dependencies
        $this->_dependencies = $dependencies;
     
        // instantiate the models
        $this->_activity_model = new ActivityModel($this->_dependencies);
        $this->_user_model = new UserModel($this->_dependencies);
    
        // check if the required action is defined
        if (method_exists($this, $action)) {
            $this->$action($params);
        }
    }

    private function run() {
    
        global $CONFIG;

        $verbose = $CONFIG['verbose'];

        //get all users
            $verbose && print_r("Fetching All Users\n");
        
        $users = $this->_user_model->get_all_users();
       
            ($verbose && $users) ? print_r("Ok\n") : print_r("Failed!\n");
        
        foreach($users as $user) {
            
            //get activity without incidences
            //TODO: get only not calculated activity
            $activity = $this->_activity_model->get_user_activity_no_incidence($user['id']);
            if($activity){
                //group 2 by 2
                $grouped_activities = null;
                for($i=0; $i<count($activity); $i=$i+2){
                    //group only when we have both members
                    $activity[$i] && $activity[$i+1] && $grouped_activities[] = array($activity[$i], $activity[$i+1]);
                }

                //compute final activity array
                $final_activities = null;
                foreach($grouped_activities as $gactivity){
                    //check data integrity
                    if($gactivity[0]['action'] == 'checkin' && $gactivity[1]['action'] == 'checkout'){
                        
                        //compute the interval
                        $date_start = new DateTime(date(DATE_ATOM, $gactivity[0]['timestamp']));
                        $date_end = new DateTime(date(DATE_ATOM, $gactivity[1]['timestamp']));
                        $interval = $date_start->diff($date_end);


                        $final_activities[] = array('userid' => $gactivity[0]['userid'],
                                                    'timestart' => $gactivity[0]['timestamp'],
                                                    'timestop' => $gactivity[1]['timestamp'],
                                                    'interval' => array('y' => $interval->y,
                                                                        'm' => $interval->m,
                                                                        'd' => $interval->d,
                                                                        'h' => $interval->h,
                                                                        'i' => $interval->i,
                                                                        's' => $interval->s)
                                                    );
                    }else{
                        die(print_r("FATAL: Corrupted database!"));
                    }
                }
                print_r($final_activities);
            }
        }
    }

}
