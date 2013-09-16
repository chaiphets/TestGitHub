<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package CodeIgniter
 * @author ExpressionEngine Dev Team
 * @copyright Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license http://codeigniter.com/user_guide/license.html
 * @link http://codeigniter.com
 * @since Version 1.0
 * @filesource
 *
 */
	
// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package CodeIgniter
 * @subpackage Libraries
 * @category Libraries
 * @author ExpressionEngine Dev Team
 * @link http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {
	private static $instance;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		self::$instance = & $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach ( is_loaded () as $var => $class ) {
			$this->$var = & load_class ( $class );
		}
		
		$this->load = & load_class ( 'Loader', 'core' );
		
		$this->load->initialize ();
		
		log_message ( 'debug', "Controller Class Initialized" );
		
		//add by Chaiphet S. Check Authorization
		$authorize = $this->session->userdata('userSession');
		if($this->authorization->checkAuthorize(get_class($this))){
			if($authorize == null){
				$msg = 'Status 501: You have no authentication or your session is time out to access '.get_class($this);
				$msg .= '<br>Please <a href="'.site_url('authentication').'">log in</a>';
				show_error($msg, 501);
			} else {
				if(!isset($authorize['controller']) || $authorize['controller'] == null || !in_array(get_class($this), $authorize['controller'])){
					show_error('Status 502: You have no authorize to access '.get_class($this), 502);
				}
			}
		}
	}
	public static function &get_instance() {
		return self::$instance;
	}
	
	// add by Chaiphet S.
	public function addHeaderMsg($msg, $type) {
		if($this->session->userdata('hmsg'))
			$hmsg = $this->session->userdata('hmsg');
		$hmsg [] = array (
				'type' => $type,
				'message' => $msg 
		);
		$this->session->set_userdata('hmsg', $hmsg);
	}
	public function loadView($content, $data = null) {
		$header ['title'] = 'PHP Rabbiters Framework';
		if ($this->session->userdata ('hmsg'))
			$header ['hmsg'] = $this->session->userdata('hmsg');
		
		//generate menu
		$authorize = $this->session->userdata('userSession');
		$menu['menu'] = $authorize['menu'];
		
		$this->load->view('framework/header', $header);
		$this->load->view('framework/menu', $menu);
		$this->load->view($content, $data);
		$this->load->view('framework/footer');
		
		$this->session->unset_userdata ( 'hmsg' );
	}
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */