<?php

class MenuHelper extends Helper {

    /**
     * Returns the html that builds the admin menu, and sets the active element,
     * based on the parameters. Contains a "log out" option.
     *
     * @global Object $CONFIG  global configuration variable
     * @global Array $STRINGS  global language variable
     * @param String $active  string that defines the active element of the menu
     * @return Html
     */
    static public function admin_base_menu($active) {
        global $CONFIG, $STRINGS;
        $activity = $users = $report = null; // so we don't get a debugger notice
        $$active = 'class="active"';

        return
            '<ul class="nav">
                <li ' . $activity . '><a href="' . $CONFIG->wwwroot . '/admin/activity">' . $STRINGS['activity'] . '</a></li>
                <li ' . $users . ' ><a href="' . $CONFIG->wwwroot . '/admin/users">' . $STRINGS['users'] . '</a></li>
                <li ' . $report . ' ><a href="' . $CONFIG->wwwroot . '/admin/report">' . $STRINGS['report'] . '</a></li>
            </ul>' . MenuHelper::get_logout_option();
    }

    /**
     * Returns html containing the submenu used in some of the views
     *
     * @global Object $CONFIG
     * @global Array $STRINGS
     * @param String $active
     * @param Object $user
     * @return Html
     */
    static public function admin_submenu($active, $user){
        global $CONFIG, $STRINGS;
        $details = $account = null;
        $$active = 'class="active"';

        return '
            <ul class="nav nav-list well inline-menu">
                <li class="id-tab">
                    <i class="icon-user"></i>&nbsp;'.$user->firstname.' '.$user->lastname.'
                </li>
                <li>&nbsp;</li>
                <li ' . $details . '>
                    <a href="'.$CONFIG->wwwroot.'/admin/users/'.$user->id.'/details">
                    <i class="icon-edit"></i>&nbsp;'.$STRINGS['details'].'</a></li>
                <li ' . $account . '>
                    <a href="'.$CONFIG->wwwroot.'/admin/users/'.$user->id.'/account">
                    <i class="icon-cog"></i>&nbsp;'.$STRINGS['account'].'</a></li>
                </ul>';
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
        $activity = $report = null;
        $$active = 'class="active"';

        return
            '<ul class="nav">
			    <li ' . $activity . '><a href="' . $CONFIG->wwwroot . '/user/activity">' . $STRINGS['activity'] . '</a></li>
				<li ' . $report . '><a href="' . $CONFIG->wwwroot . '/user/report">' . $STRINGS['report'] . '</a></li>
            </ul>' . MenuHelper::get_logout_option();;
    }

    /**
     * Returns the pagination links for a page
     *
     * @global Array $STRINGS
     * @param Int $page
     * @return Html
     */
    static public function get_pagination_links($url, $page, $next = true){
        global $STRINGS;

        ($page == 0)
            ? $previous = ''
            : $previous = '<li><a href="'.$url.( $page==1 ? '': $page-1).'">'.$STRINGS['previous'].'</a></li>';

        ($next)
            ? $next = '<li><a href="'.$url.($page+1).'">'.$STRINGS['next'].'</a></li>'
            : $next = '';
        return
            '<ul class="pager pull-right">
                '.$previous.'
                '.$next.'
             </ul>';
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
                <p class="navbar-text pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout"><b>' . $STRINGS['logout'] . '</b></a></p>
             </ul>';
    }
}