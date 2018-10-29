<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Not_found
 *
 * @author Asus
 */
class Not_found extends MY_Controller {

    //put your code here
    var $a;

    public function __construct() {
        parent::__construct();
        $this->a = aksesLog();
    }

    public function index() {
        if ($this->a) {
            $record = $this->javasc_back();
            $data['ribbon'] = ribbon('Error 404');
            $data = $this->layout_back('not_found', $record);
            $this->backend($data);
        } else {
            redirect('login');
        }
    }

}
