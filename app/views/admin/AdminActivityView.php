<?php

class AdminActivityView extends View {

	public function title(){
		return Lang::get('activity');
	}

	public function menu() {
		return MenuHelper::admin_base_menu('activity');
	}

	public function content() {

		global $CONFIG;

		if(empty($this->_data->activity)){
			return BootstrapHelper::alert('info',
					Lang::get('event:noactivity'),
					Lang::get('event:noactivity:message'));
		}

		//check if there is a next page (page count starts at 0 thus the +1)
		$this->_data->page + 1 < ActivityModel::pages()
		? $next = true
		: $next = false;

		$activity_table_content = '';
		foreach ($this->_data->activity as $entry) {
			$activity_table_content .=
			'<tr>
			<td>' . $entry->id . '</td>
			<td><span class="label ' . BootstrapHelper::get_label_for_action($entry->action). '">' . BootstrapHelper::get_event_description($entry->action) . '</span></td>
			<td>'.Lang::get('dayofweek'.date('N', $entry->timestamp)).'</td>
			<td>' . date('d/m/Y', $entry->timestamp) . '</td>
			<td>' . date('G:i:s', $entry->timestamp) . '</td>
			<td>' . utf8_encode($entry->firstname).'</td>
			<td>'.utf8_encode($entry->lastname) . '</td>
			<td><a href="'.$CONFIG->wwwroot.'/admin/users/'.$entry->userid.'/details">'.$entry->identifier.'</a></td>
			</tr>
			';
		}

		return '
		<section id="activity" class="well">
		<table class="table">
		<thead>
		<tr>
		<th>#</th>
		<th>'.Lang::get('action').'</th>
		<th>'.Lang::get('day').'</th>
		<th>'.Lang::get('date').'</th>
		<th>'.Lang::get('time').'</th>
		<th>'.Lang::get('firstname').'</th>
		<th>'.Lang::get('lastname').'</th>
		<th>'.Lang::get('identifier').'</th>
		</tr>
		</thead>
		<tbody>' . $activity_table_content . '
		</tbody>
		</table>
		'.MenuHelper::get_pagination_links($CONFIG->wwwroot.'/admin/activity/',$this->_data->page, $next).'
		<div class="container"></div>
		</section>';
	}
}
