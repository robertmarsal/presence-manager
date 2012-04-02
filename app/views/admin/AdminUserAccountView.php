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

		global $CONFIG, $STRINGS;

		return '
		<section id="user-account" class="well min-table">
        '.MenuHelper::admin_submenu('account', $this->_user).'
			<form action="' . $CONFIG->wwwroot . '/admin/users/'.$this->_user->id.'/delete" method="post">
                <input type="submit" class="btn btn-danger" value="'.$STRINGS['event:delete:account'].'">
                    <span class="help-inline">'.$STRINGS['event:delete:account:warning'].'</span>
			</form>
		</section>
		';

	}
}
