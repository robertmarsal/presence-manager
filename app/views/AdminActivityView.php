<?php

class AdminActivityView extends View {

    private $_entries;

    public function __construct($entries) {

        global $string;

        $this->_entries = $entries;
        $this->title($string['activity']);
    }

    public function menu() {

        global $config;

        return '
        <div class="topbar" id="topbar-container">
            <div class="topbar-inner">
                <div class="container">
                    <a class="brand" href="' . $config['wwwroot'] . '">Presence</a>
                    <ul class="nav">
                        <li class="active"><a href="' . $config['wwwroot'] . '/admin/activity">Activity</a></li>
                        <li><a href="' . $config['wwwroot'] . '/admin/users">Users</a></li>
                        <li><a href="' . $config['wwwroot'] . '/admin/settings">Settings</a></li>
                        <li><a href="' . $config['wwwroot'] . '/admin/help">Help</a></li>
                    </ul>
                    <ul class="nav secondary-nav">
                        <li><a href="' . $config['wwwroot'] . '/auth/logout">Log Out</a></li>
                    </ul>
                </div>
            </div>
		</div>';
    }

    public function content() {

        global $config;

        $activity_table_content = '';
        if (!empty($this->_entries)) {
            foreach ($this->_entries as $entry) {
                $activity_table_content .=
                '<tr id="'.$entry['timestamp'].'">
					<td>' . $entry['id'] . '</td>
					<td><span class="label ' . $entry['action'] . '">' . $this->get_event_description($entry['action']) . '</span></td>
					<td>' . date('D M j G:i:s Y', $entry['timestamp']) . '</td>
					<td>' . utf8_encode($entry['firstname']) . '</td>
                    <td>' . utf8_encode($entry['lastname']) . '</td>
					<td><a href="'.$config['wwwroot'].'/admin/user_details/'.$entry['id'].'">' . $entry['email'] . '</a></td>
				 </tr>
				';
            }
        }

        return '
		<script type="text/javascript">
			$(window).scroll(function(){
				if($(window).scrollTop() == $(document).height() - $(window).height()){
					$("div#ajax-loading").show();
					$.ajax({
						url: "'.$config['wwwroot'].'/admin/more_activity/" + $("#activity_table tr:last").attr("id"),
						success: function(html){
							if(html){
								$("#activity_table tr:last").after(html);
								$("div#ajax-loading").hide();
							}else{
								$("div#ajax-loading").html("No more records to show!");
							}
						}
					});
				}
			});
		</script>
		
			<table id="activity_table" class="zebra-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Action</th>
						<th>Time</th>
						<th>First Name</th>
                        <th>Last Name</th>
						<th>User</th>
					</tr>
				</thead>
				<tbody>' . $activity_table_content . '
				</tbody>
			</table>
			<div id="ajax-loading"><img src="'.$config['wwwroot'].'/public/img/ajax-loader.gif" /></div>
			';
    }


    private function get_event_description($event) {
        switch ($event) {
            case 'success': return 'Check-In';
            case 'important': return 'Check-Out';
            case 'warning': return 'Incidence';
        }
    }

}