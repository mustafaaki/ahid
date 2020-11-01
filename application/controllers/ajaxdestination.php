<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajaxdestination extends MY_Controller {
    
    public function selectilce(){
        $il=xss_clean($this->input->post('id'));
        $this->load->model("destination_model");
        $listilce = $this->destination_model->ilceofil($il);
        print_r(json_encode($listilce));
    }
    
    public function selectsemt(){
        $ilce=xss_clean($this->input->post('id'));
        $this->load->model("destination_model");
        $listsemt = $this->destination_model->semtofilce($ilce);
        print_r(json_encode($listsemt));
    }
    
    public function selectmahalle(){
        $semt=xss_clean($this->input->post('id'));
        $this->load->model("destination_model");
        $listmahelle = $this->destination_model->mahalleofsemt($semt);
        print_r(json_encode($listmahelle));
    }
    
    public function selectsemtmahalle(){
        $ilce=xss_clean($this->input->post('id'));
        $this->load->model("destination_model");
        $listsemt = $this->destination_model->semtmahalleofilce($ilce);
        print_r(json_encode($listsemt));
    }
    
}

