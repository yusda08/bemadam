<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_Auth
 *
 * @author Asus
 */
class Model_Auth extends CI_Model {

    //put your code here
    public function validate_login($username, $password) {
        $query = $this->db->query("select a.*, b.kd_level, b.id, c.ket_level from user a 
            join user_group b on a.kd_user=b.kd_user 
            join user_level c on c.kd_level=b.kd_level
            where a.username='$username' and a.password='$password'");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function get_levelUser() {
        $query = $this->db->query("select * from user_level");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
    
    public function get_user($kd_user = '') {
        if($kd_user === ''){
        $query = $this->db->query("select a.*, b.kd_level, b.id, c.ket_level from user a 
            join user_group b on a.kd_user=b.kd_user 
            join user_level c on c.kd_level=b.kd_level");
        }else{
        $query = $this->db->query("select a.*, b.kd_level, b.id, c.ket_level from user a 
            join user_group b on a.kd_user=b.kd_user 
            join user_level c on c.kd_level=b.kd_level
            where a.kd_user='$kd_user'");
        }
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
    
    public function maxUser() {
        $query = $this->db->query("select max(kd_user)+1 jml_user from user");
        if ($query) {
            return $query->row()->jml_user;
        } else {
            return false;
        }
    }

    public function aktifitas($data) {
        $query = $this->db->order_by('tanggal', 'desc')->order_by('jam', 'desc')->get_where('aktifitas', $data);
        return $query;
    }
    
    function get_menu() {
        $query = $this->db->query("SELECT b.*, if(b.link = '#', (select COUNT(parent) from menu a where a.parent=b.id), 0) as jml_menu FROM menu b order by parent, urutan asc ");
        return $query;
    }
    function get_menuAkses($kd_user) {
        $query = $this->db->query("SELECT b.*
FROM menu b where id in(select id_menu from menu_role a where a.kd_user=$kd_user) order by parent, urutan asc ");
        return $query;
    }

    function update_urutanTambah($urutan, $parent) {
        $query = $this->db->query("update menu a, (select urutan+1 as urutan, id from menu where urutan >=$urutan and parent = $parent) as r set a.urutan = r.urutan where a.id=r.id");
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function update_urutanEditMin($parent, $urutan, $urutan_edit) {
        $urutan_plus = $urutan_edit+1;
        $query = $this->db->query("update menu a set a.urutan = a.urutan-1 where a.parent=$parent and  a.urutan BETWEEN $urutan_plus and $urutan ");
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function update_urutanEditPlus($parent, $urutan, $urutan_edit) {
        $urutan_min = $urutan_edit-1;
        $query = $this->db->query("update menu a set a.urutan = a.urutan+1 where a.parent=$parent and a.urutan BETWEEN $urutan and $urutan_min");
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function update_urutanHapus($parent, $urutan) {
        $urutan_min = $urutan_edit-1;
        $query = $this->db->query("update menu a, (select urutan-1 as urutan, id from menu where urutan >= $urutan and parent = $parent) as r set a.urutan = r.urutan where a.id=r.id;");
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
