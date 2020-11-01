<?php 

   class simple_model extends CI_Model {

    

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function insert($data,$table){ 
            if($this->db->insert($table, $data)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
        
        public function insert_multiple($data,$table){
            $this->db->insert_batch($table, $data);
        }
        public function update($data,$arrWhere,$table){
            if($this->db->update($table, $data,$arrWhere)){
                return true;
            }else{
                return false;
            }
        }
        
        public function update_with_delete($id){
            
        }
        
        public function query_run($sql){
            $query = $this->db->query($sql);
            $result=$query->result_array();  
            return $result;
        }
        public function count_query_run($sql){
            $query = $this->db->query($sql);
            
            return $query->num_rows();
    
        }
        public function select_count_run($table,$where=""){
            
            $this->db->from($table);
            if($where!="")
                $this->db->where($where);
            return $this->db->count_all_results();
            
                       
        }
        
        public function select_all($table){
            $this->db->select("*");
            $this->db->from($table);
           
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        
        public function select_all_where($table,$arrWhere){
           $this->db->select("*");
           $this->db->from($table);
           $this->db->where($arrWhere); 
           $query = $this->db->get();
           $result = $query->result_array();
           return $result;
        }
        public function select_all_where_order($table,$arrWhere,$order){
            $this->db->select("*");
            $this->db->from($table);
            $this->db->where($arrWhere);
            $this->db->order_by($order[0],$order[1]);
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        public function select_row_array($table,$arrWhere,$select=""){
            if($select=="")
            $this->db->select("*");
            else
            $this->db->select($select);
            $this->db->from($table);
            $this->db->where($arrWhere);
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0];
        }
        public function select_single_col($table,$col_name,$arrWhere){
            $this->db->select($col_name);
            $this->db->from($table);
            $this->db->where($arrWhere);
            $query = $this->db->get();
            $result = $query->result_array();
           
            return $result[0][$col_name];
        }
        
        public function delete_row($table,$array){
            $this->db->where($array);
           return $this->db->delete($table);
        }
        
        
        public function delete_where($table,$where){
            $this->db->where($where);
           return $this->db->delete($table);
        }
   }        