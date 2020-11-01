<?php 
class member_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function insert($data){
            
            if($this->db->insert('uye', $data)){
               return $this->db->insert_id();
            }else{
               return false;
            }
   
        }
        
        public function update($data,$uye_id){
            if($this->db->update('uye', $data, array('uye_id' => $uye_id))){
                return true;
            }else{
                return false;
            }
        }
        
        public function select_list(){
        
        }
        
        public function tccount($tc){
            $this->db->select('*');
            $this->db->from('uye');
            $this->db->where(Array("tc"=>$tc));
            $query = $this->db->get();
            $num_rows= $query->num_rows();
            return $num_rows;
        }
        public function tccountanddepartment($tc,$department){
            $this->db->select('*');
            $this->db->from('uye');
            $this->db->where(array("tc"=>$tc,"sube_id"=>$department));
            $query = $this->db->get();
            $num_rows= $query->num_rows();
            return $num_rows;
        }
        
        public function select_member($tc){
            $this->db->select('*');
            $this->db->from('uye');
            $this->db->where(Array("tc"=>$tc));
            $query = $this->db->get();
            $result= $query->result_array();
            return $result[0];
        }
    
        
        public function defterde_olmayan($limit,$sube_id){
            $this->db->select('*');
            $this->db->from('uye');
            $this->db->where('uye_id NOT IN(SELECT uye_defter.uye_id FROM uye_defter) and uye.sube_id='.$sube_id);
            $this->db->limit($limit);
            
            $query = $this->db->get();
            
            $result = $query->result_array();
            
            return $result;
            
        }
        
   }