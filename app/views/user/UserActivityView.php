<?php

class UserActivityView extends View {
	
    public function menu() {
    	return MenuHelper::user_base_menu('activity');
    }

    public function content() {
        global $STRINGS;

        //set the title
        parent::title($STRINGS['activity']);
        
        //set the content
        $activity_table_content = '';
        if (!empty($this->_data->activity)) {
            foreach ($this->_data->activity as $entry) {
                $activity_table_content .=
                '<tr>
					<td>' . $entry->id . '</td>
					<td><span class="label ' . BootstrapHelper::get_label_for_action($entry->action). '">' . BootstrapHelper::get_event_description($entry->action) . '</span></td>
                    <td>' . date('G:i:s', $entry->timestamp) . '</td>
					<td>' . date('D M j Y', $entry->timestamp) . '</td>
				 </tr>
				';
            }
        }

        return '
            <section id="user-activity" class="well">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>'.$STRINGS['action'].'</th>
                            <th>'.$STRINGS['time'].'</th>
                            <th>'.$STRINGS['date'].'</th>
                        </tr>
                    </thead>
                    <tbody>
                    '.$activity_table_content.'
                    </tbody>
                </table>
            </section>';
    }

}
