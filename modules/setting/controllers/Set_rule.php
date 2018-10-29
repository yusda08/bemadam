<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Set_rule
 *
 * @author Asus
 */
class Set_rule extends MY_Controller {

    //put your code here
    var $a;

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_setting');
        $this->a = aksesLog();
    }

    public function index() {
        $record = $this->javasc_back();
        $kd_level = isset($_REQUEST['kd_level']) ? $_REQUEST['kd_level'] : "";
        $record['kd_level'] = $kd_level;

        $record['get_setUser'] = $this->Model_Auth->get_user();
        $record['get_levelUser'] = $this->Model_Auth->get_levelUser()->result();
        $data = $this->layout_back('setting/list_user_rule', $record);
        $data['ribbon'] = ribbon('Setting', 'Pilih User');
        $this->backend($data);
    }

    public function rule_user() {
        $kd_level = $this->input->get('kd_level');
        $kd_user = $this->input->get('kd_user');
        $record = $this->javasc_back();
        $row_user = $this->Model_Auth->get_user($kd_user)->row();
        $record['kd_user'] = $kd_user;
        $record['kd_level'] = $kd_level;
        $record['nama_user'] = $row_user->nama_user;
        $record['get_ruleMenu'] = $this->Model_setting->get_ruleMenu($kd_user);
        $record['get_menu'] = $this->Model_Auth->get_menu();

        //data
        $data = $this->layout_back('setting/rule_user', $record);
        $data['ribbon'] = ribbon('Setting', 'Role Menu');
        $this->backend($data);
    }

    function insertAllMenu() {
        
        $kd_user = $this->input->post('kd_user');
        $get_menu = $this->Model_Auth->get_menu();
        foreach ($get_menu->result() as $row) {
                $data['kd_user'] = $kd_user;
                $data['id_menu'] = $row->id;
//                print_r($data);
                $q = $this->insert_duplicate('menu_role', $data);
        }

        $ket = 'Menambah Semua Role Menu : ' . $kd_user;
        $this->aktifitas($ket);
        echo 'true';
    }

    function insertRoleMenu() {
        $url = $this->input->post('url');
        $kd_user = $this->input->post('kd_user');
        $id_menu = $this->input->post('id_menu');
        $data['kd_user'] = $kd_user;
        $data['id_menu'] = $id_menu;
//        return print_r($data);
        $q = $this->insert_duplicate('menu_role', $data);
        if ($q) {
            $ket = 'Menambah Role Menu : ' . $id_menu . ' - ' . $kd_user;
            aktifitas($ket);
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Berhasil ' . $ket);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal ' . $ket);
            redirect($url);
        }
    }

    function deleteMenu() {
        $kd_user = $this->input->post('kd_user');
        $id_menu = $this->input->post('id_menu');
        $data['id_menu'] = $id_menu;
        $data['kd_user'] = $kd_user;
        $q = $this->delete_where('menu_role', $data);
        if ($q) {
            $ket = 'Menghapus Role Menu : ' . $id_menu . ' - ' . $kd_user;
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function update_rule_aksi() {
        $aksi = $this->input->post('aksi');
        $status = $this->input->post('status');
        $id_menu = $this->input->post('id_menu');
        $kd_user = $this->input->post('kd_user');
        if ($status == 0) {
            $st = 1;
        } elseif ($status == 1) {
            $st = 0;
        }
        if ($aksi == 'lihat') {
            $data['lihat'] = $st;
        } elseif ($aksi == 'tambah') {
            $data['tambah'] = $st;
        } elseif ($aksi == 'edit') {
            $data['edit'] = $st;
        } elseif ($aksi == 'hapus') {
            $data['hapus'] = $st;
        } elseif ($aksi == 'print') {
            $data['print'] = $st;
        }
        $id_colum['id_menu'] = $id_menu;
        $id_colum['kd_user'] = $kd_user;
        $query = $this->update_where('menu_role', $data, $id_colum);
        if ($query) {
            echo "true";
        } else {
            echo "false";
        }
    }

    function pilihMenu($parent, $kd_user) {
        $get_menu = $this->Model_Auth->get_menu();
        $get_ruleMenu = $this->Model_setting->get_ruleMenu($kd_user);
        $data = "<option value=''>Pilih Menu<option>";
        foreach ($get_menu->result() as $row_m) {
            if ($row_m->parent == $parent) {
                foreach ($get_ruleMenu->result() as $row) {
                    if ($row->id_menu == $row_m->id and $row->kd_user == $kd_user) {
                        $att = 'disabled';
                        break;
                    } else {
                        $att = '';
                    }
                }
                $data .= "<option $att value='$row_m->id'>$row_m->nama </option>";
            }
        }
        echo $data;
    }

}
