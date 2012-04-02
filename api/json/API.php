<?php

class API{

	protected function validate($params){

		//TODO: more user data for validation
		$sql = "SELECT *
				FROM `presence_users`
				WHERE `mac` = ?";

		$user = DB::getRecord($sql, array($params['mac']));

		if($user->id == null){
			API::errResponse('401', 'Unauthorized');
		}

		return $user->id;
	}

	static function response($message){
		header('HTTP/1.1 202 Accepted');
		print (json_encode($message));
		die();
	}

	static function errResponse($code, $message){
		header('HTTP/1.1 '.$code.' '.$message);
		print (json_encode($message));
		die();
	}
}
