<?php

class CronController extends Controller{

	public function __construct($action, $params) {

		// check if the required action is defined
		if (method_exists($this, $action)) {
			$this->$action($params);
		}
	}

	private function run($params) {

		//compute intervals
		$this->compute_intervals($params);

		//clean old tokens
		$this->clean_old_tokens();
	}

	private function compute_intervals($params){
		 
		if(isset($params[0]) && !empty($params[0])){
			//a user is specified
			$users = array('user' => UserModel::find($params[0]));
		}else{
			//all users
			$users = UserModel::find_all();
		}

		if($users){
			foreach($users as $user) {
				//get activity without incidences
				$activity = ActivityModel::find_all_by_user_not_computed($user->id);
				 
				if($activity){
					$activity_entries = array();
					 
					//group 2 by 2
					$grouped_activities = null;
					for($i=0; $i<count($activity); $i=$i+2){
						//group only when we have both members
						if($activity[$i] && $activity[$i+1]){
							$grouped_activities[] = array($activity[$i], $activity[$i+1]);
							//mark activities as computed
							$activity_entries[] = $activity[$i]->id;
							$activity_entries[] = $activity[$i+1]->id;
						}
					}
					 
					$intervals = null;
					foreach($grouped_activities as $gactivity){
						 
						//check data integrity
						if($gactivity[0]->action == 'checkin' && $gactivity[1]->action == 'checkout'){
							 
							//compute the interval
							$date_start = new DateTime(date(DATE_ATOM, $gactivity[0]->timestamp));
							$date_end = new DateTime(date(DATE_ATOM, $gactivity[1]->timestamp));
							$date_diff = $date_start->diff($date_end);
							 
							$interval = new stdClass();
							$interval->userid = $gactivity[0]->userid;
							$interval->timestart = $gactivity[0]->timestamp;
							$interval->timestop = $gactivity[1]->timestamp;
							$interval->timediff = ($gactivity[1]->timestamp-$gactivity[0]->timestamp);
							$interval->week = date('W', $gactivity[0]->timestamp);
							$interval->month = date('n', $gactivity[0]->timestamp);
							$interval->year = date('o', $gactivity[0]->timestamp);
							$interval->y = $date_diff->y;
							$interval->m = $date_diff->m;
							$interval->d = $date_diff->d;
							$interval->h = $date_diff->h;
							$interval->i = $date_diff->i;
							$interval->s = $date_diff->s;
							 
							$intervals[] = $interval;
							 
						}else{
							die(print_r("FATAL: Corrupted database!\n"));
						}
					}
					 
					//save the intervals to the DB
					if($intervals){
						IntervalModel::create_multiple($intervals);
					}
					 
					if($activity_entries){
						ActivityModel::mark_as_computed($activity_entries);
					}
				}
				 
			}
		}
	}

	private function clean_old_tokens(){
		$tokens  = AuthModel::find_all();
		$to_remove = array();
		foreach($tokens as $token){
			if($token->timeexpires < time()){
				$to_remove[] = $token->id;
			}
		}

		$sql = "DELETE FROM presence_auth
		WHERE id IN(".implode(',', $to_remove).")";
		DB::runSQL($sql, array());
	}
}