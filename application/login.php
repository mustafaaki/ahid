<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
    private $pass;
    private $email;
    
    
 /* Uye giris sayfasi */
	public function index($value="")
	{
	   
	    
	    $this->data["login"] = $this->session->userdata();
	    if(!$this->data["login"]['succeed'])
	        redirect('home');
	    
	    $this->data["email"]=$this->session->flashdata('textemail');
	    
	    if($value=="error"){
	        $this->data["error"]="Hatalı kullanıcı adı veya email.<br>Lütfen kontrol edip tekrar deneyin.";
	    }else  if($value=="error2"){
	        $this->data["error"]="Bağlantı zaman aşımı lütfen tekrar giriş yapınız.";
	    }
	      
		$this->load->view('login_view',$this->data);
	}
	
	public function check(){
	    
	  
	    
	    redirect("home");
	    $this->form_validation->set_rules("email", 'email', 'trim|required|valid_email');
	    $this->form_validation->set_rules("pass", 'Password', 'required|min_length[6]|max_length[8]');
	    $validation=$this->form_validation->run();
	    $email = xss_clean(set_value('email'));
	    $pass = xss_clean(set_value('pass'));
	    $this->session->set_flashdata("textemail",$email);
	    if ($validation != FALSE)
	    {
	        $this->load->model('user_model');
	        $value =$this->user_model->check_user($email,pass_encryption($pass));
	    }
	    else
	    {   
	        $value=false;
	    }
	   
	   
	    if($value==FALSE)
	    {   
	        redirect('login/index/error');
	    }
	    else
	    {
	        $login["loginInfo"]=$value[0];
	        $login["succeed"]=TRUE;
	        $this->session->set_userdata($login);
	     	redirect("home");
	    }
	    
	   
	}
}