<?php 

   class yonetim_model extends CI_Model {

    

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        
        public function yonetim_list($array){
            $this->db->select ('yonetim.id,yonetim.isim,yonetim.cep_tel,yonetim.is_tel,yonetim.fax,,yonetim.email,yonetim.unvan,yonetim.sira,subeler.sube_ad,subeler.sube_ad,subeler.sube_id,yonetim.sube_id');
            $this->db->from('yonetim');
            $this->db->join("subeler","subeler.sube_id = yonetim.sube_id","left");
            $this->db->where($array);
            $this->db->order_by("sira","asc");
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
            
            
        }
        
        
        
        
   }