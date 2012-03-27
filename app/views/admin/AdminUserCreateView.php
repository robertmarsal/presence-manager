<?php

class AdminUserCreateView extends View {

    public function menu() {
        return MenuHelper::admin_base_menu('users');
    }

    public function content() {

        global $CONFIG, $STRINGS;

        return '
	    <section id="new-user" class="well">
            <form action="'.$CONFIG->wwwroot.'/admin/create_user" method="post">
                <label>First Name</label>
                <input type="text" name="firstname">

                <label>Last Name</label>
                <input type="text" name="lastname">

                <label>Email</label>
                <input type="text" name="email">

                <label>Password</label>
                <input type="text" name="password">

                <label>Position</label>
                <input type="text" name="position">

                <label>Role</label>
                <select name="role">
                    <option>user</option>
                    <option>admin</option>
                </select>

                <label></label>
                <button type="submit" class="btn">'.$STRINGS['create:user'].'</button>
            </form>
        </section>';
    }

}
