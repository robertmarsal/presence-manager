<?php

class NotificationsView extends View{

    private $_notifications;

    public function __construct($notifications) {
        global $STRINGS;
        $this->_notifications = $notifications;
        $this->title($STRINGS['notifications']);
    }

    public function menu() {
        return MenuHelper::admin_base_menu('notifications');
    }

    public function content() {

        global $CONFIG, $STRINGS;

        if(empty($this->_notifications)){
            return BootstrapHelper::alert('info', 'No notifications!', 'There are no new notifications');
        }

        $notifications_content = '';
        foreach($this->_notifications as $notification){
            $notifications_content .= '
                <tr>
                    <td>'.$notification->id.'</td>
                    <td>'.$notification->firstname.'</td>
                    <td>'.$notification->lastname.'</td>
                    <td><a href="'.$CONFIG->wwwroot.'/admin/users/'.$notification->userid.'/details">'.$notification->email.'</a></td>
                    <td>'.$notification->type.'</td>
                    <td>'.$notification->message.'</td>
                </tr>';
        }

        return
        '<section id="notifications">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>'.$STRINGS['firstname'] .'</th>
                        <th>'.$STRINGS['lastname'] .'</th>
                        <th>'.$STRINGS['email'] .'</th>
                        <th>'.$STRINGS['type'].'</th>
                        <th>'.$STRINGS['message'].'</th>
                    </tr>
                </thead>
                <tbody>
                '.$notifications_content.'
                </tbody>
            </table>
         </section>';
    }

}
