<?php

class AdminUsersView extends View {

    private $_users;

    public function __construct($users, $alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_users = $users;
        $this->_alert = $alert;

        $this->title($STRINGS['users']);
    }

    public function menu() {

        global $CONFIG;

        return '
			<ul class="nav">
				<li><a href="' . $CONFIG['wwwroot'] . '/admin/activity">Activity</a></li>
				<li class="active"><a href="' . $CONFIG['wwwroot'] . '/admin/users">Users</a></li>
			</ul>
			<ul class="nav pull-right">
				<li><a href="' . $CONFIG['wwwroot'] . '/auth/logout">Log Out</a></li>
			</ul>';
    }
    
    public function content() {

        global $CONFIG, $STRINGS;

        $users_table_content = '';
        if (!empty($this->_users)) {
            foreach ($this->_users as $user) {
                $users_table_content .= '
				<tr>
					<td>' . $user['id'] . '</td>
					<td>' . utf8_encode($user['firstname']) . '</td>
					<td>' . utf8_encode($user['lastname']) . '</td>
                    <td>' . $user['role'] . '</td>
					<td><a href="'.$CONFIG['wwwroot'].'/admin/user_details/'.$user['id'].'">' . $user['email'] . '</a></td>
				 </tr>
				';
            }
        }

        return '
        <section id="users" class="well">
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    '.$users_table_content.'
                </tbody>
            </table>
            <form action="' . $CONFIG['wwwroot'] . '/admin/user_add" method="post">
				<button class="btn btn-success well-button">+ '.$STRINGS['add:user'].'</button>
			</form>
        </section>';
    }

}
