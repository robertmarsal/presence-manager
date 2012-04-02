<?php

class AdminUserAccountView extends View{

	private $_user;

    public function __construct($user) {

        global $STRINGS;

        $this->_user = $user;

        $this->title($STRINGS['user']);
    }

	public function menu(){
        return MenuHelper::admin_base_menu('users');
    }

	public function content(){

		global $CONFIG;

		return '
		<section id="user-account" class="well min-table">
        '.MenuHelper::admin_submenu('account', $this->_user).'
			<form action="' . $CONFIG->wwwroot . '/admin/users/'.$this->_user->id.'/delete" method="post">
                <input type="submit" class="btn btn-danger" value="Delete Account">
                    <span class="help-inline">Warning! This action can not be undone!</span>
			</form>
		</section>
		';

	}
}
