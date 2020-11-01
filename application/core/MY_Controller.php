<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct access allowed.' );
class MY_Controller extends CI_Controller {

   public $data =array();

        public function __construct()
        {
                parent::__construct();
                
                $this->load->library('session');
                $this->data["login"] = $this->session->all_userdata();
                
                if(!$this->data["login"]['succeed'])
                    redirect('login');
                $this->data["userInfo"]= $this->data["login"]["loginInfo"];
                if($this->data["userInfo"]["type"]==2){
                    $this->data["selectWhere"]=Array("uye.sube_id"=>$this->data["userInfo"]["sube_id"]); 
                }
               
                $this->load->library("yetki_kontrol");
                $this->load->model("destination_model");
                $this->data["iller"]=$this->destination_model->iller();
                $this->data["leftmenu"]=$this->load->view('leftmenu_view',$this->data,TRUE);
                     
        }            
}