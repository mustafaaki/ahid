<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class logout extends MY_Controller {
    
    
	public function index($value="")
	{
	    unset($this->data);
	    $this->session->sess_destroy();
	    redirect(base_url("login"));
	    
	}
}