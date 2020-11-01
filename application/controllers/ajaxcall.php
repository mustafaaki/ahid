<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajaxcall extends MY_Controller {
    

    public function call_member(){
        $tc=xss_clean($this->input->post('id'));
        $this->load->model("member_model");
        $this->load->model("simple_model");
        $sql=$this->sqlcreate($tc);
        
        $info=$this->simple_model->query_run($sql);
        print_r(json_encode($info[0]));
    }
    
    function sqlcreate($tc){
      $sql= "select ".
            "uye.tc, uye.ad, uye.soyad,uye.cinsiyet as cinsiyet,uye.anne_ad,uye.baba_ad,dogum_il.ad as Dogum_ili,dogum_ilce.ad as Dogum_ilce," .
            "uye.dogum_tarihi as Dogum_tarihi,kutuk_il.ad as Kutuk_il,kutuk_ilce.ad as Kutuk_ilce,uye.kutuk_koy as Kutuk_koy,is_tel, " .
            "cep_tel,kurum ,meslek,email,kan_gurubu,is_il.ad as Is_il, is_ilce.ad as Is_ilce,is_semt.ad as Is_semt ,is_mahalle.ad as Is_mahalle," .
            "is_adres as Is_adres,ev_il.ad as Ev_il, ev_ilce.ad as ev_ilce,ev_semt.ad as Ev_semt ,ev_mahalle.ad as Ev_mahalle, ev_adres as Ev_adres,onerenler " .
            "from uye ".
            'left join il dogum_il on(dogum_il.id = uye.dogum_il) '.
            'left join ilce dogum_ilce on(dogum_ilce.id = uye.dogum_ilce) '.
            'left join il kutuk_il on(kutuk_il.id = uye.kutuk_il) '.
            'left join ilce kutuk_ilce on( kutuk_ilce.id=uye.kutuk_ilce) '.
            'left join il ev_il on( ev_il.id=uye.ev_il) '.
            'left join ilce ev_ilce on( ev_ilce.id=uye.ev_ilce) '.
            'left join semt ev_semt on( ev_semt.id=uye.ev_semt) '.
            'left join mahalle ev_mahalle on( ev_mahalle.id=uye.ev_mahalle) '.
            'left join il is_il on( is_il.id=uye.is_il) '.
            'left join ilce is_ilce on( is_ilce.id=uye.is_ilce) '.
            'left join semt is_semt on( is_semt.id=uye.is_semt) '.
            'left join mahalle is_mahalle on( is_mahalle.id=uye.is_mahalle) '.
            'left join subeler sube on( sube.sube_id=uye.sube_id) '.
            'where tc='. $tc;
        return $sql;
    }
    
    function  call_yonetim(){
        $id=xss_clean($this->input->post('id'));
        
        $this->load->model("simple_model");
        
        $info=$this->simple_model->select_row_array("yonetim",array("id"=>$id),"unvan,isim,email,cep_tel,is_tel,fax");
        print_r(json_encode($info));
    }
    
    
    
}