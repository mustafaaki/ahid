<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends MY_Controller {
    public $type=Array(""=>"Yetki Seçin","1"=> "(1)Tüm şube bilgilerine erişim","2"=> "(2)Bulunduğu şube verilerine erişim","3"=>"(3)Tüm verileri okuma izni");
    public $subelist=array(""=>"Şube Seçiniz!");
    
    public function create($id="")
    {   
        $this->load->model("sube_model");
        $this->load->model("user_model");
        
   
        $this->data["allusers"]=$this->user_list();
        if($this->data['userInfo']["type"]==1){
            $result_user=$this->user_model->select_user($id);
            $this->data["sube_list"]=$this->sube_model->sube_list();
            foreach($this->data["sube_list"] as $x=>$y){
                $this->subelist[$y["sube_id"]]=$y["sube_ad"];
            }
            $this->data["frm"]=$this->frm_new_user($result_user);
        }else if($this->data['userInfo']["type"]==3){
            $frm["header"] ="Kullanıcı Listesi";
        }
        
       
        
        if($this->data["userInfo"]["type"]==1){
        $this->data["incPage"]=$this->load->view('user_page',$this->data,TRUE);
        }else{
            $this->data["incPage"]=$this->load->view('yetki_page',$this->data,TRUE);
        }
        $this->load->view('home_view',$this->data);
        
    }
    
    public function frm_new_user($val){
                
        if($val["id"]!=""){
            $frm["header"] ="Kullanıcı bilgi Güncelleme Formu";
        }else{
            $frm["header"] ="Yeni Kullanıcı Fayıt Formu";
        }
        $frm["username"]= form_input("username",$val['username'],'id="username" class="form-control" placeholder="Şube Adı"');
        $frm["email"]= form_input("email",$val['email'],'id="email" class="form-control"');
        $frm["password"]= form_password("password","",'id="password" class="form-control"');
        $frm["confirm_password"]= form_password("confirm_password","",'id="confirm_password" class="form-control"');
        $frm["type"]= form_dropdown("type",$this->type,$val['type'],'id="type" class="form-control"');
        $frm["sube_id"]= form_dropdown("sube_id",$this->subelist,$val['sube_id'],'id="sube_id" class="form-control"');
        $frm["id"]= form_hidden("id",$val['id']);
        return $frm;
    }
    
    public function save(){
        if($this->data['userInfo']["type"]==1){
            $this->load->model('user_model');
            $this->load->model('simple_model');
             
            $this->form_validation->set_rules('username', 'username', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean');
            $this->form_validation->set_rules('sube_id', 'sube_id', 'required|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'required|xss_clean');
            $this->form_validation->set_rules('type', 'type', 'required|xss_clean');
            $this->form_validation->set_rules('id', 'id', 'xss_clean');
        }
        $validation = $this->form_validation->run();
       
        if ($validation == FALSE){
           
            $this->session->set_flashdata('error',validation_errors());
        }else{
            $formValue=Array(
                "username"=>set_value("username"),
                "email"=>set_value("email"),
                "sube_id"=>set_value("sube_id"),
                "password"=>pass_encryption(set_value("password")),
                "type"=>set_value("type"),
                
            );
            $id = set_value("id");
            
            if($id==""){
                
                $last_id= $this->simple_model->insert($formValue,"users");// form degerleri ve tablo adi
                
                if($last_id){
                    $this->session->set_flashdata('error','Kullanıcı bilgileri başarıyla kaydedildi.');
                     
                }else{
                    $this->session->set_flashdata("error",'Hata: Kullanıcı kaydedilemedi.');
                     
                }
                $id=$last_id;
            }else{
                $formValue=$this->is_empty_value($formValue);
                if($this->simple_model->update($formValue,Array("id"=>$id),"users")){
                    $this->session->set_flashdata('error','Kullanıcı bilgileri başarıyla güncellendi');
                }else{
                    $this->session->set_flashdata("error",'Hata veri güncellenemedi');
                }
            }
        }
        redirect(base_url("user/create"));
    }

    
    public function publish($id,$enum){
        if($this->data["userInfo"]["type"]==1){
            $id=xss_clean($id);
            $enum=xss_clean($enum);
            $this->load->model('user_model');
            $this->user_model->user_pub($id,$enum);
            redirect(base_url("user/create"));
        }
    }
    
   public function user_list(){
      $this->load->model('user_model');
      $userlist = $this->user_model->user_list();
      return $userlist;
   }
   
   public function emailcheck(){
        $email = xss_clean($_POST['email']);
        $user_id = xss_clean($_POST['id']);
        $this->load->model("user_model");
        if($user_id!=""){
            $isAvailable = true;
        }else{
            if($this->user_model->user_email_count($email)){
                $isAvailable = false;
            }else{
                $isAvailable = true; // or false
            }
        }
        // Finally, return a JSON
        echo json_encode(array(
            'valid' => $isAvailable,
        ));
    }
    
    public function is_empty_value($formValue){
        foreach ($formValue as $name=>$val){
            if($val!="")
                $newFromValue[$name]=$val;
        }
        return $newFromValue;
    }
}