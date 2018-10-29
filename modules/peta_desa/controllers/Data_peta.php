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
class Data_peta extends MY_Controller {

//put your code here
    var $a;

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_basis');
        $this->load->model('Model_setting');
        $this->a = aksesLog();
    }

    public function index() {
        $record = $this->javasc_back();
        $kd_kab = isset($_REQUEST['kd_kab']) ? $_REQUEST['kd_kab'] : "";
        $kd_kec = isset($_REQUEST['kd_kec']) ? $_REQUEST['kd_kec'] : "";
        $record['kd_kab'] = $kd_kab;
        $record['kd_kec'] = $kd_kec;
        $record['row_prov'] = $this->Model_basis->get_dataProv();
        $record['get_dataKab'] = $this->Model_basis->get_dataKab()->result();
        $record['get_dataKec'] = $this->Model_basis->get_dataKec()->result();
        $getXml = 'http://www.google.com/maps/d/kml?forcekml=1&mid=1I7IJWHVAW3lS6ifS1aUnFd4STVBZtA69';
        $record['getXml'] = new SimpleXMLElement($getXml, null, true);




        $data = $this->layout_back('peta_desa/maps_desa', $record);
        $data['ribbon'] = ribbon('Peta', 'Peta Desa');
        $this->backend($data);
    }

    function pasingKml() {
        $getXml = 'http://www.google.com/maps/d/kml?forcekml=1&mid=1I7IJWHVAW3lS6ifS1aUnFd4STVBZtA69';
        $record['getXml'] = new SimpleXMLElement($getXml, null, true);
        $getXmlQuery = new SimpleXMLElement($getXml, null, true);
        $arr = array();
        foreach ($getXmlQuery->Document->Folder->Placemark as $key => $value) {
//            $row['koordinat'] = $value->LineString->coordinates;
//            $row['ket'] = $value->description;
            $row[$key]['id'] = $value->name;
            $arr[] = $row;
        }
        echo json_encode($arr);
    }

}
