<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class members extends MY_Controller {
    public $data=Array();
    public $config;
    public $frm;
    public $cinsiyet= Array(""=>"Cinsiyeti Seçiniz","E"=>"Erkek","K"=>"Kız");
    public $kan_gurubu= Array(""=>"Kan Gurubu Seç","AB Rh+"=>"AB Rh+","AB Rh-"=>"AB Rh-","A Rh+"=>"A Rh+", "A Rh-"=>"A Rh-","B Rh+"=>"B Rh+",
        "B Rh-"=>"B Rh-","0 Rh+"=>"0 Rh+","0 Rh-"=>"0 Rh-");
    public $destinationType=Array("dogum","kutuk","is","ev");
  
	
    public function index()	{}
	
	public function formcreate($val){
	    $this->load->model("sube_model");
	    if($val["uye_id"]!=""){
	       $readonly='readonly="readonly"';
	       $frm["header"] ="Üye Güncelleme Formu";
	       $frm["tcsub"] ="<small>Üye güncellemelerinde TC Numarası değiştirilemez!</small>";
	    }else{
	       $frm["header"] ="Yeni Üye Kayıt Formu";
	    }
	    
	    $frm["tc"]= form_input("tc",$val['tc'],'id="tc" class="form-control" placeholder="TC No" '.$readonly);
	    $frm["ad"]= form_input("ad",$val['ad'],'id="ad" class="form-control"');
	    $frm["soyad"]= form_input("soyad",$val['soyad'],'id="soyad" class="form-control"');
	    $frm["baba_ad"]= form_input("baba_ad",$val['baba_ad'],'id="baba_ad" class="form-control"');
	    $frm["anne_ad"]= form_input("anne_ad",$val['anne_ad'],' id="anne_ad" class="form-control"');
	    $frm["dogum_tarihi"]= form_input("dogum_tarihi",date_formatchange("d-m-Y",$val['dogum_tarihi']),'class="form-control" id="date_picker" placeholder="Doğum Tarihi"');
	    $frm["kurum"]= form_input("kurum",$val['kurum'],'class="form-control"');
	    $frm["meslek"]= form_input("meslek",$val['meslek'],'class="form-control"');
	    $frm["is_tel"]= form_input("is_tel",$val['is_tel'],'class="form-control"');
	    $frm["cep_tel"]= form_input("cep_tel",$val['cep_tel'],'class="form-control"');
	    $frm["email"]= form_input("email",$val['email'],'class="form-control"');
	    $frm["is_adres"]= form_input("is_adres",$val['is_adres'],'class="form-control"');
	    $frm["ev_adres"]= form_input("ev_adres",$val['ev_adres'],'class="form-control"');
	    $frm["onerenler"]= form_input("onerenler",$val['onerenler'],'class="form-control"');
	    $frm["kutuk_koy"]= form_input("kutuk_koy",$val['kutuk_koy'],'class="form-control" placeholder="Kütük Köy/Mahelle"');
	    $frm["fotograf"]= $val['fotograf'];
	    
	    $frm["uye_id"]= form_hidden("uye_id",$val['uye_id']);
	   
	    
	    if($this->data["userInfo"]["type"]==2){
	       $frm["sube_id"]= form_hidden("sube_id",$this->data["userInfo"]["sube_id"]);
	    }else if($this->data["userInfo"]["type"]==1){
	      
	       $subeler = $this->sube_model->sube_list();
	       foreach($subeler as $subeInd=>$subeVal){
	           $subeList[$subeVal["sube_id"]]=$subeVal["sube_ad"];
	       }
	       if($val['sube_id']==""){
	          $selectSube= $this->data["userInfo"]["sube_id"];
	       }else{
	           $selectSube=$val['sube_id'];
	       }
	       $frm["sube_id"]= form_dropdown("sube_id",$subeList,$selectSube,'class="form-control" id="form-sube-id" disabled="disabled"');
	    }
	    
	    $frm["cinsiyet"]= form_dropdown("cinsiyet",$this->cinsiyet,$val["cinsiyet"],'class="form-control" id="cinsiyet"');
	    $frm["kan_gurubu"]= form_dropdown("kan_gurubu",$this->kan_gurubu,$val["kan_gurubu"],'class="form-control"');
        
	   // $this->load->model("destination_model");
	    $dogum_illist[""]="Doğum ili seçiniz";
	    foreach ($this->data["iller"] as $arr=>$value){
	        $dogum_illist[$value['id']] = $value['ad'];  
	    }
	    $frm["dogum_il"]= form_dropdown("dogum_il",$dogum_illist,$val["dogum_il"],'class="form-control" id="dogum_il for_ilce"');
	    
	    if($val["dogum_ilce"]!=""){
	        
	        $dogum_ilceler = $this->destination_model->ilceofil($val["dogum_il"]);
	        $dogum_ilce_list[""]="Doğum ilce seçiniz";
	        foreach ($dogum_ilceler as $arr=>$value){
	            $dogum_ilce_list[$value['id']] =  $value['ad'];
	        }
	        $frm["dogum_ilce"]= form_dropdown("dogum_ilce",$dogum_ilce_list,$val["dogum_ilce"],'class="form-control" id="dogum_ilce for_ilce"');
	    }
	    
	    
	    $kutuk_illist[""]="Kutuk ili seçiniz";
	    foreach ($this->data["iller"] as $arr=>$value){
	        $kutuk_illist[$value['id']] = $value['ad'];
	    }
	    $frm["kutuk_il"]= form_dropdown("kutuk_il",$kutuk_illist,$val["kutuk_il"],'class="form-control" id="kutuk_il for_ilce"');
	    
        if($val["kutuk_ilce"]!=""){
           
           $kutuk_ilceler = $this->destination_model->ilceofil($val["kutuk_il"]);
           $kutuk_ilce_list[""]="Kütük ilce seçiniz";
           foreach ($kutuk_ilceler as $arr=>$value){          
               $kutuk_ilce_list[$value['id']] =  $value['ad'];    
           }   
	       $frm["kutuk_ilce"]= form_dropdown("kutuk_ilce",$kutuk_ilce_list,$val["kutuk_ilce"],'class="form-control" id="kutuk_ilce for_ilce"');
        }
        
        $is_illist[""]="İş ili seçiniz";
        foreach ($this->data["iller"] as $arr=>$value){
            $is_illist[$value['id']] = $value['ad'];
        }
        $frm["is_il"]= form_dropdown("is_il",$is_illist,$val["is_il"],'class="form-control" id="is_il for_semtmahalle"');
        
        if($val["is_ilce"]!=""){
            
            $is_ilceler = $this->destination_model->ilceofil($val["is_il"]);
            $is_ilce_list[""]="İş ilce seçiniz";
            foreach ($is_ilceler as $arr=>$value){
                $is_ilce_list[$value['id']] =  $value['ad'];
            }
            $frm["is_ilce"]= form_dropdown("is_ilce",$is_ilce_list,$val["is_ilce"],'class="form-control" id="is_ilce for_semtmahalle"');
        }
        if($val["is_semt"]!="" && $val["is_mahalle"]!=""){
           
            $is_semtler = $this->destination_model->semtmahalleofilce($val["is_ilce"]);
            $is_semt_list[""]="İş Semt Mahelle seçiniz";
            foreach ($is_semtler as $arr=>$value){
                $is_semt_list[$value['semtId']."-".$value['mahalleId']] =  $value['mahalleAd']." (".$value['semtAd'].")";
            }
            $selectedIsSemtMahalle= $val["is_semt"]."-".$val["is_mahalle"];
            $frm["is_semt"]= form_dropdown("is_semtmahalle",$is_semt_list,$selectedIsSemtMahalle,'class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="is_semtmahalle for_semtmahalle"');
        }
        

        $ev_illist[""]="Ev ili seçiniz";
        foreach ($this->data["iller"] as $arr=>$value){
            $ev_illist[$value['id']] = $value['ad'];
        }
        $frm["ev_il"]= form_dropdown("ev_il",$ev_illist,$val["ev_il"],'class="form-control" id="ev_il for_semtmahalle"');
        
        if($val["ev_ilce"]!=""){
            
            $ev_ilceler = $this->destination_model->ilceofil($val["ev_il"]);
            $ev_ilce_list[""]="Ev ilce seçiniz";
            foreach ($ev_ilceler as $arr=>$value){
                $ev_ilce_list[$value['id']] =  $value['ad'];
            }
            $frm["ev_ilce"]= form_dropdown("ev_ilce",$ev_ilce_list,$val["ev_ilce"],'class="form-control" id="ev_ilce for_semtmahalle"');
        }
        
        if($val["ev_semt"]!="" && $val["ev_mahalle"]!=""){
            $ev_semtler = $this->destination_model->semtmahalleofilce($val["ev_ilce"]);
            $ev_semt_list[""]="Ev Semt Mahelle Seçiniz";
            foreach ($ev_semtler as $arr=>$value){
                $ev_semt_list[$value['semtId']."-".$value['mahalleId']] =  $value['mahalleAd']." (".$value['semtAd'].")";
            }
            $selectedEvSemtMahalle= $val["ev_semt"]."-".$val["ev_mahalle"];

            $frm["ev_semt"]= form_dropdown("ev_semtmahalle",$ev_semt_list,$selectedEvSemtMahalle,'class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="ev_semtmahalle for_semtmahalle"');
        }
        
	    return $frm;
	}
	
	public function create($id=""){
	   $id= xss_clean($id); 
      if($id!=""){
            $this->load->model("member_model");
            $result_member=$this->member_model->select_member($id);
      }
      
	  $this->data["frm"]=$this->formcreate($result_member);
	  $this->data["error"] = $this->session->flashdata("error");
	  
	  if($this->yetki_kontrol->sube_kontrol_column("uye","tc",$id)){
	       $this->data["incPage"]=$this->load->view('members_page',$this->data,TRUE);
	  }else{
	      $this->data["incPage"]=$this->load->view('yetki_page',$this->data,TRUE);
	  }
	  
	  $this->load->view('home_view',$this->data);
	}

	
	public function save($uye_id=""){

	    $this->form_validation->set_rules('tc', 'tc', 'required|xss_clean');
	    $this->form_validation->set_rules('ad', 'ad', 'required|xss_clean');
	    $this->form_validation->set_rules('soyad', 'soyad', 'required|xss_clean');
	    $this->form_validation->set_rules('cinsiyet', 'cinsiyet', 'required|xss_clean');
	    $this->form_validation->set_rules('uye_id',"uye_id","xss_clean");
	    $this->form_validation->set_rules('baba_ad',"baba_ad","xss_clean");
	    $this->form_validation->set_rules('anne_ad',"anne_ad","xss_clean");
	    $this->form_validation->set_rules('dogum_il',"dogum_il","xss_clean");
	    $this->form_validation->set_rules('dogum_ilce',"dogum_ilce","xss_clean");
	    $this->form_validation->set_rules('kutuk_il',"kutuk_il","xss_clean");
	    $this->form_validation->set_rules('kutuk_ilce',"kutuk_ilce","xss_clean");
	    $this->form_validation->set_rules('kutuk_koy',"kutuk_koy","xss_clean");
	    $this->form_validation->set_rules('dogum_tarihi',"dogum_tarihi","xss_clean");
	    $this->form_validation->set_rules('is_tel',"is_tel","xss_clean");
	    $this->form_validation->set_rules('cep_tel',"cep_tel","xss_clean");
	    $this->form_validation->set_rules('email',"email","xss_clean");
	    $this->form_validation->set_rules('kurum',"kurum","xss_clean");
	    $this->form_validation->set_rules('meslek',"meslek","xss_clean");
	    $this->form_validation->set_rules('uye_id',"uye_id","xss_clean");
	    $this->form_validation->set_rules('onerenler',"onerenler","xss_clean");
	    $this->form_validation->set_rules('kan_gurubu',"kan_gurubu","xss_clean");
	    $this->form_validation->set_rules('is_il',"is_il","xss_clean");
	    $this->form_validation->set_rules('is_ilce',"is_ilce","xss_clean");
	    $this->form_validation->set_rules('is_semtmahalle',"is_semtmahalle","xss_clean");
	    $this->form_validation->set_rules('is_adres',"is_adres","xss_clean");
	    $this->form_validation->set_rules('ev_il',"ev_il","xss_clean");
	    $this->form_validation->set_rules('ev_ilce',"ev_ilce","xss_clean");
	    $this->form_validation->set_rules('ev_semtmahalle',"ev_semtmahalle","xss_clean");
	    $this->form_validation->set_rules('ev_adres',"ev_adres","xss_clean");
	    $this->form_validation->set_rules('sube_id',"sube_id","xss_clean");
	    
	    $validation=$this->form_validation->run();
	    if ($validation == FALSE){
	        $this->session->set_flashdata('error','Hatalı bilgi girişi');
	    }else{
	       
	       $this->load->helper("my_dbprefixnull");
	       
	       $ev_semtmahalle = explode("-",set_value('ev_semtmahalle'));
	       $is_semtmahalle = explode("-",set_value('is_semtmahalle'));
	      
	           
	       $tc=set_value('tc');
	       $formValue= Array(
	                           "tc"=>$tc ,
	                           "ad"=>set_value('ad'),
	                           "soyad"=>set_value('soyad'),
	                           "baba_ad"=>set_value('baba_ad'),    
	                           "anne_ad"=>set_value('anne_ad'),
	                           "cinsiyet"=>set_value('cinsiyet'),
	                           "dogum_il"=>set_value('dogum_il'),
	                           "dogum_ilce"=>set_value('dogum_ilce'),
	                           "kutuk_il"=>set_value('kutuk_il'),
	                           "kutuk_ilce"=>set_value('kutuk_ilce'),
	                           "kutuk_koy"=>set_value('kutuk_koy'),
	                           "dogum_tarihi"=>date_formatchange("Y-m-d",set_value('dogum_tarihi')),
	                           "is_tel"=>set_value('is_tel'),
	                           "cep_tel"=>set_value('cep_tel'),
	                           "email"=>set_value('email'),
	                           "kurum"=>set_value('kurum'),
	                           "meslek"=>set_value('meslek'),
	                           "is_il"=>db_null("is_il",set_value('is_il')),
	                           "is_ilce"=>db_null("is_ilce",set_value('is_ilce')),
	                           "is_semt"=>db_null("is_semt",$is_semtmahalle[0]),
	                           "is_mahalle"=>db_null("is_mahalle",$is_semtmahalle[1]),
	                           "is_adres"=>set_value('is_adres'),
	                           "ev_il"=>db_null("ev_ilce",set_value('ev_il')),
	                           "ev_ilce"=>db_null("ev_ilce",set_value('ev_ilce')),
	                           "ev_semt"=>db_null("ev_semt",$ev_semtmahalle[0]),
	                           "ev_mahalle"=>db_null("ev_mahalle",$ev_semtmahalle[1]),
	                           "ev_adres"=>set_value('ev_adres'),
	                           "kan_gurubu"=>set_value('kan_gurubu'),
	                           "onerenler"=>set_value('onerenler'),
	                           "sube_id"=>set_value('sube_id'),
	                           "user_id"=>$this->data["userInfo"]["id"],
	                           "uye_id"=>set_value('uye_id')
	                          );
	       
	       
	       if($formValue["sube_id"] == ""){
	           $formValue["sube_id"]=$this->data["userInfo"]["sube_id"];
	       }
	        $formValue=$this->is_empty_value($formValue) ;        
	        $this->load->model("member_model");
	       
	        if($formValue['uye_id']==""){ 
	            if(!empty($_FILES['fotograf']["tmp_name"]))
	                 $formValue['fotograf'] = $this->memberImage($tc);
	                 $last_id=$this->member_model->insert($formValue);
	             if($last_id){
	                 $this->session->set_flashdata('error','Üye bilgileri başarıyla kaydedildi.');
	             }else{
	                 $this->session->set_flashdata("error",'Hata : Üye bilgileri veri kaydedilemedi.');
	                 $tc="";
	             }
	             
	        }else{
	            if(!empty($_FILES["fotograf"]["tmp_name"]))
	                $formValue['fotograf'] = $this->memberImage($tc);
	          
	            if($this->member_model->update($formValue,$formValue["uye_id"])){
	                $this->session->set_flashdata('error','Üye bilgileri başarıyla güncellendi');
	            }else{
	                $this->session->set_flashdata("error",'Hata veri güncellenemedi');
	            }
	        }
	        
	        redirect(base_url("members/create/".$tc));
	    }
	}
	public function search(){    
	  $this->load->model("sube_model");
	  $this->data["frm"]=$this->searchformcreate($result_member);
	  $subeler = $this->sube_model->sube_list();
	  $subeList[""]="Tüm Şubelerde Ara";
	       foreach($subeler as $subeInd=>$subeVal){
	           $subeList[$subeVal["sube_id"]]=$subeVal["sube_ad"];
	       }
	  $this->data["frm"]["subeler"]=form_dropdown("sube_id",$subeList,'','class="form-control"');
	  $this->data['frm']['error']=$this->session->flashdata("error");
	  $this->data["incPage"]=$this->load->view('searchform_page',$this->data,TRUE);
	  $this->load->view('home_view',$this->data);  
	}
	
	public function is_empty_value($formValue){
	    foreach ($formValue as $name=>$val){
	        if($val!="")
	            $newFromValue[$name]=$val;
	    }
	    return $newFromValue;
	}
	
	
	public function searchformcreate($val){
	    
	    $this->load->model("sube_model");
	    if($val["uye_id"]!=""){
	        $readonly='readonly="readonly"';
	        $frm["header"] ="Üye Güncelleme Formu";
	        $frm["tcsub"] ="<small>Üye güncellemelerinde TC Numarası değiştirilemez!</small>";
	    }else{
	        $frm["header"] ="Yeni Üye Kayıt Formu";
	    }
	     
	    $frm["tc"]= form_input("tc",$val['tc'],'id="tc" class="form-control" placeholder="TC No" '.$readonly);
	    $frm["ad"]= form_input("ad",$val['ad'],'id="ad" class="form-control"');
	    $frm["soyad"]= form_input("soyad",$val['soyad'],'id="soyad" class="form-control"');
	    $frm["baba_ad"]= form_input("baba_ad",$val['baba_ad'],'id="baba_ad" class="form-control"');
	    $frm["anne_ad"]= form_input("anne_ad",$val['anne_ad'],' id="anne_ad" class="form-control"');
	    $frm["dogum_tarihi"]= form_input("dogum_tarihi",date_formatchange("d-m-Y",$val['dogum_tarihi']),'class="form-control" id="date_picker" placeholder="Doğum Tarihi"');
	    $frm["kurum"]= form_input("kurum",$val['kurum'],'class="form-control"');
	    $frm["meslek"]= form_input("meslek",$val['meslek'],'class="form-control"');
	    $frm["is_tel"]= form_input("is_tel",$val['is_tel'],'class="form-control"');
	    $frm["cep_tel"]= form_input("cep_tel",$val['cep_tel'],'class="form-control"');
	    $frm["email"]= form_input("email",$val['email'],'class="form-control"');
	    $frm["is_adres"]= form_input("is_adres",$val['is_adres'],'class="form-control"');
	    $frm["ev_adres"]= form_input("ev_adres",$val['ev_adres'],'class="form-control"');
	    $frm["onerenler"]= form_input("onerenler",$val['onerenler'],'class="form-control"');
	    $frm["kutuk_koy"]= form_input("kutuk_koy",$val['kutuk_koy'],'class="form-control" placeholder="Kütük Köy/Mahelle"');
	    $frm["fotograf"]= $val['fotograf'];
	     
	    $frm["uye_id"]= form_hidden("uye_id",$val['uye_id']);
	     
	     
	    if($this->data["userInfo"]["type"]==2){
	        $frm["sube_id"]= form_hidden("sube_id",$this->data["userInfo"]["sube_id"]);
	    }else if($this->data["userInfo"]["type"]==1){
	         
	        $subeler = $this->sube_model->sube_list();
	        foreach($subeler as $subeInd=>$subeVal){
	            $subeList[$subeVal["sube_id"]]=$subeVal["sube_ad"];
	        }
	        if($val['sube_id']==""){
	            $selectSube= $this->data["userInfo"]["sube_id"];
	        }else{
	            $selectSube=$val['sube_id'];
	        }
	        $frm["sube_id"]= form_dropdown("sube_id",$subeList,$selectSube,'class="form-control" id="form-sube-id" disabled="disabled"');
	    }
	     
	    $frm["cinsiyet"]= form_dropdown("cinsiyet",$this->cinsiyet,$val["cinsiyet"],'class="form-control" id="cinsiyet"');
	    $frm["kan_gurubu"]= form_dropdown("kan_gurubu",$this->kan_gurubu,$val["kan_gurubu"],'class="form-control"');
	
	    // $this->load->model("destination_model");
	    $dogum_illist[""]="Doğum ili seçiniz";
	    foreach ($this->data["iller"] as $arr=>$value){
	        $dogum_illist[$value['id']] = $value['ad'];
	    }
	    $frm["dogum_il"]= form_dropdown("dogum_il",$dogum_illist,$val["dogum_il"],'class="form-control" id="dogum_il for_ilce"');
	     
	    if($val["dogum_ilce"]!=""){
	         
	        $dogum_ilceler = $this->destination_model->ilceofil($val["dogum_il"]);
	        $dogum_ilce_list[""]="Doğum ilce seçiniz";
	        foreach ($dogum_ilceler as $arr=>$value){
	            $dogum_ilce_list[$value['id']] =  $value['ad'];
	        }
	        $frm["dogum_ilce"]= form_dropdown("dogum_ilce",$dogum_ilce_list,$val["dogum_ilce"],'class="form-control" id="dogum_ilce for_ilce"');
	    }
	     
	     
	    $kutuk_illist[""]="Kutuk ili seçiniz";
	    foreach ($this->data["iller"] as $arr=>$value){
	        $kutuk_illist[$value['id']] = $value['ad'];
	    }
	    $frm["kutuk_il"]= form_dropdown("kutuk_il",$kutuk_illist,$val["kutuk_il"],'class="form-control" id="kutuk_il for_ilce"');
	     
	    if($val["kutuk_ilce"]!=""){
	         
	        $kutuk_ilceler = $this->destination_model->ilceofil($val["kutuk_il"]);
	        $kutuk_ilce_list[""]="Kütük ilce seçiniz";
	        foreach ($kutuk_ilceler as $arr=>$value){
	            $kutuk_ilce_list[$value['id']] =  $value['ad'];
	        }
	        $frm["kutuk_ilce"]= form_dropdown("kutuk_ilce",$kutuk_ilce_list,$val["kutuk_ilce"],'class="form-control" id="kutuk_ilce for_ilce"');
	    }
	
	    $is_illist[""]="İş ili seçiniz";
	    foreach ($this->data["iller"] as $arr=>$value){
	        $is_illist[$value['id']] = $value['ad'];
	    }
	    $frm["is_il"]= form_dropdown("is_il",$is_illist,$val["is_il"],'class="form-control" id="is_il for_mahalle"');
	
	    if($val["is_ilce"]!=""){
	
	        $is_ilceler = $this->destination_model->ilceofil($val["is_il"]);
	        $is_ilce_list[""]="İş ilce seçiniz";
	        foreach ($is_ilceler as $arr=>$value){
	            $is_ilce_list[$value['id']] =  $value['ad'];
	        }
	        $frm["is_ilce"]= form_dropdown("is_ilce",$is_ilce_list,$val["is_ilce"],'class="form-control" id="is_ilce for_mahalle"');
	    }
	    if($val["is_semt"]!=""){
	         
	        $is_semtler = $this->destination_model->semtofilce($val["is_ilce"]);
	        $is_semt_list[""]="İş Semt Mahelle seçiniz";
	        foreach ($is_semtler as $arr=>$value){
	            $is_semt_list[$value['semtId']."-".$value['mahalleId']] =  $value['mahalleAd']." (".$value['semtAd'].")";
	        }
	        $selectedIsSemtMahalle= $val["is_semt"]."-".$val["is_mahalle"];
	        $frm["is_semt"]= form_dropdown("is_semt",$is_semt_list,$val["is_semt"],'class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="is_semt for_mahalle"');
	    }

	    if($val["is_mahalle"]!=""){
    	     $is_mahalleler = $this->destination_model->mahalleofsemt($val["is_semt"]);
    	     $is_mahalle_list[""]="İş Semt seçiniz";
    	     foreach ($is_mahalleler as $arr=>$value){
    	       $is_mahalle_list[$value['id']] =  $value['ad'];
    	     }
    	     $frm["is_mahalle"]= form_dropdown("is_mahalle",$is_mahalle_list,$val["is_mahalle"],'class="form-control" id="is_mahalle for_mahalle"');
	     }
	    
	    $ev_illist[""]="Ev ili seçiniz";
	    foreach ($this->data["iller"] as $arr=>$value){
	        $ev_illist[$value['id']] = $value['ad'];
	    }
	    $frm["ev_il"]= form_dropdown("ev_il",$ev_illist,$val["ev_il"],'class="form-control" id="ev_il for_mahalle"');
	
	    if($val["ev_ilce"]!=""){
	
	        $ev_ilceler = $this->destination_model->ilceofil($val["ev_il"]);
	        $ev_ilce_list[""]="Ev ilce seçiniz";
	        foreach ($ev_ilceler as $arr=>$value){
	            $ev_ilce_list[$value['id']] =  $value['ad'];
	        }
	        $frm["ev_ilce"]= form_dropdown("ev_ilce",$ev_ilce_list,$val["ev_ilce"],'class="form-control" id="ev_ilce for_mahalle"');
	    }
	
	    if($val["ev_semt"]!=""){
	        $ev_semtler = $this->destination_model->semtofilce($val["ev_ilce"]);
	        $ev_semt_list[""]="Ev Semt Mahelle Seçiniz";
	        foreach ($ev_semtler as $arr=>$value){
	            $ev_semt_list[$value['id']] =  $value['ad'];
	        }
	        
	
	        $frm["ev_semt"]= form_dropdown("ev_semtmahalle",$ev_semt_list,$val["ev_semt"],'class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="ev_semt for_mahalle"');
	    }
	    
	    if($val["ev_mahalle"]!=""){
    	     $ev_mahalleler = $this->destination_model->mahalleofsemt($val["ev_semt"]);
    	     $ev_mahalle_list[""]="Ev semt seçiniz";
    	     foreach ($ev_mahalleler as $arr=>$value){
    	        $ev_mahalle_list[$value['id']] =  $value['ad'];
    	     }
    	     $frm["ev_mahalle"]= form_dropdown("ev_mahalle",$ev_mahalle_list,$val["ev_mahalle"],'class="form-control" id="ev_mahalle for_mahalle"');
	    }
	   
	    return $frm;
	}
	
	public function memberImage($tc){	
    	     $config['upload_path']   = './images/'; 
             $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF'; 
             $config['max_size']      = 300000; 
             $config['file_name']      = $tc; 
             $config['overwrite']      = TRUE; 
             $this->load->library('upload', $config);
             $data = $this->upload->do_upload('fotograf');
             $upload_data = $this->upload->data();
            
             if ( !$data ) {
                return false;
             }else { 
                return $upload_data["file_name"];
             } 
        
	}
	
	public function tccheck($tc){
	    $tc = $this->input->post('tc');
	    $uye_id =$this->input->post('uye_id');
	    $sube_id =$this->input->post('sube_id');
	    
	    $this->load->model("member_model");
	    if($uye_id!=""){
	        $isAvailable = true;
	    }else{ 
	        if($this->member_model->tccountanddepartment($tc,$sube_id)){
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
	
	public function delete($uye_id,$lastpage="",$page=""){
	   $this->load->model('simple_model');
	   $kontrol = $this->yetki_kontrol->sube_kontrol("uye",$uye_id);
	   if($kontrol){
	       $this->simple_model->delete_where("uye",Array("uye_id"=>$uye_id));
    	   if($page>1){
    	       $page=$page-1;
    	   }else{
    	       $page="";
    	   }
	   }else{
            $this->session->set_flashdata("error","Silme hatası: Silme yetkiniz bulunmamaktadır.");
        }
	   redirect(base_url("searchlist/".$lastpage.'/'.$page));
	}
	
}