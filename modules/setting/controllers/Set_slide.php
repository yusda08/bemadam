<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Set_slide
 *
 * @author Asus
 */
class Set_slide extends MY_Controller {

    //put your code here

    var $a;
    private $tabel_slide = 'slide_show';

    public function __construct() {
        parent::__construct();
        $this->a = aksesLog();
        $this->load->model('Model_setting');
    }

    public function index() {
        if ($this->a) {
            $record = $this->javasc_back();
            $record['get_slideShow'] = $this->Model_setting->get_slideShow()->result();
            $data = $this->layout_back('setting/set_slide', $record);
            $data['ribbon'] = ribbon('Setting', 'Setting Slide Show');
            $this->backend($data);
        } else {
            redirect('Login');
        }
    }

    public function tambahSlideShow() {
        if ($this->a) {
            $record = $this->javasc_back();
//            $record['get_slideShow'] = $this->Model_setting->get_slideShow()->result();
            $data = $this->layout_back('setting/action/tambah_slide', $record);
            $data['ribbon'] = ribbon('Setting', 'Setting Slide Show');
            $this->backend($data);
        } else {
            redirect('Login');
        }
    }

    public function editSlideShow() {
        if ($this->a) {
            $record = $this->javasc_back();
            $id = $this->input->get('id');
            $record['row_slide'] = $this->Model_setting->get_slideShowWhereId($id);
            $data = $this->layout_back('setting/action/edit_slide', $record);
            $data['ribbon'] = ribbon('Setting', 'Setting Slide Show');
            $this->backend($data);
        } else {
            redirect('Login');
        }
    }

    function insertSlideShow() {
        $ket = 'Tambah Slide Show';
        $nama = $this->input->post('nama');
        $judul = $this->input->post('judul');
        $keterangan = addslashes($this->input->post('keterangan'));
        $imageName = $this->input->post('foto');
        rename('assets/img/_thumb/' . $imageName, 'assets/img/slide/' . $imageName);
        $data['foto'] = $imageName;

        $data['judul'] = $judul;
        $data['keterangan'] = $keterangan;
        $query = $this->insert($this->tabel_slide, $data);
        if ($query) {
            $this->aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect('setting/Set_slide');
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function updateSlideShow() {
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $ket = 'Update Slide Show';
        $judul = $this->input->post('judul');
        $keterangan = addslashes($this->input->post('keterangan'));
        $imageName = $this->input->post('foto');
        $img = $this->input->post('img');
        if ($imageName != '') {
            rename('assets/img/_thumb/' . $imageName, 'assets/img/slide/' . $imageName);
            $data['foto'] = $imageName;
            $path = '././assets/img/slide/';
            unlink($path . $img);
        }
        $data['judul'] = $judul;
        $data['keterangan'] = $keterangan;
        $query = $this->update('id', $id, $this->tabel_slide, $data);
        if ($query) {
            $this->aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect('setting/Set_slide');
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function deleteSlideShow() {
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $ket = 'Hapus Slide Show';
        $img = $this->input->post('img');
        $path = '././assets/img/slide/';
        unlink($path . $img);
        $query = $this->delete('id', $id, $this->tabel_slide);
        if ($query) {
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function updateStatus() {
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $ket = 'Update Status Slide Show';
        if ($status == 'Y') {
            $data['status'] = 'N';
        } else {
            $data['status'] = 'Y';
        }

        $query = $this->update('id', $id, $this->tabel_slide, $data);
        if ($query) {
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
