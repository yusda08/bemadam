<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_portal');
        $this->load->model('Model_berita');
        $this->load->model('Model_link');
    }

    public function index() {
        $record = $this->javasc_front();
        $record['get_portalAplikasi'] = $this->Model_portal->get_portalAplikasi();
        $data = $this->layout_front('baranda', $record);
        $this->frontend($data);
    }

    public function home() {
        $record = $this->javasc_front();
        $record['get_berita'] = $this->Model_berita->get_berita()->result();
        $hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
        $limit = 6;
        $batas = ($hal - 1) * $limit;
        $record['limit'] = $limit;
        $record['hal'] = $hal;
        $record['get_beritaLimit'] = $this->Model_berita->get_beritaLimit($batas, $limit)->result();
        $record['get_link'] = $this->Model_link->get_link()->result();
        $data = $this->layout_front('home', $record);
        $this->frontend($data);
    }

    function tooltips() {
        $id_portal = $this->input->get('id_portal');
        $record['get_linkAplikasi'] = $this->Model_portal->get_linkAplikasi($id_portal);
        $data = $this->load->view('ajax/tooltips', $record, true);
        echo $data;
    }

}
