<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Data_sotk
 *
 * @author Asus
 */
class Data_penilaian extends MY_Controller {

    //put your code here
    var $a;
    private $ref_penilaian = 'ref_penilaian_idm';

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_setting');
        $this->load->model('Model_basis');
        $this->a = aksesLog();
    }

    public function index() {
        $record = $this->javasc_back();
        $record['get_penilaianIdm'] = $this->Model_basis->get_penilaianIdm()->result();
        $record['get_settingStatus'] = $this->Model_basis->get_settingStatus()->result();
        $record['get_statusIdm'] = $this->Model_basis->get_statusIdm()->result();
        $data = $this->layout_back('database/penilaian_idm', $record);
        $data['ribbon'] = ribbon('Basis Data', 'Penilaian IDM');
        $this->backend($data);
    }

    public function inputPenilaianTahun() {
        $record = $this->javasc_back();
        $record['get_penilaianIdm'] = $this->Model_basis->get_penilaianIdm()->result();
        $record['get_settingStatus'] = $this->Model_basis->get_settingStatus()->result();
        $record['get_statusIdm'] = $this->Model_basis->get_statusIdm()->result();
        $data['head'] = $this->load->view('back/head', NULL, TRUE);
//        $data['nav_header'] = $this->load->view('back/nav_header', NULL, TRUE);
        $data['footer'] = $this->load->view('back/footer', NULL, TRUE);
        $data['content'] = $this->load->view('database/penilaian_idm', $record, TRUE);
//        $data = $this->layout_back(, $record);
        $data['ribbon'] = ribbon('Basis Data', 'Penilaian IDM');
        $this->backend($data);
    }

    function aksiPenilaian() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $tahun = $this->input->post('tahun');
        $tertinggal = $this->input->post('tertinggal');
        $maju = $this->input->post('maju');
        $berkembang = $this->input->post('berkembang');
        $id_status = $this->input->post('id_status');
        $data['berkembang'] = $berkembang;
        $data['tertinggal'] = $tertinggal;
        $data['maju'] = $maju;
        $data['tahun'] = $tahun;
        $data['id_status'] = $id_status;
        $q = $this->insert_duplicate($this->ref_penilaian, $data);
        if ($q) {
            $ket = strtoupper($aksi . ' Data Penilaian Tahun : ' . $tahun);
            aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect('login/Login');
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

}
