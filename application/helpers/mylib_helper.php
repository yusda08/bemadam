<?php

function ribbon($name_page = NULL, $name_page2 = NULL, $name_page3 = NULL, $name_page4 = NULL) {
    $data = '<li style="color: #000;"><strong>' . $name_page . '</strong></li>';
    if ($name_page2 != '') {
        $data .= '<li style="color: #000;"><strong>' . $name_page2 . '</strong></li>';
    }
    if ($name_page3 != '') {
        $data .= '<li style="color: #000;"><strong>' . $name_page3 . '</strong></li>';
    }
    if ($name_page4 != '') {
        $data .= '<li style="color: #000;"><strong>' . $name_page4 . '</strong></li>';
    }
    return $data;
}

function jsonArray($array) {
    $ci = &get_instance();
    $ci->output->set_content_type('application/json')->set_output(json_encode($array));
    return;
}

function aksesLog() {
    $ci = &get_instance();
    return $ci->session->userdata('is_logined');
}

function btn_tambah($attr = '', $ket = '') {
    $a = aksesLog();
    $m = aksesMenu($a['kd_user']);
    $rul = $m['rul_tambah'];
    echo "<button $rul class='btn btn-default btn-primary btn-flat btn-block' $attr><i class='fa fa-plus'></i> $ket</button>";
}

function btn_edit($attr = '', $ket = '', $class = '') {
    $a = aksesLog();
    $m = aksesMenu($a['kd_user']);
    $rul = $m['rul_edit'];
    echo "<button $rul class='btn btn-default btn-warning btn-flat $class' $attr><i class='fa fa-pencil'></i> $ket</button>";
}

function btn_hapus($attr = '', $ket = '', $class = '') {
    $a = aksesLog();
    $m = aksesMenu($a['kd_user']);
    $rul = $m['rul_hapus'];
    echo "<button $rul class='btn btn-default btn-danger btn-flat $class' $attr><i class='fa fa-trash'></i> $ket</button>";
}

function aksesMenu($kd_user) {
    $ci = &get_instance();
    $folder = $ci->uri->segment(1);
    $controller = $ci->uri->segment(2);
    $method = $ci->uri->segment(3);
    if (empty($folder) and empty($method)) {
        $url = $controller;
    } elseif (empty($method)) {
        $url = $folder . '/' . $controller;
    } else {
        $url = $folder . '/' . $controller . '/' . $method;
    }
    $query = $ci->db->query("select b.link from menu_role a join menu b on a.id_menu=b.id where a.kd_user=$kd_user and b.link='$url'")->row_array();
    if ($query['link'] != $url) {
        if (empty($folder) and empty($method)) {
            $link = $controller;
        } else {
            $link = $folder . '/' . $controller;
        }
        return $ci->db->query("select a.*, b.*,
if(a.lihat=1, '', 'disabled') as rul_lihat,
if(a.tambah=1, '', 'disabled') as rul_tambah,
if(a.edit=1, '', 'disabled') as rul_edit,
if(a.hapus=1, '', 'disabled') as rul_hapus,
if(a.print=1, '', 'disabled') as rul_print,
b.link from menu_role a join menu b on a.id_menu=b.id where a.kd_user=$kd_user and b.link like '$link%'")->row_array();
    } else {
        return $ci->db->query("select a.*, b.*,
if(a.lihat=1, '', 'disabled') as rul_lihat,
if(a.tambah=1, '', 'disabled') as rul_tambah,
if(a.edit=1, '', 'disabled') as rul_edit,
if(a.hapus=1, '', 'disabled') as rul_hapus,
if(a.print=1, '', 'disabled') as rul_print,
b.link from menu_role a join menu b on a.id_menu=b.id where a.kd_user=$kd_user and b.link ='$url'")->row_array();
    }
}



function penilaianIdm() {
    $ci = &get_instance();
    $a = aksesLog();
    $tahun = $a['tahun'];
    $query = $ci->db->query("select * from ref_penilaian_idm where tahun=$tahun")->row_array();
    return $query;
}

function penilaianIdmTanpaTahun() {
    $ci = &get_instance();
    $a = aksesLog();
    $query = $ci->db->query("select * from ref_penilaian_idm")->row_array();
    return $query;
}

function aktifitas($ket) {
    $ci = &get_instance();
    $a = aksesLog();
    if ($ci->agent->is_browser()) {
        $browser = $ci->agent->browser() . ' ' . $ci->agent->version() . ' (' . $ci->agent->platform() . ')';
    } elseif ($ci->agent->is_robot()) {
        $browser = $ci->agent->robot();
    } elseif ($ci->agent->is_mobile()) {
        $browser = $ci->agent->mobile();
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
    $data1['nama_user'] = $a['nama_user'];
    $data1['keterangan'] = $ket;
    $data1['ket_level'] = $a['ket_level'];
    $data1['kd_user'] = $a['kd_user'];
    $ci->db->insert('aktifitas', $data1);
}

function Terbilang($x) {
    $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($x < 12)
        return " " . $abil[$x];
    elseif ($x < 20)
        return Terbilang($x - 10) . "belas";
    elseif ($x < 100)
        return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
    elseif ($x < 200)
        return " seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
        return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
        return " seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
        return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}

