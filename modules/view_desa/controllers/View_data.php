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
class View_data extends MY_Controller {

    //put your code here
    var $a;
    private $tabel_dm = 'data_desa_mandiri';

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
            $record['get_viewDesaNilai'] = $this->Model_penilaian->get_viewDesaNilai($kd_kab, $this->a['tahun'])->result();
        } elseif (!empty($kd_kab) and ! empty($status)) {
            $row_stts = $this->Model_basis->get_statusIdm($status)->row();
            $record['get_viewDesaNilai'] = $this->Model_penilaian->get_viewDesaNilaiFilter($kd_kab, $this->a['tahun'], $row_stts->nama_status)->result();
        } elseif (empty($kd_kab) and ! empty($status)) {
            $row_stts = $this->Model_basis->get_statusIdm($status)->row();
            $record['get_viewDesaNilai'] = $this->Model_penilaian->get_viewDesaNilaiFilter('', $this->a['tahun'], $row_stts->nama_status)->result();
        } else {
            $record['get_viewDesaNilai'] = $this->Model_penilaian->get_viewDesaNilai('', $this->a['tahun'])->result();
        }

        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_statusIdm'] = $this->Model_basis->get_statusIdm()->result();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $data = $this->layout_back('view_desa/lihat_data', $record);
        $data['ribbon'] = ribbon('Lihat Data', 'Desa');
        $this->backend($data);
    }

}
