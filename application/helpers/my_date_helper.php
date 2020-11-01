<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('my_date'))
{
    function date_formatchange($new_format,$old_format = '')
    {
       $new_date='';
       
       if($old_format!=""){
           $old_format=str_replace("/", "-", $old_format);
           
           $old_date=strtotime($old_format);
           $new_date = date ($new_format,$old_date);
          
       }
       
       return $new_date;
    }   
}