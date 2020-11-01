<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('my_date'))
{
    function db_null($title,$value,$empty="")
    {
        $ci =& get_instance();
        if($value==$empty){
             $ci->db->set($title, 'NULL', FALSE);
        }else{
            return $value;  
        }
        
    }
    
}