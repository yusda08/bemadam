<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of New_maps
 *
 * @author Asus
 */
class New_maps extends MY_Controller {

//put your code here
    var $a;

    public function __construct() {
        parent::__construct();
        $this->a = aksesLog();
    }

    public function index() {
        $this->load->view('peta_desa/maps_new', NULL);
    }

}
