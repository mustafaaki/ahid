<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class password extends MY_Controller {
    
    
    
    public function change(){

        $this->data["frm"]=$this->create_form();
        $this->data["frm"]["header"]="Şifremi değiş";
        $this->data["incPage"]=$this->load->view('password_page',$this->data,TRUE);
        $this->load->view('home_view',$this->data);
    }
    
    
    public function create_form(){
        $frm["password"]= form_input("password",'','id="password" class="form-control" placeholder="password"');
        $frm["new_password"]= form_password("new_password","",'id="new_password" class="form-control"');
        $frm["confirm_password"]= form_password("confirm_password","",'id="confirm_password" class="form-control"');
        return $frm;
    }
    
    
    public function save(){
        $this->form_validation->set_rules('password', 'password', 'required|min_length[3]|xss_clean|max_length[12]');
        $this->form_validation->set_rules('new_password', 'new_password', 'required|xss_clean|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|xss_clean|min_length[6]|max_length[12]');
        
        $validation=$this->form_validation->run();
       
        if ($validation == FALSE){
	        $this->session->set_flashdata('error',validation_errors());
	       
	    }else{
	       // $this->load->helper('MY_pass_helper');
	        $new_pass = set_value('new_password');
	        $confirm_password = set_value('confirm_password');
	        if($new_pass!=$confirm_password){
	            echo "hata";
	        }else{
	            $old_padd=pass_encryption(set_value('password'));
	            
	            $new_pass=pass_encryption($new_pass);
	            $user_id=$this->data["userInfo"]["id"];
	            $this->load->model('simple_model');
	            $this->load->model('user_model');
	            $count_user= $this->user_model->pass_check($user_id,$old_padd);
	            
	            if($count_user){
    	            if($this->simple_model->update(Array("password"=>$new_pass),array("id"=>$user_id),"users")){
    	                $this->session->sess_destroy();
    	                redirect(base_url('login'));
    	            }else{
    	               $this->session->set_flashdata('error','Hata:şifre değiştirilemedi.Lütfen sistem yöneticisiyle irtibata geçiniz. ');
    	            }
	            }else{
	                $this->session->set_flashdata('error','Hata:şifre değiştirilemedi.Lütfen sistem yöneticisiyle irtibata geçiniz. ');
	            }
	            
	        }
	        
	    }
    }
    
    
    
    
}