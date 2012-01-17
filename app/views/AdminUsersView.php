<?php

class AdminUsersView extends View {

    private $_users;

    public function __construct($users) {

        global $string;

        $this->_users = $users;
        $this->title($string['users']);
    }

    public function menu() {

        global $config;

        return '
			<ul class="nav">
				<li><a href="' . $config['wwwroot'] . '/admin/activity">Activity</a></li>
				<li class="active"><a href="' . $config['wwwroot'] . '/admin/users">Users</a></li>
                <li><a href="' . $config['wwwroot'] . '/admin/help">Help</a></li>
			</ul>
			<ul class="nav secondary-nav">
				<li><a href="' . $config['wwwroot'] . '/auth/logout">Log Out</a></li>
			</ul>';
    }

    public function content() {

        global $config;

        $users_table_content = '';
        if (!empty($this->_users)) {
            foreach ($this->_users as $user) {
                $users_table_content .= '
				<tr>
					<td>' . $user['id'] . '</td>
					<td>' . utf8_encode($user['firstname']) . '</td>
					<td>' . utf8_encode($user['lastname']) . '</td>
                    <td>' . $user['role'] . '</td>
					<td><a href="'.$config['wwwroot'].'/admin/user_details/'.$user['id'].'">' . $user['email'] . '</a></td>
				 </tr>
				';
            }
        }

        return '
			<table class="activity_table zebra-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
                        <th>Role</th>
						<th>User</th>
					</tr>
				</thead>
				<tbody>
				' . $users_table_content . '
				</tbody>
			</table>';
    }

}