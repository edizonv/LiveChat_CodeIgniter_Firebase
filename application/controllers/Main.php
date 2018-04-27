<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct() {
		parent::__construct();
		// if (!$this->session->userdata('userSessId') ) {
  //           $this->session->set_flashdata('msg', 'Please login to continue!');
		// 	redirect(base_url().'users/login');
		// }
	}

	function index() {
		$this->home();
    }
    
    function home() {
        $this->template->set('title', 'Sample');
		$this->template->load('template', 'home');
    }
}