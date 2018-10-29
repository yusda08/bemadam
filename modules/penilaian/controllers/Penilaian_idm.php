<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Penilaian_idm
 *
 * @author Asus
 */
class Penilaian_idm extends MY_Controller {

    //put your code here

    var $a;
    private $tabel_idm = 'data_idm';

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_penilaian');
        $this->load->model('Model_basis');
        $this->a = aksesLog();
    }

    public function index() {
        $record = $this->javasc_back();
        $kd_kab = isset($_REQUEST['kd_kab']) ? $_REQUEST['kd_kab'] : "";
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : "";
        $record['kd_kab'] = $kd_kab;
        $record['status'] = $status;
        if (!empty($kd_kab) and empty($status)) {
            $record['get_penilaianIdm'] = $this->Model_penilaian->get_penilaianIdm($kd_kab, $this->a['tahun'])->result();
        } elseif (!empty($kd_kab) and ! empty($status)) {
            $row_stts = $this->Model_basis->get_statusIdm($status)->row();
            $record['get_penilaianIdm'] = $this->Model_penilaian->get_penilaianIdmFilter($kd_kab, $this->a['tahun'], $row_stts->nama_status)->result();
        }
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_statusIdm'] = $this->Model_basis->get_statusIdm()->result();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $data = $this->layout_back('penilaian/penilaian_idm', $record);
        $data['ribbon'] = ribbon('Penilaian', 'Desa Mandiri');
        $this->backend($data);
    }

    function updateImd() {
        $aksi = $this->input->post('aksi');
        $kd_prov = $this->input->post('kd_prov');
        $kd_kab = $this->input->post('kd_kab');
        $kd_kec = $this->input->post('kd_kec');
        $kd_desa = $this->input->post('kd_desa');
        $tahun = $this->input->post('tahun');
        $nilai = $this->input->post('nilai');
        if ($aksi == 'iks') {
            $data['iks'] = $nilai;
        } elseif ($aksi == 'ike') {
            $data['ike'] = $nilai;
        } elseif ($aksi == 'ikl') {
            $data['ikl'] = $nilai;
        }
        $data['kd_prov'] = $kd_prov;
        $data['kd_kab'] = $kd_kab;
        $data['kd_kec'] = $kd_kec;
        $data['kd_desa'] = $kd_desa;
        $data['tahun'] = $tahun;
        $q = $this->insert_duplicate($this->tabel_idm, $data);
        if ($q) {
            $row_pn = $this->Model_penilaian->get_penilaianIdmWhere($kd_prov, $kd_kab, $kd_kec, $kd_desa, $this->a['tahun'])->row_array();
            jsonArray($row_pn);
            if ($row_pn['status'] == 'Mandiri') {
                $dt['status'] = 1;
            } elseif ($row_pn['status'] == 'Maju') {
                $dt['status'] = 2;
            } elseif ($row_pn['status'] == 'Berkembang') {
                $dt['status'] = 3;
            } elseif ($row_pn['status'] == 'Tertinggal') {
                $dt['status'] = 4;
            }
            $dt['kd_prov'] = $kd_prov;
            $dt['kd_kab'] = $kd_kab;
            $dt['kd_kec'] = $kd_kec;
            $dt['kd_desa'] = $kd_desa;
            $dt['tahun'] = $tahun;
            $this->insert_duplicate($this->tabel_idm, $dt);
        } else {
            echo 'false';
        }
    }

}
