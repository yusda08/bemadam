<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_setting
 *
 * @author Asus
 */
class Model_setting extends CI_Model {

    //put your code here
    public function get_setProfilDinas() {
        $query = $this->db->query("select * from profil_dinas");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_ruleMenu($kd_user) {
        $query = $this->db->query("select a.*, b.kd_level, b.nama, b.parent, b.link, b.urutan, b.icon, b.id from menu_role a join menu b on a.id_menu=b.id where a.kd_user=$kd_user order by urutan asc, b.parent asc");
        return $query;
    }

    public function get_slideShow($status = '') {
        if ($status == '') {
            $query = $this->db->query("select * from slide_show a order by id desc");
        } else {
            $query = $this->db->query("select * from slide_show a where a.`status`='$status' order by id asc");
        }
        return $query;
    }
    
    public function get_slideShowWhereId($id) {
        $query = $this->db->query("select * from slide_show where id=$id");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

}
