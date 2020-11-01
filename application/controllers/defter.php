<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class defter extends MY_Controller {
    public $perPage=20;

    public function create($id=""){
        $this->data["error"] = $this->session->flashdata("error");
        
        $id=xss_clean($id);
        $this->data["defter_id"]=$id;
        $this->load->model("simple_model");
        $this->load->model("defter_model");
        $this->load->model("yonetim_model");

        if($id==""){
            $this->data["frm"] = $this->defterfrm("");
            $this->data["frm"]["header"]="Yeni Karar Konusu Oluşturma formu";
        }else{
            $val=$this->simple_model->select_all_where("defter",Array("defter_id"=>$id));
            
            $this->data["imza"]=$val[0]["imza"];
            $this->data["baskan"]=$val[0]["baskan"];
            $this->data["azalar"]=$val[0]["azalar"];
            $this->data["uyeler"]=$this->defter_model->uye_defter(Array("uye_defter.defter_id"=>$id)); 
            $this->data["frm"] = $this->defterfrm($val[0]);
            $this->data["frm"]["header"]="Karar Konusu güncelleme formu";
        }
      
        $this->data["yonetim"]=$this->simple_model->select_all_where("yonetim",Array("sube_id"=>$this->data["userInfo"]["sube_id"]));
        
        $this->data["yonetim"]=$this->yonetim_model->yonetim_list(Array("yonetim.sube_id"=>$this->data["userInfo"]["sube_id"]));
        
        if($this->yetki_kontrol->sube_kontrol("defter",$id))
            $this->data["incPage"]=$this->load->view('defter_page',$this->data,TRUE);
        else
            $this->data["incPage"]=$this->load->view('yetki_page',$this->data,TRUE);
       
        $this->load->view('home_view',$this->data);
    }
    
    public function defterfrm($val){
        $frm["no"]= form_input("no",$val['no'],'id="no" class="form-control"');
        $frm["konu"]= form_input("konu",$val['konu'],'id="konu" class="form-control"');
        $frm["baskan"]= form_input("baskan",$val['baskan'],'id="baskan" class="form-control"');
        $frm["icerik"]= form_textarea("icerik",htmlspecialchars_decode($val['icerik']),'id="icerik" class="textarea form-control"  style="min-width: 860px; height: 200px"');
        $frm["tarih"]= form_input("tarih",date_formatchange('d-m-Y',$val['tarih']),'class="form-control" id="date_picker" data-date-format="DD-MM-YYYY"');
        $frm["defter_id"]= form_hidden("defter_id",$val['defter_id']);
        return $frm;
        
    }
    
    public function save(){
        
       $this->form_validation->set_rules('tarih', 'tarih', 'required|xss_clean');
       $this->form_validation->set_rules('no', 'no', 'required|xss_clean|regex_match[/^[0-9,]+$/]');
       $this->form_validation->set_rules('icerik', 'icerik', 'required');
       $this->form_validation->set_rules('konu', 'konu', 'required|xss_clean|max_length[255]');
       $this->form_validation->set_rules('baskan', 'baskan', 'required|xss_clean');
       $this->form_validation->set_rules("imza[]","imza[]","xss_clean");
       $this->form_validation->set_rules("azalar[]","azalar[]","xss_clean");
       $this->form_validation->set_rules("defter_id","defter_id","xss_clean");
       $this->form_validation->set_rules("sube_id","sube_id","xss_clean");
       $validation=$this->form_validation->run(); 
        
	    if ($validation == FALSE){
	        $this->session->set_flashdata('error',validation_errors());    
	        redirect(base_url('defter/create'));
	    }else{
	        $this->load->model("simple_model");
	        $sube_id=$this->data["userInfo"]["sube_id"];
	        $formValue=Array("tarih"=> date_formatchange('Y-m-d',set_value("tarih")) ,
	                         "no"=>set_value("no"),
	                         "icerik"=>set_value("icerik"),
	                         "konu"=>set_value("konu"),
	                         "baskan"=>set_value("baskan"),
	                         "sube_id"=> $sube_id,
	                         "user_id"=> $this->data["userInfo"]["id"],
	                         "imza"=>implode(';',xss_clean($_POST["imza"])),
	                         "azalar"=>implode(';',xss_clean($_POST["azalar"])),
	                         );
	        $defter_id = set_value("defter_id");
	        
	        if($defter_id==""){
    	         $insert_id=$this->simple_model->insert($formValue,"defter");
    	         $defter_id = $insert_id;
    	         $this->session->set_flashdata("error",$formValue["no"]."'lu Yeni Karar Başarıyla Alındı.");
	        }else{
	            $this->simple_model->delete_row("uye_defter",Array("defter_id"=>$defter_id));
	            $this->simple_model->update($formValue,Array("defter_id"=>$defter_id),"defter");
	            $this->session->set_flashdata("error",$formValue["no"]."'lu Karar Başarıyla Güncellendi.");
	        }
	        
	        if($_POST["uye_id"]!=""){
    	        for ($i = 0; $i < count($this->input->post('uye_id')); $i++) {
    	            $data_uye_defter[$i] = array(
    	                'defter_id' => $defter_id,
    	                'uye_id' => $this->input->post('uye_id')[$i],
    	            );
    	        }
	        }
	        if(sizeof($data_uye_defter)>0){
	            $this->simple_model->insert_multiple($data_uye_defter,"uye_defter");}
	        redirect("defter/liste");
	            
	    }
	   
    }
    
    public function liste($page=0){
        $page=xss_clean($page);
        $this->load->model("sube_model");
        $this->load->model("simple_model");
        $this->load->model("defter_model");
        $this->load->library('pagination');
        $this->data["error"]=$this->session->flashdata("error");
        
        $key=xss_clean($this->input->get("key"));
        $sube_id=xss_clean($this->input->get("sube_id"));
        $tarihs=xss_clean($this->input->get("tarihs"));
        $tarihe=xss_clean($this->input->get("tarihe"));
        $no=xss_clean($this->input->get("no"));
       
        $subeler = $this->sube_model->sube_list();
        foreach($subeler as $subeInd=>$subeVal){
            $subeList[$subeVal["sube_id"]]=$subeVal["sube_ad"];
        }
        
        if($tarihs !="" && $tarihe != ""){
            $sqlAdd="tarih>= '".date_formatchange("Y-m-d",$tarihs)."' and tarih<='".date_formatchange("Y-m-d",$tarihe)."')";
            $addWhere["tarih >="]=date_formatchange("Y-m-d",$tarihs);
            $addWhere["tarih <="]=date_formatchange("Y-m-d",$tarihe);    
        }
       
        if ($no!="" && $sqlAdd!=""){
            $addWhere["no"]= $no;
        }else if ($no!="" && $sqlAdd==""){
            $addWhere["no"]=$no;
        }
        
        if($key!=""){
            $like=Array("konu"=>$key);
            
        }
        
        if($this->data["userInfo"]["type"]==2){
            $arrW="(defter.sube_id=".$this->data["userInfo"]["sube_id"].")";

        }else if($sube_id!="NULL" and $sube_id!=""){
            $arrW="(defter.sube_id=".$sube_id.")";
        }else{
            $arrW="";
        }
        if($page<=1){
            $start=0;
        }else{
            $start=($page-1)*$this->perPage;
        }
       
        $this->data["page"]=$page;
        $this->data["countRow"]=$this->defter_model->count_all_defter($arrW,$like,$addWhere);
        $this->data["def"]=$this->defter_model->select_all_defter($this->perPage,$start,$arrW,$like,$addWhere);
        
        $url="defter/liste";
        if($this->data["userInfo"]["type"]==1){
            $this->load->model("sube_model");
            $subeler = $this->sube_model->sube_list();
            $subeList=Array("NULL"=>"Şube Seçin");
            foreach($subeler as $subeInd=>$subeVal){
                $subeList[$subeVal["sube_id"]]=$subeVal["sube_ad"];
            }
            
            if($val["sube_id"]==""){
                $sube_id=$this->data["userInfo"]["sube_id"];
            }else{
                $sube_id=$val["sube_id"];
            }
            $this->data["subeler"]=form_dropdown("sube_id",$subeList,"",'class="form-control"');
        }
        $this->data["pagination"] = $this->paginationFunc($url, $this->data["countRow"],$page);
     
        $this->data["incPage"]=$this->load->view('defter_list_page',$this->data,TRUE);
        $this->load->view('home_view',$this->data);
    }
    
    public function paginationFunc($url,$countRow,$pageNo=0){
        $config['base_url'] = base_url($url);
        $config['suffix']="?".$_SERVER["QUERY_STRING"];
        $config['total_rows'] = $countRow;
        $config['per_page'] = $this->perPage;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
    public function delete($id,$page){
        $id=xss_clean($id);
        $this->load->model("simple_model");
        
        $kontrol = $this->yetki_kontrol->sube_kontrol("defter",$id);
        
        if($kontrol){
            $this->simple_model->delete_row("uye_defter",Array("defter_id"=>$id));
            $this->simple_model->delete_row("defter",Array("defter_id"=>$id));
        }else{
            $this->session->set_flashdata("error","Silme hatası: Silme yetkiniz bulunmamaktadır.");
        }
        
        if($page>2)
            $page=-1;
       redirect(base_url("defter/liste/".$page));
    }
    public function print_view($id){
        $id=xss_clean($id);
        $this->data["defter_id"]=$id;
        $this->load->model("simple_model");
        $this->load->model("defter_model");
        $kontrol = $this->yetki_kontrol->print_kontrol("defter",$id);
        if(!$kontrol){
            echo "hata: yetki kısıtlaması;";
            return false;
        }
            $val=$this->simple_model->select_all_where("defter",Array("defter_id"=>$id));
            $this->data["uyeler"]=$this->defter_model->uye_defter(Array("uye_defter.defter_id"=>$id));
            $this->data["defter"]=$val[0];
           
        $this->data["yonetim"]=$this->simple_model->select_all_where("yonetim",Array("sube_id"=>$this->data["userInfo"]["sube_id"]));
        if($this->data["userInfo"]["type"]==2){
            if(($this->data["defter"]["sube_id"]==$this->data["userInfo"]["sube_id"]))
            $this->load->view('defter_print_view',$this->data);
        }else if($this->data["userInfo"]["type"]==1 or $this->data["userInfo"]["type"]==3){
            $this->load->view('defter_print_view',$this->data);
        }
    }
    public function print_word($id){
       
            $id=xss_clean($id);
            $this->data["defter_id"]=$id;
            $kontrol = $this->yetki_kontrol->print_kontrol("defter",$id);
            if(!$kontrol){
                echo "hata: yetki kısıtlaması;";
                return false;
            }
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=karar_no_".$id.".doc");
            
            $this->load->model("simple_model");
            $this->load->model("defter_model");
        
            $val=$this->simple_model->select_all_where("defter",Array("defter_id"=>$id));
            $this->data["uyeler"]=$this->defter_model->uye_defter(Array("uye_defter.defter_id"=>$id));
            $this->data["defter"]=$val[0];
             
            $this->data["yonetim"]=$this->simple_model->select_all_where("yonetim",Array("sube_id"=>$this->data["userInfo"]["sube_id"]));

            $prnt=$this->load->view('defter_word_view',$this->data,TRUE);
           
            echo $prnt;
    }
}