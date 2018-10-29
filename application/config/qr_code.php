<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['cacheable'] 	= TRUE; //boolean, the default is true
$config['imagedir'] 	= 'assets/img/qr_codes/'; //string, the default is tmp/qr_codes/
$config['ciqrcodelib'] 	= 'application/third_party/qrcode/'; //string, the default is application/third_party/qr_code/
$config['quality'] 		= TRUE; //boolean, the default is true
$config['size'] 		= 1024; 	//interger, the default is 1024
$config['black']        = array(224,255,255); // array, default is array(255,255,255)
$config['white']        = array(70,130,180); // array, default is array(0,0,0)