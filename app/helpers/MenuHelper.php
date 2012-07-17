<?php

class MenuHelper extends Helper {

    /**
     * Returns the html that builds the admin menu, and sets the active element,
     * based on the parameters. Contains a "log out" option.
     *
     * @global Object $CONFIG  global configuration variable
     * @param String $active  string that defines the active element of the menu
     * @return Html
     */
    static public function admin_base_menu($active) {
        global $CONFIG;
        $activity = $users = $report = null; // so we don't get a debugger notice
        $$active = 'class="active"';

        return
            '<ul class="nav">
                <li ' . $activity . '><a href="' . $CONFIG->wwwroot . '/admin/activity">' . Lang::get('activity') . '</a></li>
                <li ' . $users . ' ><a href="' . $CONFIG->wwwroot . '/admin/users">' . Lang::get('users') . '</a></li>
                <li ' . $report . ' ><a href="' . $CONFIG->wwwroot . '/admin/report">' . Lang::get('report') . '</a></li>
            </ul>' . MenuHelper::get_logout_option();
    }

    /**
     * Returns html containing the submenu used in some of the views
     *
     * @global Object $CONFIG
     * @param String $active
     * @param Object $user
     * @return Html
     */
    static public function admin_submenu($active, $user){
        global $CONFIG;
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
                    <i class="icon-edit"></i>&nbsp;'.Lang::get('details').'</a></li>
                <li ' . $account . '>
                    <a href="'.$CONFIG->wwwroot.'/admin/users/'.$user->id.'/account">
                    <i class="icon-cog"></i>&nbsp;'.Lang::get('account').'</a></li>
                </ul>';
    }

    /**
     * Returns the html that builds the user menu, and sets the active element,
     * based on the parameters. Contains a "log out" option.
     *
     * @global type $CONFIG  global configuration variable
     * @param string $active  string that defines the active element of the menu
     * @return type  html
     */
    static public function user_base_menu($active) {
        global $CONFIG;
        $activity = $report = $profile = null;
        $$active = 'class="active"';

        return
            '<ul class="nav">
			    <li ' . $activity . '><a href="' . $CONFIG->wwwroot . '/user/activity">' . Lang::get('activity') . '</a></li>
				<li ' . $report . '><a href="' . $CONFIG->wwwroot . '/user/report">' . Lang::get('report') . '</a></li>
	            <li ' . $profile . '><a href="' . $CONFIG->wwwroot . '/user/profile">' . Lang::get('profile') . '</a></li>
        	</ul>' . MenuHelper::get_logout_option();;
    }

    /**
     * Returns the pagination links for a page
     *
     * @param Int $page
     * @return Html
     */
    static public function get_pagination_links($url, $page, $next = true){
        ($page == 0)
            ? $previous = ''
            : $previous = '<li><a href="'.$url.( $page==1 ? '': $page-1).'">'.Lang::get('previous').'</a></li>';

        ($next)
            ? $next = '<li><a href="'.$url.($page+1).'">'.Lang::get('next').'</a></li>'
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
     * @return type html
     */
    static private function get_logout_option(){
        global $CONFIG;

        return
            '<ul class="nav pull-right no-hover-a">
                <p class="logout pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout"><b>' . Lang::get('logout') . '</b></a></p>
             </ul>';
    }
}