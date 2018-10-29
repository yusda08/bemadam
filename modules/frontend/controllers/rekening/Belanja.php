<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Belanja
 *
 * @author Asus
 */
class Belanja extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_belanja');
    }

    public function index() {
        $record = $this->javasc_front();


        $data = $this->layout_front('rekening/belanja', $record);
        $data['ribbon'] = ribbon('Rekening', 'Belanja');
        $this->frontend($data);
    }

    public function ajax_list() {
        $list = $this->Model_belanja->get_datatables();
        $data = array();
        $no = $_GET['start'];
        foreach ($list as $row_data) {
            $row = array();
            $row[] = $row_data->id_level_1 . '.' . $row_data->id_level_2 . '.' . $row_data->id_level_3 . '.' . $row_data->id_level_4 . '.' . $row_data->id_level_5;
            $row[] = $row_data->belanja;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $this->Model_belanja->count_all(),
            "recordsFiltered" => $this->Model_belanja->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
