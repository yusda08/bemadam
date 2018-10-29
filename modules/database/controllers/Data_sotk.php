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
class Data_sotk extends MY_Controller {

    //put your code here
    var $a;
    private $tabel_bid = 'ref_sotk_bidang';
    private $tabel_sub = 'ref_sotk_sub_bidang';

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_setting');
        $this->load->model('Model_basis');
        $this->a = aksesLog();
    }

    public function index() {
        $record = $this->javasc_back();
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_dataBidang'] = $this->Model_basis->get_dataBidang()->result();
        $record['get_dataSubBidang'] = $this->Model_basis->get_dataSubBidang()->result();
        $data = $this->layout_back('database/sotk_bidang', $record);
        $data['ribbon'] = ribbon('Basis Data', 'SOTK Bidang');
        $this->backend($data);
    }

    function aksiBidang() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $kd_bid = $this->input->post('kd_bid');
        $nama_jabatan = strtoupper($this->input->post('nama_jabatan'));
        $data['nama_jabatan'] = $nama_jabatan;
        if ($aksi == 'tambah') {
            $ket = strtoupper($aksi . ' Data SOTK Bidang Dengan : ' . $nama_jabatan);
            $q = $this->insert($this->tabel_bid, $data);
        } else {
            $ket = strtoupper($aksi . ' Data SOTK Bidang Dengan : ' . $nama_jabatan);
            $q = $this->update('kd_bid', $kd_bid, $this->tabel_bid, $data);
        }
        if ($q) {
            aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }
    function deleteBidang() {
        $url = $this->input->post('url');
        $kd_bid = $this->input->post('kd_bid');
            $ket = strtoupper('Hapus Data SOTK Bidang Dengan : ' . $kd_bid);
            $q = $this->delete('kd_bid', $kd_bid,$this->tabel_bid);
        if ($q) {
            aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    function aksiSubBidang() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $kd_bid = $this->input->post('kd_bid');
        $kd_sub = $this->input->post('kd_sub');
        $nama_jabatan = strtoupper($this->input->post('nama_jabatan'));
        $data['nama_jabatan'] = $nama_jabatan;
        $data['kd_bid'] = $kd_bid;
        if ($aksi == 'tambah') {
            $ket = strtoupper($aksi . ' Data SOTK Sub Bidang Dengan : ' . $nama_jabatan);
            $q = $this->insert($this->tabel_sub, $data);
        } else {
            $ket = strtoupper($aksi . ' Data SOTK sub Bidang Dengan : ' . $nama_jabatan);
            $q = $this->update('kd_sub', $kd_sub, $this->tabel_sub, $data);
        }
        if ($q) {
            aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }
    function deleteSubBidang() {
        $url = $this->input->post('url');
        $kd_sub = $this->input->post('kd_sub');
            $ket = strtoupper('Hapus Data SOTK Sub Bidang Dengan : ' . $kd_sub);
            $q = $this->delete('kd_sub', $kd_sub, $this->tabel_sub);
        if ($q) {
            aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
