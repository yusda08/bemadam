<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Data_program
 *
 * @author Asus
 */
class Data_prog_keg extends MY_Controller {

    //put your code here

    var $a;
    private $tabel_prog = 'ref_program';
    private $tabel_keg = 'ref_kegiatan';

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_setting');
        $this->load->model('Model_basis');
        $this->a = aksesLog();
    }

    public function index() {
        $record = $this->javasc_back();
        $record['get_dataProgram'] = $this->Model_basis->get_dataProgram($this->a['tahun']);
        $record['get_dataKegiatan'] = $this->Model_basis->get_dataKegiatan($this->a['tahun']);
        $record['get_dataBidang'] = $this->Model_basis->get_dataBidang();
        $record['get_dataSubBidang'] = $this->Model_basis->get_dataSubBidang();
        $record['kd_new'] = $this->Model_basis->maxProg($this->a['tahun']);
        $data = $this->layout_back('database/data_prog_keg', $record);
        $data['ribbon'] = ribbon('Basis Data', 'Provinsi', 'Kabupaten');
        $this->backend($data);
    }

    function aksiProgram() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $kd_bid = $this->input->post('kd_bid');
        $tahun = $this->input->post('tahun');
        $ket_program = $this->input->post('ket_program');
        $kd_prog = $this->input->post('kd_prog');
        if ($aksi == 'tambah') {
            $ket = 'Menambah Data Program dengan Ket : ' . $kd_prog . '.' . $kd_bid . '.' . $tahun . ' - ' . $ket_program;
        } else {
            $ket = 'Update Data Program dengan Ket : ' . $kd_prog . '.' . $kd_bid . '.' . $tahun . ' - ' . $ket_program;
        }
        $data['kd_bid'] = $kd_bid;
        $data['kd_prog'] = $kd_prog;
        $data['tahun'] = $tahun;
        $data['ket_program'] = $ket_program;
        $data['kd_int'] = $kd_prog;
        $que = $this->insert_duplicate($this->tabel_prog, $data);
        if ($que) {
            $this->aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function aksiKegiatan() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $kd_sub = $this->input->post('kd_sub');
        $tahun = $this->input->post('tahun');
        $ket_kegiatan = $this->input->post('ket_kegiatan');
        $kd_prog = $this->input->post('kd_prog');
        $kd_keg = $this->input->post('kd_keg');
        $kd_bid = $this->input->post('kd_bid');
        if ($aksi == 'tambah') {
            $data['kd_bid'] = $kd_bid;
            $ket = 'Menambah Data Kegiatan dengan Ket : ' . $kd_keg . '.' . $kd_prog . '.' . $kd_sub . '.' . $tahun . ' - ' . $ket_kegiatan;
        } else {
            $ket = 'Update Data Kegiatan dengan Ket : ' . $kd_keg . '.' . $kd_prog . '.' . $kd_sub . '.' . $tahun . ' - ' . $ket_kegiatan;
        }
        $data['kd_sub'] = $kd_sub;
        $data['kd_prog'] = $kd_prog;
        $data['tahun'] = $tahun;
        $data['ket_kegiatan'] = $ket_kegiatan;
        $data['kd_int'] = $kd_keg;
        $data['kd_keg'] = $kd_keg;
        $que = $this->insert_duplicate($this->tabel_keg, $data);
        if ($que) {
            $this->aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function tarikProgramTahun() {
        $url = $this->input->post('url');
        $tahun = $this->input->post('tahun');
        $query = $this->Model_basis->get_dataProgramwhereTahun($tahun);
        $query1 = $this->Model_basis->get_dataKegiatanWhereTahun($tahun);
        $ket = 'Tarik Data Program dengan Ket : ' . $tahun;
        foreach ($query->result() as $row) {
            $data['kd_bid'] = $row->kd_bid;
            $data['kd_prog'] = $row->kd_prog;
            $data['tahun'] = $this->a['tahun'];
            $data['ket_program'] = $row->ket_program;
            $data['kd_int'] = $row->kd_prog;
            $que = $this->insert_duplicate($this->tabel_prog, $data);
        }
        foreach ($query1->result() as $row_k) {
            $data1['kd_sub'] = $row_k->kd_sub;
            $data1['kd_prog'] = $row_k->kd_prog;
            $data1['kd_keg'] = $row_k->kd_keg;
            $data1['kd_bid'] = $row_k->kd_bid;
            $data1['tahun'] = $this->a['tahun'];
            $data1['ket_kegiatan'] = $row_k->ket_kegiatan;
            $data1['kd_int'] = $row_k->kd_keg;
            $que = $this->insert_duplicate($this->tabel_keg, $data1);
        }
        if ($que) {
            $this->aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function deleteProgram() {
        $tahun = $this->input->post('tahun');
        $kd_prog = $this->input->post('kd_prog');
        $id_colum['tahun'] = $tahun;
        $id_colum['kd_prog'] = $kd_prog;
        $que = $this->delete_where($this->tabel_prog, $id_colum);
        if ($que) {
            $ket = 'Hapus Data Program dengan Ket : ' . $kd_prog . '.' . $tahun;
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function deleteKegiatan() {
        $tahun = $this->input->post('tahun');
        $kd_prog = $this->input->post('kd_prog');
        $kd_keg = $this->input->post('kd_keg');
        $id_colum['tahun'] = $tahun;
        $id_colum['kd_prog'] = $kd_prog;
        $id_colum['kd_keg'] = $kd_keg;
        $que = $this->delete_where($this->tabel_keg, $id_colum);
        if ($que) {
            $ket = 'Hapus Data Kegiatan dengan Ket : ' . $kd_keg . '.' . $kd_prog . '.' . $tahun;
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
