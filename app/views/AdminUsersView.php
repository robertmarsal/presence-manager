<?php

class AdminUsersView extends View{

	private  $_users;

	public function __construct($users){

        global $string;

		$this->_users = $users;
        $this->title($string['users']);
	}

    public function body(){

		global $config;

		$users_table_content = '';
		if(!empty($this->_users)){
			foreach($this->_users as $user){
				$users_table_content .= '
				<tr>
					<td>'.$user['id'].'</td>
					<td>'.utf8_encode($user['firstname']).'</td>
					<td>'.utf8_encode($user['lastname']).'</td>
					<td>'.$user['email'].'</td>
					<td>'.$user['role'].'</td>
				 </tr>
				';
			}
		}

		return '
		<div class="topbar" id="topbar-container">
			<div class="topbar-inner">
				<div class="container">
					<a class="brand" href="'.$config['wwwroot'].'">Presence</a>
					<ul class="nav">
						<li><a href="'.$config['wwwroot'].'/admin/activity">Activity</a></li>
						<li class="active"><a href="'.$config['wwwroot'].'/admin/users">Users</a></li>
					</ul>
					<ul class="nav secondary-nav">
						<li><a href="'.$config['wwwroot'].'/auth/logout">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<table class="activity_table">
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>User</th>
						<th>Role</th>
					</tr>
				</thead>
				<tbody>
				'.$users_table_content.'
				</tbody>
			</table>
		</div>';
    }

}