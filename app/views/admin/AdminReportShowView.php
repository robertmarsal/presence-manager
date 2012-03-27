<?php

class AdminReportShowView extends View{

    private $_user;
	private $_range;

    public function __construct($user, $range,$alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_user = $user;
		$this->_range = $range;

        $this->title($STRINGS['user']);
    }

	public function menu(){
        return MenuHelper::admin_base_menu('report');
	}

	public function content(){

		return '
            <section id="report-show" class="well">
				<div id="report-actions" class="pull-right">
					<a class="btn" href="#"><i class="icon-print"></i>&nbsp;Print</a>
					<a class="btn" href="#"><i class="icon-download"></i>&nbsp;Download</a>
					<a class="btn" href="#"><i class="icon-envelope"></i>&nbsp;Mail</a>
				</div>
			    <address>
        <strong>Twitter, Inc.</strong><br>

        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        <abbr title="Phone">P:</abbr> (123) 456-7890
      </address>
			<div class="page-header">
				<h1>Report</h1>
			</div>
			<table>
				<tr>
				<td style="min-width:80px;"></td>
				</tr>
				<tr>
					<td><strong>To: </strong></td>
					<td>'.$this->_user->firstname.' '.$this->_user->lastname.'</td>
				</tr>
				<tr>
					<td><strong>Issued:</strong></td>
					<td>'.date("F j, Y, g:i a").'</td>
				</tr>
				<tr>
					<td><strong>Period: </strong></td>
					<td>'.$this->_range->timestart.' to '.$this->_range->timeend.'</td>
				</tr>
			</table>

			<h3 class="pull-right">Time: '.$this->_range->total.'</h3></br>

            </section>';

	}

}
