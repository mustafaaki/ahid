<?php
class yetki_kontrol
{
        public  $yetkili_sube;
        public  $yetkili;
        public  $table;
        public  $errorMsg;
        public  $CI;
        public  $beforePage;
        
         public function __construct(){
             $this->CI =& get_instance();
             $this->yetkili_sube = $this->CI->data["userInfo"]["sube_id"];
             $this->yetkili = $this->CI->data["userInfo"]["type"];
             $this->CI->load->model("simple_model");
             $this->CI->load->library("session");
             $this->CI->load->helper("url");
             $this->beforePage=$_SERVER['HTTP_REFERER'];    
        }

        public function sube_kontrol($table,$id="",$url="",$errorMessage="Bu alanı değiştirme yetkiniz bulunmamaktadır."){
            if($this->yetkili==3){
                return false;
            }else if($this->yetkili==2){
                if($id!=""){
                    $count= $this->CI->simple_model->select_count_run($table,Array($table."_id"=>$id,"sube_id"=>$this->yetkili_sube));
                
                    if($count ==0 ){ return false; }else if($count==1){  return true; }
                }else{ return true; }
            }
            return true;
        }
        public function sube_kontrol_column($table,$column_alias="",$id=""){
            if($this->yetkili==3){
                return false;
            }else if($this->yetkili==2){
                if($id!=""){
                    $count= $this->CI->simple_model->select_count_run($table,Array($column_alias=>$id,"sube_id"=>$this->yetkili_sube));
        
                    if($count ==0 ){ return false; }else if($count==1){  return true; }
                }else{ return true; }
            }
            return true;
        }
        
        public function print_kontrol($table,$id){
            if($this->yetkili==2){
                $count= $this->CI->simple_model->select_count_run($table,Array($table."_id"=>$id,"sube_id"=>$this->yetkili_sube));  
                if($count ==0 ){
                    return false;
                }else if($count==1){               
                    return true;
                }
            }
            return true;
        }    
}