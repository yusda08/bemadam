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
class Desa_mandiri extends MY_Controller {

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
        $kd_kec = isset($_REQUEST['kd_kec']) ? $_REQUEST['kd_kec'] : "";
        $record['kd_kab'] = $kd_kab;
        $record['kd_kec'] = $kd_kec;
        if(!empty($kd_kab) and !empty($kd_kec)){
            $record['get_dataDesa'] = $this->Model_penilaian->get_penilaianDesaMandiri($kd_kab, $kd_kec, $this->a['tahun'])->result();
        }
        
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $record['get_dataKec'] = $this->Model_basis->get_dataKec()->result();
        $data = $this->layout_back('penilaian/desa_mandiri', $record);
        $data['ribbon'] = ribbon('Penilaian', 'Desa Mandiri');
        $this->backend($data);
    }

    public function inputKegiatan() {
        $record = $this->javasc_back();
        $kd_kab = $_GET['kd_kab'];
        $kd_kec = $_GET['kd_kec'];
        $kd_desa = $_GET['kd_desa'];
        $record['kd_kab'] = $kd_kab;
        $record['kd_kec'] = $kd_kec;
        $record['kd_desa'] = $kd_desa;
        $record['tahun'] = $this->a['tahun'];
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_dataBidang'] = $this->Model_basis->get_dataBidang()->result();
        $record['get_dataKegiatan'] = $this->Model_basis->get_dataKegiatan($this->a['tahun'])->result();
        $record['row_nl'] = $this->Model_basis->get_dataDesaWhereKd($kd_kab, $kd_kec, $kd_desa)->row();
        $record['get_bidangDesa'] = $this->Model_penilaian->get_bidangDesa($kd_kab, $kd_kec, $kd_desa, $this->a['tahun'])->result();
        $record['get_kegiatanDesa'] = $this->Model_penilaian->get_kegiatanDesa($kd_kab, $kd_kec, $kd_desa, $this->a['tahun'])->result();

        $data = $this->layout_back('penilaian/action/input_kegiatan', $record);
        $data['ribbon'] = ribbon('Penilaian', 'Desa Mandiri', 'Data Bidang Dan Kegiatan');
        $this->backend($data);
    }

    function loadKecamatan() {
        $kd_kab = $this->input->post('kd_kab');
        $get_dataKec = $this->Model_basis->get_dataKecWhereKdKab($kd_kab)->result();
        $data = '<option value="">-- Pilih Kecamatan -- </option>';
        foreach ($get_dataKec as $row) {
            $data .= '<option  value="' . $row->kd_kec . '"> ' . $row->kd_kec . '. ' . strtoupper($row->nama) . '</option>';
        }
        echo $data;
    }

    function aksiKegiatan() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $kd_prov = $this->input->post('kd_prov');
        $kd_kab = $this->input->post('kd_kab');
        $kd_kec = $this->input->post('kd_kec');
        $kd_desa = $this->input->post('kd_desa');
        $tahun = $this->input->post('tahun');
        $kd_keg = $this->input->post('kd_keg');
        $kd_prog = $this->input->post('kd_prog');
        $ket = strtoupper($aksi . ' Data Kegiatan Penilaian Mandiri Dengan : ' . $kd_kab . '.' . $kd_kec . ' . ' . $tahun . '.' . $kd_prog . '.' . $kd_keg);
        $data['kd_prov'] = $kd_prov;
        $data['kd_kab'] = $kd_kab;
        $data['kd_kec'] = $kd_kec;
        $data['kd_desa'] = $kd_desa;
        $data['tahun'] = $tahun;
        $data['kd_keg'] = $kd_keg;
        $data['kd_prog'] = $kd_prog;
        $q = $this->insert_duplicate($this->tabel_dm, $data);
        if ($q) {
            aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function deleteKegiatan() {
        $kd_prov = $this->input->post('kd_prov');
        $kd_kab = $this->input->post('kd_kab');
        $kd_kec = $this->input->post('kd_kec');
        $kd_desa = $this->input->post('kd_desa');
        $tahun = $this->input->post('tahun');
        $kd_prog = $this->input->post('kd_prog');
        $kd_keg = $this->input->post('kd_keg');
        $data['kd_prov'] = $kd_prov;
        $data['kd_kab'] = $kd_kab;
        $data['kd_kec'] = $kd_kec;
        $data['kd_desa'] = $kd_desa;
        $data['tahun'] = $tahun;
        $data['kd_prog'] = $kd_prog;
        $data['kd_keg'] = $kd_keg;
        $q = $this->delete_where($this->tabel_dm, $data);
        if ($q) {
            $ket = 'Menghapus Penilaian Desa (Kegiatan) Dengan kode : ' . $kd_prov . '.' . $kd_kab . '.' . $kd_kec . '.' . $kd_desa . '.' . $tahun . '.' . $kd_prog . '.' . $kd_keg;
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
