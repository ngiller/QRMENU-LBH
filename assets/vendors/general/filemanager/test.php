<?php
session_start();
echo "test ". $_SESSION["fl"];
    //include('index.php');
    //ob_end_clean();
    //$CI =& get_instance();
    //$CI->load->library('session'); //if it's not autoloaded in your CI setup
    //echo $CI->session->userdata('name');
?>