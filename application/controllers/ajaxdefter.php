<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajaxdefter extends MY_Controller {
    
    
    
    public function uye_olmayan(){
       $limit = xss_clean($_POST["limit"]);
       $this->load->model("member_model");
       $defterde_olmayan = $this->member_model->defterde_olmayan($limit,$this->data["userInfo"]["sube_id"]);
      
       print_r(json_encode($defterde_olmayan));
    }
    public function update_uye_olmayan(){
        $defter_id = xss_clean($_POST["defter_id"]);
        $this->load->model("defter_model");
        $list_update_uye = $this->defter_model->uye_defter(Array("uye_defter.defter_id"=>$defter_id));
        
        print_r(json_encode($list_update_uye));
    }
    
    
}