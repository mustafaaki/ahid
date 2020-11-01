<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('my_pass'))
{
    function pass_encryption($code = '')
    {
        $code= sha1(base64_encode(md5(base64_encode($code))));;
        return $code; 
    }   
}