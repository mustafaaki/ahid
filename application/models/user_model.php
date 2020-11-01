<?php 

   class user_model extends CI_Model {

    

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function check_user($username,$pass){
            
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where(Array("email"=>$username,"password"=>$pass,"pub"=>"y"));
            $query = $this->db->get();
            $result = $query->result_array();
            //echo $this->db->last_query();
            if ($query->num_rows() == 1) {
               return $result;
            }else{
               return false;
            }
                        
        }
        
    
      
        public function user_email_count($email){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where(Array("email"=>$email));
            $query = $this->db->get();
            $num_rows= $query->num_rows();
            return $num_rows;
            
        }
        
        public function user_list(){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('subeler', 'subeler.sube_id = users.sube_id');
            $this->db->order_by("subeler.sube_no", "asc");
            $query = $this->db->get();
            $result= $query->result_array();
            return $result;
        }
        
        public function user_pub($id,$val){
            $this->db->update('users', Array("pub"=>$val), array('id' => $id));
        }
        
        public function select_user($id){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where(Array("id"=>$id));
            $query = $this->db->get();
            $result= $query->result_array();
            return $result[0];
        }
        
        public function pass_check($id,$password){
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where(Array("id"=>$id,"password"=>$password,"pub"=>"y"));
                $query = $this->db->get();
                $num_rows= $query->num_rows();
                return $num_rows;
        }
}