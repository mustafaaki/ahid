<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class help extends MY_Controller {
    public $perPage=10;

    public function index($id=""){
        
        $this->data["incPage"]=$this->load->view('help_view',$this->data,TRUE);
        $this->load->view('home_view',$this->data);
        
        
    }
    
}