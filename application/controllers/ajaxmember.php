<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajaxmember extends MY_Controller {
    

    public function call_member(){
        $id=xss_clean($this->input->post('id'));
        $this->load->model("member_model");
        $info = $this->member_model->select_member($id);
        print_r(json_encode($info));
    }
    
    
    
}