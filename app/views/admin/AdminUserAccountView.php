<?php

class AdminUserAccountView extends View{

	public function title(){
		global $STRINGS;
		return $STRINGS['user'];
	}

	public function menu(){
		return MenuHelper::admin_base_menu('users');
	}

	public function content(){

		global $CONFIG, $STRINGS;

		return '
		<section id="user-account" class="well min-table">
		'.MenuHelper::admin_submenu('account', $this->_data->user).'
		<form action="'.$CONFIG->wwwroot.'/admin/users/'.$this->_data->user->id.'/updateaccount"  method="post">
		<label>'.Lang::get('uuid').'</label>
		<input type="text" class="span4" name="uuid" placeholder="00000000-0000-0000-0000-000000000000">

		<label>'.$STRINGS['mac'].'</label>
		<input type="text" class="span4" name="mac" placeholder="00:00:00:00:00:00">
		
		<label></label>
		<input type="submit" class="btn" value="'.Lang::get('update').'">
		</form>
		<small>'.Lang::get('useraccountnotice').'</small>
		<hr>
		<form action="' . $CONFIG->wwwroot . '/admin/users/'.$this->_data->user->id.'/delete" method="post">
		<input type="submit" class="btn btn-danger" value="'.$STRINGS['event:delete:account'].'">
		<span class="help-inline">'.$STRINGS['event:delete:account:warning'].'</span>
		</form>
		</section>
		';

	}
}
