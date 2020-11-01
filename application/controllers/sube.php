<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sube extends MY_Controller {
    
    public function index($id="")
    {
        $this->load->model("sube_model");
        if($id!=""){
            
            $result_member=$this->sube_model->select_sube($id);
        }
        
        $this->data["sube_list"]=$this->sube_model->sube_list();
        
        $this->data["frm"]=$this->formcreate($result_member);
        $this->data["incPage"]=$this->load->view('sube_page',$this->data,TRUE);
        $this->load->view('home_view',$this->data);
         
    }
    
    public function save(){
      
        $this->load->model('sube_model');
         
        $this->form_validation->set_rules('sube_ad', 'sube_ad', 'required|xss_clean');
        $this->form_validation->set_rules('sube_adres', 'sube_adres', 'required|xss_clean');
        $this->form_validation->set_rules('sube_no', 'sube_no', 'xss_clean');
        $this->form_validation->set_rules('sube_ref', 'sube_ref', 'xss_clean');
        $this->form_validation->set_rules('sube_id', 'sube_id', 'xss_clean');
        
        $validation = $this->form_validation->run();
	    if ($validation == FALSE){
	       
	        $this->session->set_flashdata('error','Hatalı bilgi girişi');
	    }else{
	        
	        $formValue=Array(
	            "sube_ad"=>set_value("sube_ad"),
	            "sube_adres"=>set_value("sube_adres"),
	            "sube_no"=>set_value("sube_no"),
	            "sube_ref"=>set_value("sube_ref")
	            );
	        $sube_id = set_value("sube_id");
	        if($sube_id==""){
	            $last_id=$this->sube_model->insert($formValue);
	            if($last_id){
	                $this->session->set_flashdata('error','Şube bilgileri başarıyla kaydedildi.');
	                
	            }else{
	                $this->session->set_flashdata("error",'Hata: Şube bilgileri veri kaydedilemedi.');
	                
	            }
	            $sube_id=$last_id;
	        }else{
	            if($this->sube_model->update($formValue,$sube_id)){
	                $this->session->set_flashdata('error','Şube bilgileri başarıyla güncellendi');
	            }else{
	                $this->session->set_flashdata("error",'Hata veri güncellenemedi');
	            }
	        }
	        
	    }
	    
	    redirect(base_url("sube"));
    }
    
    public function formcreate($val){
        $this->load->helper('form');
       
        if($val["sube_id"]!=""){
            $frm["header"] ="Şube Güncelleme Formu";
        }else{
            $frm["header"] ="Şube Kayıt Formu";
        }
        
        $frm["sube_ad"]= form_input("sube_ad",$val['sube_ad'],'id="sube_ad" class="form-control" placeholder="Şube Adı"');
        $frm["sube_adres"]= form_input("sube_adres",$val['sube_adres'],'id="sube_adres" class="form-control" placeholder="Şube Açık Adresi"');
        $frm["sube_no"]= form_input("sube_no",$val['sube_no'],'id="sube_no" class="form-control" placeholder="Şube no"');
        $frm["sube_ref"]= form_input("sube_ref",$val['sube_ref'],'id="sube_no" class="form-control" placeholder="No"');
        $frm["sube_id"]= form_hidden("sube_id",$val['sube_id']);
        
        $illist[""]="Şube İli Seçiniz";
        foreach ($this->data["iller"] as $arr=>$value){
            $illist[$value['id']] = $value['ad'];
        }
        
        $frm["sube_il"]= form_dropdown("sube_il",$illist,$val["sube_il"],'class="form-control" id="sube_il for_mahalle"');
        if($val["sube_ilce"]!=""){
           // $this->load->model("destination");
            $sube_ilceler = $this->destination_model->ilceofil($val["is_il"]);
            $sube_ilce_list[""]="Şube ilçe seçiniz";
            foreach ($sube_ilceler as $arr=>$value){
                $sube_ilce_list[$value['id']] =  $value['ad'];
            }
            $frm["sube_ilce"]= form_dropdown("sube_ilce",$sube_ilce_list,$val["sube_ilce"],'class="form-control" id="sube_ilce for_mahalle"');
        }
        if($val["sube_semt"]!=""){
            
            $sube_semtler = $this->destination_model->semtofilce($val["sube_ilce"]);
            $sube_semt_list[""]="Şube Semt seçiniz";
            foreach ($is_semtler as $arr=>$value){
                $sube_semt_list[$value['id']] =  $value['ad'];
            }
            $frm["sube_semt"]= form_dropdown("sube_semt",$sube_semt_list,$val["sube_semt"],'class="form-control" id="sube_semt for_mahalle"');
        }
        if($val["sube_mahalle"]!=""){
            $this->load->model("destination");
            $sube_mahalleler = $this->destination_model->mahalleofsemt($val["sube_semt"]);
            $sube_mahalle_list[""]="Şube Semt seçiniz";
            foreach ($is_mahalleler as $arr=>$value){
                $sube_mahalle_list[$value['id']] =  $value['ad'];
            }
            $frm["sube_mahalle"]= form_dropdown("sube_mahalle",$sube_mahalle_list,$val["sube_mahalle"],'class="form-control" id="sube_mahalle for_mahalle"');
        }
        
        return $frm;
        
    }
    
    function checkno(){
        $sube_no = $_POST['sube_no'];
        $sube_id = $_POST['sube_id'];
        $this->load->model("sube_model");
        if($sube_id!=""){
            $isAvailable = true;
        }else{
            if($this->sube_model->sube_no_count($sube_no)){
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
    
    function publish($id,$enum){
        $id=xss_clean($id);
        $enum=xss_clean($enum);
        $this->load->model('sube_model');
        $this->sube_model->sube_pub($id,$enum);
        redirect(base_url("sube/index"));
        
    }
    
}    