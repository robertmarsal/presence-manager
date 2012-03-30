<?php

class MenuHelper extends Helper {

    /**
     * Returns the html that builds the admin menu, and sets the active element,
     * based on the parameters. Contains a "log out" option.
     *
     * @global type stdClass $CONFIG  global configuration variable
     * @global type $STRINGS  global language variable
     * @param string $active  string that defines the active element of the menu
     * @return type  html
     */
    static public function admin_base_menu($active) {
        global $CONFIG, $STRINGS;
        $activity = $users = $report = $notifications = null; // so we don't get a debugger notice
        $$active = 'class="active"';

        return
            '<ul class="nav">
                <li ' . $activity . '><a href="' . $CONFIG->wwwroot . '/admin/activity">' . $STRINGS['activity'] . '</a></li>
                <li ' . $users . ' ><a href="' . $CONFIG->wwwroot . '/admin/users">' . $STRINGS['users'] . '</a></li>
                <li ' . $report . ' ><a href="' . $CONFIG->wwwroot . '/admin/report">' . $STRINGS['report'] . '</a></li>
                <li ' . $notifications. ' ><a href="' . $CONFIG->wwwroot . '/admin/notifications">' . $STRINGS['notifications'] . '</a></li>
            </ul>' . MenuHelper::get_logout_option();
    }

    /**
     * Returns the html that builds the user menu, and sets the active element,
     * based on the parameters. Contains a "log out" option.
     *
     * @global type $CONFIG  global configuration variable
     * @global type $STRINGS  global language variable
     * @param string $active  string that defines the active element of the menu
     * @return type  html
     */
    static public function user_base_menu($active) {
        global $CONFIG, $STRINGS;
        $activity = null;
        $$active = 'class="active"';

        return
            '<ul class="nav">
			     <li ' . $activity . '><a href="' . $CONFIG->wwwroot . '/user/activity">' . $STRINGS['activity'] . '</a></li>
            </ul>' . MenuHelper::get_logout_option();;
    }

    /**
     * Internal function of the class that returns the "log out" option of the
     * menu as it is common in the other menus.
     *
     * @global type $CONFIG  global configuration variable
     * @global type $STRINGS  global language variable
     * @return type html
     */
    static private function get_logout_option(){
        global $CONFIG, $STRINGS;

        return
            '<ul class="nav pull-right no-hover-a">
                <p class="navbar-text pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout">' . $STRINGS['logout'] . '</a></p>
             </ul>';
    }

}