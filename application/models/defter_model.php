<?php 

   class defter_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
          
        public function select_all_defter($limit,$start,$arrW="",$like="",$sqlAdd=""){
            $this->db->select("subeler.sube_id,defter.konu,users.username,defter.tarih,subeler.sube_ad,defter.defter_id,defter.no");
            $this->db->from("defter");
            $this->db->join("subeler","subeler.sube_id=defter.sube_id","left");
            $this->db->join("users","defter.user_id = users.id","left");
            if($arrW!="")
                $this->db->where($arrW);
            
            if($sqlAdd!="")
                $this->db->where($sqlAdd);
            
            if($like!="")
                $this->db->like($like,false);
            
            $this->db->order_by("no","desc");
            $this->db->order_by("tarih","desc");
            $this->db->limit($limit,$start);
            $query = $this->db->get();
            $result = $query->result_array();
            //echo $this->db->last_query();
            return $result;
        }
        public function count_all_defter($arrW="",$like,$date){
            $this->db->select("*");
            $this->db->from("defter");
            if($arrW!="")
                $this->db->where($arrW);
            
            if($date!="")
                $this->db->where($date);
            
            if($like!="")
                $this->db->or_like($like);
            
            $query = $this->db->get();
            
            return $query->num_rows();
           
        }
        
        public function uye_defter($arrW){
            $this->db->select("uye.ad,uye.soyad,uye.uye_id");
            $this->db->from("uye_defter");
            $this->db->join("uye","uye.uye_id=uye_defter.uye_id","left");
            $this->db->where($arrW);
            $query = $this->db->get();
            $result = $query->result_array();
            
            return $result;
        }
  
   }