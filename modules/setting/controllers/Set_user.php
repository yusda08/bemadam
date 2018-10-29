<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Set_user extends MY_Controller {

    var $a;
    private $tabel_user = 'user';
    private $tabel_group = 'user_group';

    public function __construct() {
        parent::__construct();
        $this->a = aksesLog();
    }

    public function index() {
        if ($this->a) {
            $record = $this->javasc_back();
            $kd_level = isset($_REQUEST['kd_level']) ? $_REQUEST['kd_level'] : "";
            $record['kd_level'] = $kd_level;
            $record['kd_new'] = $this->Model_Auth->maxUser();
//            return var_dump($record);
            $record['get_levelUser'] = $this->Model_Auth->get_levelUser()->result();
            $record['get_user'] = $this->Model_Auth->get_user()->result();
            $data = $this->layout_back('set_user', $record);
            $data['ribbon'] = ribbon('Setting', 'Setting User');
            $this->backend($data);
        } else {
            redirect('Login');
        }
    }

    function insertUser() {
        if ($this->a) {
            $url = $this->input->post('url');
            $kd_user = $this->input->post('kd_user');
            $ket = 'Tambah User dengan Level : ' . $this->input->post('kd_level') . '.' . $kd_user . ' - ' . $this->input->post('nama_user');
            $data['kd_user'] = $kd_user;
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->input->post('password');
            $data['nama_user'] = $this->input->post('nama_user');
            $data['email'] = $this->input->post('email');
            $data['no_telpon'] = $this->input->post('no_telpon');
            if ($this->insert($this->tabel_user, $data)) {
                $data1['kd_user'] = $kd_user;
                $data1['kd_level'] = $this->input->post('kd_level');
                $this->insert($this->tabel_group, $data1);
                $this->aktifitas($ket);
                $this->flashdata($ket, 'Berhasil');
                redirect($url);
            } else {
                $this->flashdata($ket, 'Gagal');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }

    function updateKunci() {
        $kd_user = $this->input->post('kd_user');
        $ket = $this->input->post('ket');
        if ($ket == 0) {
            $data['is_active'] = 1;
        } else {
            $data['is_active'] = 0;
        }
        $qry = $this->update('kd_user', $kd_user, $this->tabel_user, $data);
        if ($qry) {
            $kt = 'Update Is Active dengan Kd User : ' . $kd_user;
            $this->aktifitas($kt);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function deleteUser() {
        $kd_user = $this->input->post('kd_user');
        $qry = $this->delete('kd_user', $kd_user, $this->tabel_user);
        if ($qry) {
            $kt = 'Menghapus data User dengan Kd User : ' . $kd_user;
            $this->aktifitas($kt);
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
