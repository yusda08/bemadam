<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Laporan_desaPdf
 *
 * @author Asus
 */
class Laporan_desaPdf extends MY_Controller {

    //put your code here
    var $a;
    private $constructor = [
        'mode' => 'utf-8',
        'format' => 'Legal-L',
        'default_font_size' => 1,
        'default_font' => 'Tahoma',
        'margin_left' => 8,
        'margin_right' => 30,
        'margin_top' => 8,
        'margin_bottom' => 8,
        'margin_header' => 8,
        'margin_footer' => 8,
        'orientation' => 'L',
    ];
    private $mpdfPot = '';
    private $mpdfLans = '';

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_penilaian');
        $this->load->model('Model_basis');
        $this->load->model('Model_setting');
        $this->a = aksesLog();
        $this->mpdf = new \Mpdf\Mpdf($this->constructor);
    }

    public function index() {
        $record = $this->javasc_back();
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_statusIdm'] = $this->Model_basis->get_statusIdm()->result();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $record['get_dataKec'] = $this->Model_basis->get_dataKec()->result();
        $data = $this->layout_back('laporan/filter_desa', $record);
        $data['ribbon'] = ribbon('Laporan', 'Laporan Data Desa');
        $this->backend($data);
    }

    //put your code here
    public function data_desaPdf() {
        $pdfFilePath = "data_desa.pdf";
        //record
        $row_prov = $this->Model_basis->get_dataProv();
        $kd_kab = isset($_REQUEST['kd_kab']) ? $_REQUEST['kd_kab'] : "";
        $kd_kec = isset($_REQUEST['kd_kec']) ? $_REQUEST['kd_kec'] : "";

        $record['kd_kab'] = $kd_kab;
        $record['kd_kec'] = $kd_kec;

        if (empty($kd_kab) and empty($kd_kec)) {
            $record['pageText'] = '<u>Data Seluruh Desa Se-Kalimantan Selatan</u>';
        } elseif (!empty($kd_kab) and empty($kd_kec)) {
            $row_kab = $this->Model_basis->get_dataKab($kd_kab);
            $record['pageText'] = '<u>Data Seluruh Desa di Kabupaten ' . $row_kab->nama . '</u>';
        } elseif (!empty($kd_kab) and ! empty($kd_kec)) {
            $row_kab = $this->Model_basis->get_dataKab($kd_kab)->row();
            $row_kec = $this->Model_basis->get_dataKecWhereKd($row_prov->kd_prov, $kd_kab, $kd_kec);
            $record['pageText'] = '<u>Data Desa di Kabupaten ' . $row_kab->nama . ' ' . $row_kec->tipe . ' ' . $row_kec->nama . '</u>';
        }

        //data
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $record['get_dataKec'] = $this->Model_basis->get_dataKec()->result();
        $record['get_dataDesa'] = $this->Model_basis->get_dataDesa()->result();
        $record['row_pro'] = $this->Model_setting->get_setProfilDinas();
        $data['titel'] = $pdfFilePath;
        $data['content'] = $this->load->view('laporan/data_desa', $record, TRUE);
        $htmlMpdf = $this->load->view('back/paper', $data, TRUE);

//        $this->mpdf->SetHTMLFooter('<table width="100%" border="0" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
//<td width="" style="border-right: 0px ;"><span style="font-weight: bold; font-style: italic;">Print By ' . base_url() . ' Tanggal {DATE d F Y}</span></td>
//<td width="10%" align="center" style="font-weight: bold; font-style: italic;border-right: 0px ;"></td>
//</tr></table>');
        $htmlMpdf = mb_convert_encoding($htmlMpdf, 'UTF-8', 'UTF-8');
//        $this->mpdf->showImageErrors = true;
//        $this->mpdf->debug = true;
        $this->mpdf->WriteHTML($htmlMpdf);
        $this->mpdf->Output($pdfFilePath, "I");
    }

    function contohImg() {
        $html = "<img src='https://www.google.pl/images/srpr/logo11w.png' alt=''>";
        $this->mpdf->WriteHTML($html);
        $this->mpdf->debug = true;
        $output = $this->mpdf->Output();
        exit();
    }

}
