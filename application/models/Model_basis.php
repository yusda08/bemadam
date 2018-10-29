<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_basis
 *
 * @author Asus
 */
class Model_basis extends CI_Model {

    //put your code here
    public function get_dataProv() {
        $query = $this->db->query("select * from ref_prov");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_dataKab($kd_kab = '') {
        if ($kd_kab == '') {
            $query = $this->db->query("select * from ref_kab order by kd_kab asc");
        } else {
            $query = $this->db->query("select * from ref_kab where kd_kab=$kd_kab order by kd_kab asc");
        }
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_penilaianIdm($tahun = '') {
        if ($tahun == '') {
            $query = $this->db->query("select a.*, b.nama_status from ref_penilaian_idm a join ref_status b on a.id_status=b.id order by tahun");
        } else {
            $query = $this->db->query("select a.*, b.nama_status from ref_penilaian_idm a join ref_status b on a.id_status=b.id where tahun=$tahun order by tahun");
        }
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_settingStatus($tahun = '') {
        if ($tahun == '') {
            $query = $this->db->query("select a.tahun, a.id_status, b.nama_status from set_status a join ref_status b on a.id_status=b.id");
        } else {
            $query = $this->db->query("select a.tahun, a.id_status, b.nama_status from set_status a join ref_status b on a.id_status=b.id where a.tahun=$tahun");
        }
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataKec() {
        $query = $this->db->query("select * from ref_kec order by kd_kab, kd_kec asc");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataKecWhereKd($kd_prov, $kd_kab, $kd_kec) {
        $query = $this->db->query("select * from ref_kec where kd_prov=$kd_prov and kd_kab=$kd_kab and kd_kec=$kd_kec order by kd_kab, kd_kec asc");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function maxKec($kd_kab) {
        $query = $this->db->query("select if(max(kd_kec)=0,'1',max(kd_kec)+1) as jml from ref_kec where kd_kab=$kd_kab");
        if ($query) {
            return $query->row()->jml;
        } else {
            return false;
        }
    }

    public function maxKab() {
        $query = $this->db->query("select if(max(kd_kab)=0,'1',max(kd_kab)+1) as jml from ref_kab");
        if ($query) {
            return $query->row()->jml;
        } else {
            return false;
        }
    }

    public function maxDesa($kd_kab, $kd_kec) {
        $query = $this->db->query("select if(max(kd_desa)=0,'1',max(kd_desa)+1) as jml from ref_desa where kd_kab=$kd_kab and kd_kec=$kd_kec");
        if ($query) {
            return $query->row()->jml;
        } else {
            return false;
        }
    }

    public function get_dataKecWhereKdKab($kd_kab) {
        $query = $this->db->query("select * from ref_kec where kd_kab=$kd_kab order by kd_kab, kd_kec asc");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataDesa() {
        $query = $this->db->query("select * from ref_desa order by kd_kab, kd_kec, kd_desa asc");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataDesaWhereKd($kd_kab, $kd_kec, $kd_desa) {
        $query = $this->db->query("select * from ref_desa where kd_kab=$kd_kab and kd_kec=$kd_kec and kd_desa=$kd_desa order by kd_kab, kd_kec, kd_desa asc");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataBidang() {
        $query = $this->db->query("select * from ref_sotk_bidang");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataSubBidang() {
        $query = $this->db->query("select * from ref_sotk_sub_bidang");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataProgram($tahun) {
        $query = $this->db->query("select a.*, b.nama_jabatan from ref_program a join ref_sotk_bidang b on a.kd_bid=b.kd_bid where tahun=$tahun order by kd_int asc");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataProgramWhereTahun($tahun) {
        $query = $this->db->query("select * from ref_program a where tahun=$tahun");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function maxProg($tahun) {
        $query = $this->db->query("select if(isnull(max(kd_prog)),'1',max(kd_prog)+1) as jml from ref_program where tahun=$tahun");
        if ($query) {
            return $query->row()->jml;
        } else {
            return false;
        }
    }

    public function get_dataKegiatan($tahun) {
        $query = $this->db->query("select a.*, b.nama_jabatan from ref_kegiatan a 
left join ref_sotk_sub_bidang b on a.kd_sub=b.kd_sub where tahun=$tahun");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_dataKegiatanWhereTahun($tahun) {
        $query = $this->db->query("select * from ref_kegiatan a where tahun=$tahun");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function maxKeg($tahun, $kd_prog) {
        $query = $this->db->query("select if(isnull(max(kd_keg)),'1',max(kd_keg)+1) as jml from ref_kegiatan where tahun=$tahun and kd_prog='$kd_prog'");
        if ($query) {
            return $query->row()->jml;
        } else {
            return false;
        }
    }

    public function get_kabJmlDesa() {
        $query = $this->db->query("select aa.kd_kab, bb.nama, count(aa.kd_kab) as jml_desa from ref_desa aa join ref_kab bb on aa.kd_kab=bb.kd_kab where aa.tipe='DESA' group by aa.kd_kab");
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_statusIdm($id = '') {
        if ($id == '') {
            $query = $this->db->query("select * from ref_status order by id asc");
        } else {
            $query = $this->db->query("select * from ref_status where id=$id order by id asc");
        }
        return $query;
    }

}
