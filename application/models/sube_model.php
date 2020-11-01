<?php 

   class sube_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function insert($data){
        
            if($this->db->insert('subeler', $data)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        
        }
        
        public function update($data,$sube_id){
            $this->db->update('subeler', $data, array('sube_id' => $sube_id));
        }
        
        public function sube_pub($sube_id,$val){
            $this->db->update('subeler', Array("sube_pub"=>$val), array('sube_id' => $sube_id));
        }
        
        public function sube_list(){
            
            $this->db->select('*');
            $this->db->from('subeler');
            $this->db->order_by("subeler.sube_no", "asc");
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        
        public function sube_no_count($no){
            $this->db->select('*');
            $this->db->from('subeler');
            $this->db->where(Array("sube_no"=>$no));
            $query = $this->db->get();
            $num_rows= $query->num_rows();
            return $num_rows;
        }
        public function select_sube($sube_id){
            $this->db->select('*');
            $this->db->from('subeler');
            $this->db->where(Array("sube_id"=>$sube_id));
            $query = $this->db->get();
            $result= $query->result_array();
            return $result[0];
        }
}