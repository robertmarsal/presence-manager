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

            <ul class="nav nav-list well inline-menu">
                <li class="id-tab">
                    <i class="icon-user"></i>&nbsp;'.$this->_user->firstname.' '.$this->_user->lastname.'
                </li>
                <li>&nbsp;</li>

                <li>
                    <a href="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/details">
                        <i class="icon-edit"></i>&nbsp;Details</a>
                </li>
                <li >
                    <a href="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/activity">
                        <i class="icon-map-marker"></i>&nbsp;Activity</a></li>
                <li>
                    <a href="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/summary">
                        <i class="icon-list"></i>&nbsp;Summary</a></li>
                <li class="active">
                    <a href="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/account">
                        <i class="icon-cog"></i>&nbsp;Account</a></li>
            </ul>

			<form action="' . $CONFIG->wwwroot . '/admin/users/'.$this->_user->id.'/delete" method="post">
                <input type="submit" class="btn btn-danger" value="Delete Account">
                    <span class="help-inline">Warning! This action can not be undone!</span>
			</form>
		</section>
		';

	}
}
