<?php

class AdminActivityView extends View {

    private $_entries;
    private $_page;

    public function __construct($entries, $page = 0, $alert = null) {
        global $STRINGS;

        $this->_entries = $entries;
        $this->_alert = $alert;
        $this->_page = $page;

        $this->title($STRINGS['activity']);
    }

    public function menu() {
        return MenuHelper::admin_base_menu('activity');
    }

    public function content() {

        global $CONFIG, $STRINGS;

        if(empty($this->_entries)){
            return BootstrapHelper::alert('info',
                    $STRINGS['event:noactivity'],
                    $STRINGS['event:noactivity:message']);
        }

        //check if there is a next page (page count starts at 0 thus the +1)
        $this->_page + 1 < ActivityModel::pages() == 10 
                ? $next = true 
                : $next = false;

        $activity_table_content = '';
        foreach ($this->_entries as $entry) {
            $activity_table_content .=
            '<tr>
                <td>' . $entry->id . '</td>
                <td><span class="label ' . BootstrapHelper::get_label_for_action($entry->action). '">' . BootstrapHelper::get_event_description($entry->action) . '</span></td>
                <td>' . date('G:i:s', $entry->timestamp) . '</td>
                <td>' . date('D M j Y', $entry->timestamp) . '</td>
                <td>' . utf8_encode($entry->firstname) . '</td>
                <td>' . utf8_encode($entry->lastname) . '</td>
                <td><a href="'.$CONFIG->wwwroot.'/admin/users/'.$entry->userid.'/details">' . $entry->email . '</a></td>
                </tr>
            ';
        }

        return '
        <section id="activity">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>'.$STRINGS['action'].'</th>
                        <th>'.$STRINGS['time'].'</th>
						<th>'.$STRINGS['date'].'</th>
                        <th>'.$STRINGS['firstname'].'</th>
                        <th>'.$STRINGS['lastname'].'</th>
                        <th>'.$STRINGS['email'].'</th>
                    </tr>
                </thead>
                <tbody>' . $activity_table_content . '
                </tbody>
            </table>
            '.MenuHelper::get_pagination_links($CONFIG->wwwroot.'/admin/activity/',$this->_page, $next).'
        </section>';
    }
}
