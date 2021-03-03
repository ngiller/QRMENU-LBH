<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailjet extends CI_Controller {

    function __construct(){
        parent::__construct();
        
    }
 
	public function sendmail(){
        require 'vendor/autoload.php';
        echo "testing";
    }
}