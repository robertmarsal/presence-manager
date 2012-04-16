<?php

class AdminUsersView extends View {

    private $_users;
    private $_page;

    public function __construct($users, $page = 0, $alert = null) {

        global $STRINGS;

        $this->_users = $users;
        $this->_alert = $alert;
        $this->_page = $page;

        $this->title($STRINGS['users']);
    }

    public function menu() {
        return MenuHelper::admin_base_menu('users');
    }

    public function content() {

        global $CONFIG, $STRINGS;

        $users_table_content = '';
        if (empty($this->_users)) {
            return BootstrapHelper::alert('info',
                    $STRINGS['event:nousers'],
                    $STRINGS['event:nouser:message']);
        }

        //check if there is a next page
        count($this->_users) == 10 ? $next = true : $next = false;

        foreach ($this->_users as $user) {
            $users_table_content .= '
				<tr>
					<td>' . $user->id . '</td>
					<td>' . utf8_encode($user->firstname) . '</td>
					<td>' . utf8_encode($user->lastname) . '</td>
                    <td>' . $user->role . '</td>
                    <td>' . $user->position . '</td>
					<td><a href="'.$CONFIG->wwwroot.'/admin/users/'.$user->id.'/details">' . $user->email . '</a></td>
				 </tr>
				';
        }


        return '
        <section id="users">
         <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>'.$STRINGS['firstname'] .'</th>
                        <th>'.$STRINGS['lastname'] .'</th>
                        <th>'.$STRINGS['role'] .'</th>
                        <th>'.$STRINGS['position'] .'</th>
                        <th>'.$STRINGS['email'] .'</th>
                    </tr>
                </thead>
                <tbody>
                    '.$users_table_content.'
                </tbody>
            </table>
		    <form action="' . $CONFIG->wwwroot . '/admin/users/new/add" method="post">
				<button class="btn btn-success ">+ '.$STRINGS['add:user'].'</button>
                '.MenuHelper::get_pagination_links($CONFIG->wwwroot.'/admin/users/', $this->_page, $next).'
			</form>

        </section>';
    }

}
