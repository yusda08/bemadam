<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    var $a;

    public function __construct() {
        parent::__construct();
        $this->a = aksesLog();
        $this->load->model('Model_basis');
        $this->load->model('Model_penilaian');
    }

    public function index() {
        if ($this->a) {
            $record = $this->javasc_back();
            $record['get_kabJmlDesa'] = $this->Model_basis->get_kabJmlDesa();
            $data = $this->layout_back('dashboard', $record);
            $data['ribbon'] = ribbon('Dasboard');
            $this->backend($data);
        } else {
            redirect('Login');
        }
    }

}
