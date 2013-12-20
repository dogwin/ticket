<?php
/**
 * @author dogwin
 * @date 2013-12-16
 * @webSite http://dogwin.net
 */
class Dogwinjs extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('file','url','cookie'));
	}
	function auth(){
		$this->load->view('js/auth');
	}
}
/*End the file dogwinjs.php*/
/*Location .application/controllers/dogwinjs.php*/