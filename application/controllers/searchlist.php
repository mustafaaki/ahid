<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class searchlist extends MY_Controller {
    public $keysearch=array("tc","uye_no","kurum","meslek","kutuk_koy","onerenler","is_adres","ev_adres");
    public $shortHeader = array("uye_id"=>"No","tc"=>"TC","ad"=>"Ad","soyad"=>"Soyad","cinsiyet"=>'C',
        "dogum_tarihi"=>"D-Tarih","is_tel"=>"İs Tel","cep_tel"=>"Cep Tel","sube_ad"=>"Şube","sube_id"=>"Ş-No"  );
    public $perPage=20;
    public function table()
    {
      $this->load->model("simple_model"); 
     
      $count=0;
      $count2=0;
      $where=Array(); 
      $key=xss_clean($this->input->post("key"));
      
       foreach( $_POST as $x => $y){
           if($y!="" && $x!="key" && $x!="excel" && $x!="sube_id" && $x!="dogum_tarihi" && $x!="kan_gurubu" && $x!="ad" && $x!="soyad" && $x!="uye_no"){
            
                if(is_array($y)){
                    foreach($y as $k=>$l){
                        $column++;
                        $show[$k] =$l;
                        $title= explode(".",$l);
                        $titleArray[$count2]=$title[1];
                        $count2++;
                    }
                }else{
                   if( $x!="excel"){
                    $dizi[$x]=$y;
                    $where[$count]= $x."='".$y."'" ;
                    $count++;
                   }
                }        
           }
            
       }
       $alan =implode(",", $show);
       if($count2==0){
           $alan="uye.tc";
       }
       if($key!=""){
           $count=0;
           foreach($this->keysearch as $xxx=>$keyIndex){
               $searchKey[$count]=  $keyIndex." like '%".$key."%'";
               $count++;
               
           }
           $searchKey=implode(" or ",$searchKey);
       }
       
       
       if(sizeof($where)>0){
           $where = "( ". implode (" and ",$where).")";
       }else{
           $where="";
       }
       
       if($key!="" and $where!=""){
           $sqlAdd= "where (".$searchKey.") and (". $where.")";
       }else if($_POST["key"]=="" and $where!=""){
           $sqlAdd= "where ".$where;
       }else if($_POST["key"]!="" && $where==""){
           $sqlAdd= "where (".$searchKey.")";
       }
       $dtarih=$this->input->post("dogum_tarihi");
       if($sqlAdd!="" && $dtarih!=""){
           $sqlAdd.=' and (DATE_FORMAT(dogum_tarihi,"%m-%d") = DATE_FORMAT("'.date_formatchange("Y-m-d",$dtarih).'","%m-%d"))';
       }else if($sqlAdd=="" && $dtarih!=""){
           $sqlAdd='where (DATE_FORMAT(dogum_tarihi,"%m-%d") = DATE_FORMAT("'.date_formatchange("Y-m-d",$dtarih).'","%m-%d"))';
       }
       
       $kan_gurubu=$this->input->post("kan_gurubu");
       if($sqlAdd !="" && $kan_gurubu!=""){
           $sqlAdd.=' and (kan_gurubu="'.$kan_gurubu.'")';
       }else if($sqlAdd =="" && $kan_gurubu!=""){
           $sqlAdd.=' where (kan_gurubu="'.$kan_gurubu.'")';
       }
       
       $ad=$this->input->post("ad");
       if($sqlAdd !="" && $ad!=""){
           $sqlAdd.=' and (uye.ad="'.$ad.'")';
       }else if($sqlAdd =="" && $ad!=""){
           $sqlAdd.=' where (uye.ad="'.$ad.'")';
       }
       
       $uye_no= (int) $this->input->post("uye_no");
       if($sqlAdd !="" && $uye_no!=""){
           $sqlAdd.=' and (uye.uye_id="'.$uye_no.'")';
       }else if($sqlAdd =="" && $uye_no!=""){
           $sqlAdd.=' where (uye.uye_id="'.$uye_no.'")';
       }
       
       $soyad=$this->input->post("soyad");
       if($sqlAdd !="" && $soyad!=""){
           $sqlAdd.=' and (soyad="'.$soyad.'")';
       }else if($sqlAdd =="" && $soyad!=""){
           $sqlAdd.=' where (soyad="'.$soyad.'")';
       }
       
       $sube_id = $this->input->post("sube_id");
       if($sube_id!=""){
                if($sqlAdd!="" && $this->data["userInfo"]["type"]!=2 ){
                    $sqlAdd.= ' and (' . 'uye.sube_id='.$sube_id.')';
                }else if($sqlAdd=="" && $this->data["userInfo"]["type"]!=2 ){
                    $sqlAdd.= ' where (' . 'uye.sube_id='.$sube_id.')';
                }
       }
       
       if($sqlAdd!="" && $this->data["userInfo"]["type"]==2 ){
           $sqlAdd.= ' and (' . 'uye.sube_id='.$this->data['userInfo']['sube_id'].')';
       }else if($sqlAdd=="" && $this->data["userInfo"]["type"]==2){
           $sqlAdd.= ' where (' . 'uye.sube_id='.$this->data['userInfo']['sube_id'].')';
       }
       
     
       
       $sql=$this->sqlcreate($alan,$sqlAdd);
       $this->data["result"]=$this->simple_model->query_run($sql);
    // echo  $this->db->last_query();
      $this->data["shortHeader"] = $this->shortHeader;
       if($_POST["excel"]){
           $this->excel_list($this->data["result"]);
       }else{
           $this->load->view('searchlist_view',$this->data);
       }
    }
    
    function excel_list($data){
       
        $this->load->library('excel_xml');
        $count=0;
         foreach($data[0] as $y=>$x){
             if($shortHeader[$y]){
                 $val=$this->shortHeader[$y];
             }else{
                 $val=$y;
             }
             
             $header[$count]= $val;
            
             $count++;
         }
         foreach($data as $k=>$l){
             
             foreach ($l as $t=>$n){
                 if($t=="dogum_tarihi"){
                  $data[$k][$t] = date_formatchange("d-m-Y",$n);
                 }
             }
             
         }
        
         $arrHeader = array(1 =>$header);
       array_unshift($data,$arrHeader[1] );
      
       $xls = new excel_xml('UTF-8', true, 'liste');
       $xls->addArray($data);
      $xls->generateXML(date(time()));
    
    }
    
    function tumu($pageStart=0){
        $c=0;
        $sqlAdd="";
        $this->data["searchPage"]="tumu";
        $whereLike="";
        $key = xss_clean($_GET["key"]);
        if($pageStart<=1){
            $pageStart=1;  
        }
        $this->data["error"]=$this->session->flashdata("error");
        $this->data["pageStart"]=$pageStart;
        $this->data["lastPage"]="tumu";
        $this->load->model("simple_model");
        $this->load->library('pagination');
        //$alan="uye.uye_id,uye.tc,uye.ad,uye.soyad,uye.cinsiyet,uye.email,uye.cep_tel,uye.is_tel,sube.sube_ad,sube.sube_id";
        $alan="uye.uye_id,uye.tc,uye.ad,uye.soyad,uye.cinsiyet,uye.email,uye.cep_tel,uye.is_tel,sube.sube_ad,sube.sube_id";
        
        
        
        if($key!=""){
            $c;
            $keyArray=explode(" ",$key);
            
            foreach($keyArray as $keyVal){
                $whereLike[$c++]="uye.tc like '%".$keyVal."%'";
                $whereLike[$c++]="uye.ad like '%".$keyVal."%'";
                $whereLike[$c++]="uye.soyad like '%".$keyVal."%'";
            }  
            $sqlAdd=" where (".implode(" or ", $whereLike).')';
        }
       if($sqlAdd!=""){
           $sqlAdd.= ' and (' . 'uye.sube_id='.$this->data['userInfo']['sube_id'].')';
       }else{
           $sqlAdd.= ' where (' . 'uye.sube_id='.$this->data['userInfo']['sube_id'].')';
       }
       $sqlAdd.=" order by uye.uye_id desc ";
       $sqlCount=$this->sqlcreate($alan,$sqlAdd,$order);
       
       $sqlAdd.= " limit ".($pageStart-1)*$this->perPage.",".$this->perPage;
       $this->data["start"]=$pageStart;
        
       $sql=$this->sqlcreate($alan,$sqlAdd,$order);
           
       $this->data["all_row"]= $this->simple_model->count_query_run($sqlCount);
      
       $this->data["pagination"]=$this->paginationFunc('searchlist/tumu/',$this->data["all_row"],$pageNo); 
         
       $this->data["result"]=$this->simple_model->query_run($sql);
       $this->data["shortHeader"] =$this->shortHeader;
       $this->data["incPage"]=$this->load->view('searchlist_page',$this->data,TRUE);
       $this->load->view('home_view',$this->data);
    }
    
    
    function tumsubeuyeleri($pageStart=0){
        $c=0;
        $sqlAdd="";
        $this->data["searchPage"]="tumsubeuyeleri";
        $whereLike="";
        if($pageStart<=1){
            $pageStart=1;  
        }
        $key=xss_clean($_GET["key"]);
        $sube=xss_clean($_GET["sube"]);
        $this->data["pageStart"]=$pageStart;
        $this->data["lastPage"]="tumsubeuyeleri";
        $this->load->model("simple_model");
        $this->load->library('pagination');
        
        $alan="uye.uye_id,uye.tc,uye.ad,uye.soyad,uye.cinsiyet,uye.email,uye.cep_tel,uye.is_tel,sube.sube_ad,uye.sube_id";
        if($this->data["userInfo"]["type"]==1 or $this->data["userInfo"]["type"]==3){
            $subeler = $this->simple_model->select_all("subeler");
            foreach($subeler as $subeInd=>$subeVal){
                if($subeVal["sube_pub"]){
                    $subePub="(Açık)";
                }else{
                    $subePub="(Kapalı)";
                }
                $this->data["subeler"][$subeVal["sube_id"]] = substr($subeVal["sube_ad"],0,19).$subePub;
            }
            $this->data["subeler"]= form_dropdown("sube",$this->data["subeler"],$sube,'class="form-control" id="cinsiyet"');
            if($key!="" or $sube!="" ){
                $sqlAdd= " where ";
            }
            if($key!=""){
                $c;
                $keyArray=explode(" ",xss_clean($key));
        
                foreach($keyArray as $keyVal){
                    $whereLike[$c++]="uye.tc like '%".$keyVal."%'";
                    $whereLike[$c++]="uye.ad like '%".$keyVal."%'";
                    $whereLike[$c++]="uye.soyad like '%".$keyVal."%'";
                }
                $sqlAdd.="(".implode(" or ", $whereLike).')';
            }
            if($sube!=""){
                if($key!=""){
                    $sqlAdd.=" and ";
                }  
                $sqlAdd.="(sube.sube_id = ".$sube.")";
            }
            $sqlAdd.=" order by uye.uye_id desc ";
            
            $sqlCount=$this->sqlcreate($alan,$sqlAdd,$order);
             
            $sqlAdd.= " limit ".($pageStart-1)*$this->perPage.",".$this->perPage;
            $this->data["start"]=$pageStart;
        
            $sql=$this->sqlcreate($alan,$sqlAdd,$order);
             
            $this->data["all_row"]= $this->simple_model->count_query_run($sqlCount);
            $this->data["pagination"]=$this->paginationFunc('searchlist/tumsubeuyeleri/',$this->data["all_row"],$pageStart);
        } 
        $this->data["shortHeader"] = $this->shortHeader;
        $this->data["result"]=$this->simple_model->query_run($sql);
        $this->data["incPage"]=$this->load->view('searchlist_page',$this->data,TRUE);
        $this->load->view('home_view',$this->data);
    }
    
    
    function paginationFunc($url,$countRow,$pageNo=0){
        $config['base_url'] = base_url($url);
        $config['total_rows'] = $countRow;
        $config['per_page'] = $this->perPage;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = "<<";
        $config['last_link'] = ">>";
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
    
    function sqlcreate($alan,$sqlAdd="",$order=""){
        $sql= "select " .$alan. " from uye ".
            'left join il dogum_il on(dogum_il.id = uye.dogum_il)'.
            'left join ilce dogum_ilce on(dogum_ilce.id = uye.dogum_ilce)'.
            'left join il kutuk_il on(kutuk_il.id = uye.kutuk_il)'.
            'left join ilce kutuk_ilce on( kutuk_ilce.id=uye.kutuk_ilce)'.
            'left join il ev_il on( ev_il.id=uye.ev_il)'.
            'left join ilce ev_ilce on( ev_ilce.id=uye.ev_ilce)'.
            'left join semt ev_semt on( ev_semt.id=uye.ev_semt)'.
            'left join mahalle ev_mahalle on( ev_mahalle.id=uye.ev_mahalle)'.
            'left join il is_il on( is_il.id=uye.is_il)'.
            'left join ilce is_ilce on( is_ilce.id=uye.is_ilce)'.
            'left join semt is_semt on( is_semt.id=uye.is_semt)'.
            'left join mahalle is_mahalle on( is_mahalle.id=uye.is_mahalle) '.
            'left join subeler sube on( sube.sube_id=uye.sube_id) '.
            $sqlAdd.$order;
        return $sql;
    }
    
    public function print_page($tc){
	     
	    $tc=xss_clean($tc);
	    $this->load->model("simple_model"); 
	    $alan= "uye.tc as uye_tc,
	            uye.ad as uye_ad,
	            uye.soyad as uye_soyad,
	            uye.baba_ad as uye_baba_ad,
	            uye.anne_ad as uye_anne_ad,
	            uye.dogum_tarihi as dogum_tarihi,
	            uye.kan_gurubu as kan_gurubu,
	            dogum_il.ad as dogum_il,
	            dogum_ilce.ad as dogum_ilce,
	            kutuk_il.ad as kutuk_il,
	            kutuk_ilce.ad as kutuk_ilce,
	            uye.kutuk_koy as kutuk_koy,
	            uye.cinsiyet as cinsiyet,
	            uye.kurum as kurum,
	            uye.meslek as meslek,
	            uye.is_tel as uye_is_tel,
	            uye.cep_tel as uye_cep_tel,
	            uye.email as email,
	            is_il.ad as is_il,
	            is_ilce.ad as is_ilce,
	            is_semt.ad as is_semt,
	            is_mahalle.ad as is_mahalle,
	            uye.is_adres as is_adres,
	            ev_il.ad as ev_il,
	            ev_ilce.ad as ev_ilce,
	            ev_semt.ad as ev_semt,
	            ev_mahalle.ad as ev_mahalle,
	            uye.ev_adres as ev_adres,
	            uye.onerenler as onerenler,
	            uye.fotograf as fotograf,
	            sube.sube_no as sube_no,
	            uye.uye_id as uye_id,
	            sube.sube_ref as sube_ref,
	            sube.sube_ad as sube_ad,
	            sube.sube_adres as sube_adres
	        ";
	    $sql = $this->sqlcreate($alan," where uye.tc=".$tc."");
	    $result = $this->simple_model->query_run($sql);
        
	    $this->data["uye"]=$result[0];
        $uye_defter_result= $this->simple_model->select_row_array("uye_defter",Array("uye_id"=>$result[0]["uye_id"]));
        
        $this->data["defter_result"]= $this->simple_model->select_row_array("defter",Array("defter_id"=>$uye_defter_result["defter_id"]));
        
       
	    $this->load->view('uye_print_view',$this->data);
	}
    
}