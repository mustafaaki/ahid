<?php 

   class destination_model extends CI_Model {

    

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        function iller(){
            $this->db->select('*');
            $this->db->from('il');
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }

        function ilceofil($il_id=""){
            $this->db->select('*');
            $this->db->from('ilce');
            $this->db->where(Array("il_id"=>$il_id));
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        
        function semtofilce($ilce_id=""){
            $this->db->select('*');
            $this->db->from('semt');
            $this->db->where(Array("ilce_id"=>$ilce_id));
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        
        function mahalleofsemt($semt_id=""){
            $this->db->select('*');
            $this->db->from('mahalle');
            $this->db->where(Array("semt_id"=>$semt_id));
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        
        function semtmahalleofilce($ilce_id=""){
            $this->db->select('mahalle.ad as mahalleAd,semt.ad as semtAd,semt.id as semtId,mahalle.id as mahalleId');
            $this->db->from('semt');
            $this->db->join("mahalle","mahalle.semt_id=semt.id","right");
            $this->db->where(Array("semt.ilce_id"=>$ilce_id));
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        
        /*
         * semt ve mahalle ayri  select ile gelecek ise  
        */
        
   }