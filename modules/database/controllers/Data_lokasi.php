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
class Data_lokasi extends MY_Controller {

    //put your code here
    var $a;
    private $tabel_prov = 'ref_prov';
    private $tabel_kab = 'ref_kab';
    private $tabel_kec = 'ref_kec';
    private $tabel_desa = 'ref_desa';

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_setting');
        $this->load->model('Model_basis');
        $this->a = aksesLog();
    }

    public function lokasi_kabupaten() {
        $record = $this->javasc_back();
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $record['kd_new'] = $this->Model_basis->maxkab();
        $data = $this->layout_back('database/lokasi_kabupaten', $record);
        $data['ribbon'] = ribbon('Basis Data', 'Provinsi', 'Kabupaten');
        $this->backend($data);
    }
    
    function editProvinsi(){
        $kd_prov= $this->input->post('name');
        $nama = $this->input->post('value');
        $data['nama'] = $nama;
        $this->update('kd_prov',$kd_prov, $this->tabel_prov, $data);
    }
    
    public function lokasi_kecamatan() {
        $record = $this->javasc_back();
        $kd_kab = isset($_REQUEST['kd_kab']) ? $_REQUEST['kd_kab'] : "";
        if (!empty($kd_kab)) {
            $record['kd_new'] = $this->Model_basis->maxKec($kd_kab);
        }

        $record['kd_kab'] = $kd_kab;
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $record['get_dataKec'] = $this->Model_basis->get_dataKec()->result();
        $data = $this->layout_back('database/lokasi_kecamatan', $record);
        $data['ribbon'] = ribbon('Basis Data', 'Kecamatan');
        $this->backend($data);
    }

    public function lokasi_desa() {
        $record = $this->javasc_back();
        $kd_kab = isset($_REQUEST['kd_kab']) ? $_REQUEST['kd_kab'] : "";
        $kd_kec = isset($_REQUEST['kd_kec']) ? $_REQUEST['kd_kec'] : "";
        $record['kd_kab'] = $kd_kab;
        $record['kd_kec'] = $kd_kec;
        if (!empty($kd_kab) and ! empty($kd_kec)) {
            $record['kd_new'] = $this->Model_basis->maxDesa($kd_kab, $kd_kec);
        }
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $record['get_dataKec'] = $this->Model_basis->get_dataKec()->result();
        $record['get_dataDesa'] = $this->Model_basis->get_dataDesa()->result();
        $data = $this->layout_back('database/lokasi_desa', $record);
        $data['ribbon'] = ribbon('Basis Data', 'Desa');
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

    function aksiKabupaten() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $kd_kab = $this->input->post('kd_kab');
        $kd_prov = $this->input->post('kd_prov');
        $nama = strtoupper($this->input->post('nama'));
        $ket = strtoupper($aksi . ' Data Kabupaten Dengan : ' . $kd_kab . '.' . $kd_kec . ' - ' . $nama);
        $data['kd_kab'] = $kd_kab;
        $data['kd_prov'] = $kd_prov;
        $data['nama'] = $nama;
        $q = $this->insert_duplicate($this->tabel_kab, $data);
        if ($q) {
            aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function deleteKabupaten() {
        $kd_kab = $this->input->post('kd_kab');
        $kd_prov = $this->input->post('kd_prov');
        $data['kd_kab'] = $kd_kab;
        $data['kd_prov'] = $kd_prov;
        $q = $this->delete_where($this->tabel_kab, $data);
        if ($q) {
            $ket = 'Menghapus Kecamatan Dengan kode : ' . $kd_kab . ' - ' . $kd_prov;
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    function aksiKecamatan() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $kd_kab = $this->input->post('kd_kab');
        $kd_kec = $this->input->post('kd_kec');
        $nama = strtoupper($this->input->post('nama'));
        $ket = strtoupper($aksi . ' Data Kecamatan Dengan : ' . $kd_kab . '.' . $kd_kec . ' - ' . $nama);
        $data['kd_kab'] = $kd_kab;
        $data['kd_kec'] = $kd_kec;
        $data['nama'] = $nama;
        $data['tipe'] = 'KECAMATAN';
        $q = $this->insert_duplicate($this->tabel_kec, $data);
        if ($q) {
            aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function deleteKecamatan() {
        $kd_kab = $this->input->post('kd_kab');
        $kd_kec = $this->input->post('kd_kec');
        $data['kd_kab'] = $kd_kab;
        $data['kd_kec'] = $kd_kec;
        $q = $this->delete_where($this->tabel_kec, $data);
        if ($q) {
            $ket = 'Menghapus Kecamatan Dengan kode : ' . $kd_kab . ' - ' . $kd_kec;
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function aksiDesa() {
        $url = $this->input->post('url');
        $aksi = $this->input->post('ket');
        $kd_kab = $this->input->post('kd_kab');
        $kd_kec = $this->input->post('kd_kec');
        $kd_desa = $this->input->post('kd_desa');
        $nama = strtoupper($this->input->post('nama'));
        $ket = strtoupper($aksi . ' Data Desa Dengan : ' . $kd_kab . '.' . $kd_kec . '.' . $kd_desa . ' - ' . $nama);
        $data['kd_desa'] = $kd_desa;
        $data['kd_kab'] = $kd_kab;
        $data['kd_kec'] = $kd_kec;
        $data['nama'] = $nama;
        $data['tipe'] = 'DESA';
        $q = $this->insert_duplicate($this->tabel_desa, $data);
        if ($q) {
            aktifitas($ket);
            $this->flashdata($ket, 'Berhasil');
            redirect($url);
        } else {
            $this->flashdata($ket, 'Gagal');
            redirect($url);
        }
    }

    function deleteDesa() {
        $kd_kab = $this->input->post('kd_kab');
        $kd_kec = $this->input->post('kd_kec');
        $kd_desa = $this->input->post('kd_desa');
        $data['kd_kab'] = $kd_kab;
        $data['kd_kec'] = $kd_kec;
        $data['kd_desa'] = $kd_desa;
        $q = $this->delete_where($this->tabel_desa, $data);
        if ($q) {
            $ket = 'Menghapus Data Desa Dengan kode : ' . $kd_kab . ' - ' . $kd_kec.'.'.$kd_desa;
            $this->aktifitas($ket);
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
