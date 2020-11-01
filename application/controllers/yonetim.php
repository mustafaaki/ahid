<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class yonetim extends MY_Controller {
    

    
    public function create($id="")
    {   
        $this->load->model("simple_model");
        $this->load->model("yonetim_model");
        
        if($this->data["userInfo"]["type"]==1 or $this->data["userInfo"]["type"]==3){
            if($this->input->get("sube_id")){
            $sube_id = xss_clean($this->input->get("sube_id"));
        }   else{ 
            $sube_id=$this->data["userInfo"]["sube_id"];
        }
            $this->load->model("sube_model");
            $subeler = $this->sube_model->sube_list();
            
            foreach($subeler as $subeInd=>$subeVal){
                $subeList[$subeVal["sube_id"]]=$subeVal["sube_ad"];
            }
            $this->data["sube_list"]=form_dropdown("sube_id",$subeList,$sube_id,'class="form-control" id="yonetim_sube_change"');
           
        }else if($this->data["userInfo"]["type"]==2){
          
            $sube_id=$this->data["userInfo"]["sube_id"];
        }
        
        $this->data['frm']['error']=$this->session->flashdata("error");
        $this->data["sube_yonetim"]= $this->yonetim_model->yonetim_list( array("yonetim.sube_id"=>$sube_id ) );
        $headerSube= $this->simple_model->select_single_col("subeler","sube_ad",Array("sube_id"=>$sube_id));
        if($id==""){
            $this->data["frm"]=$this->frm_yonetim();
            $this->data["frm"]["header"] =$headerSube." Yönetim Üyesi Kayıt Formu";
        }else{  
            $result=$this->simple_model->select_row_array("yonetim",Array("id"=>$id));
            $this->data["frm"]=$this->frm_yonetim($result);
            $this->data["frm"]["header"] =$headerSube." Yönetim Üyesi Güncelleme Formu";
        }
        
        $this->data["incPage"]=$this->load->view('yonetim_page',$this->data,TRUE);
        $this->load->view('home_view',$this->data);
        
    }
    
    public function frm_yonetim($val){

        $frm["isim"]= form_input("isim",$val['isim'],'id="isim" class="form-control" placeholder="Ad Soyad"');
        $frm["unvan"]= form_input("unvan",$val['unvan'],'id="unvan" class="form-control"');
        $frm["sira"]= form_input("sira",$val['sira'],'id="sira" class="form-control"');
        $frm["email"]= form_input("email",$val['email'],'id="email" class="form-control"');
        $frm["cep_tel"]= form_input("cep_tel",$val['cep_tel'],'id="cep_tel" class="form-control"');
        $frm["is_tel"]= form_input("is_tel",$val['is_tel'],'id="is_tel" class="form-control"');
        $frm["fax"]= form_input("fax",$val['fax'],'id="fax" class="form-control"');
        $frm["sube_id"]= form_hidden("sube_id",$this->data["userInfo"]["sube_id"]);
        $frm["user_id"]= form_hidden("user_id",$this->data["userInfo"]["id"]);
        $frm["id"]= form_hidden("id",$val["id"]);

        return $frm;
    }
    
    public function save(){
        $this->form_validation->set_rules('isim', 'isim', 'required|xss_clean|max_length[45]');
        $this->form_validation->set_rules('unvan', 'unvan', 'xss_clean|max_length[70]');
        $this->form_validation->set_rules('email', 'email', 'xss_clean|max_length[70]');
        $this->form_validation->set_rules('is_tel', 'is_tel', 'xss_clean|max_length[70]');
        $this->form_validation->set_rules('cep_tel', 'cep_tel', 'xss_clean|max_length[70]');
        $this->form_validation->set_rules('fax', 'fax', 'xss_clean|max_length[70]');
        $this->form_validation->set_rules('sira', 'sira', 'required|xss_clean|regex_match[/^[0-9,]+$/]');
        $this->form_validation->set_rules('sube_id', 'sube_id', 'required|xss_clean|regex_match[/^[0-9,]+$/]');
        $this->form_validation->set_rules('user_id', 'user_id', 'required|xss_clean|regex_match[/^[0-9,]+$/]');
        $this->form_validation->set_rules('id', 'id', 'regex_match[/^[0-9,]+$/]');
       
       
        $validation=$this->form_validation->run();
        $id=set_value("id");
        if ($validation == FALSE){
            $this->session->set_flashdata('error',validation_errors());
            
        }else{
            $this->load->model("simple_model");
            $formValue=Array(
                "isim"=>set_value("isim"),
                "unvan"=>set_value("unvan"),
                "sira"=>set_value("sira"),
                "email"=>set_value("email"),
                "is_tel"=>set_value("is_tel"),
                "cep_tel"=>set_value("cep_tel"),
                "fax"=>set_value("fax"),
                "sube_id"=>set_value("sube_id"),
                "user_id"=>set_value("user_id")
                );
           
            if($id==""){
                $last_id=$this->simple_model->insert($formValue,"yonetim");
                
                if($last_id){
                    $id=$last_id;
                    $this->session->set_flashdata('error',"İçerik kaydedildi.");
                }else{
                    $this->session->set_flashdata('error',"İçerik kaydedilemedi!");
                }
                
            }else{
                if($this->simple_model->update($formValue,Array("id"=>$id),"yonetim")){
                    $this->session->set_flashdata('error',"İçerik kaydedildi.");
                }else{
                    $this->session->set_flashdata('error',"İçerik kaydedilemedi!");
                }
            }
            
            redirect(base_url('yonetim/create'));
        }
    }
    
    public function delete($id){
        if(is_numeric($id)){
            $this->load->model("simple_model");
            $this->simple_model->delete_row("yonetim",array("id"=>$id));
        }
        redirect(base_url('yonetim/create'));
    }
    
}