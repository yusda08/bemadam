<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_penilaian
 *
 * @author Asus
 */
class Model_penilaian extends CI_Model {

    //put your code here
    private $pesanBaik = 'BAIK';
    private $pesanSedang = 'SEDANG';
    private $pesanRendah = 'RENDAH';
    private $pesanBelum = 'Belum Terdata';


    public function get_penilaianDesaMandiri($kd_kab, $kd_kec, $tahun) {
        $nilai = penilaianIdm();
        $id_status = $nilai['id_status'];
        $query = $this->db->query("select b.*, a.tahun,  c.jml_bid, d.jml_keg, if(c.jml_bid>=4 and d.jml_keg>=4, '$this->pesanBaik', 
if(c.jml_bid>=3 and d.jml_keg>=3 , '$this->pesanSedang', if(c.jml_bid<=3 and d.jml_keg<=3, '$this->pesanRendah', '$this->pesanBelum'))) as status_desa, z.status
from ref_desa b
join data_idm z on z.kd_prov=b.kd_prov and z.kd_kab=b.kd_kab and b.kd_kec=z.kd_kec and b.kd_desa=z.kd_desa and z.`status`=$id_status
left join data_desa_mandiri a  on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec 
and a.kd_desa=b.kd_desa  and a.tahun=$tahun 
left join (select a.*, count(distinct b.kd_bid) jml_bid from data_desa_mandiri a join ref_kegiatan b on a.kd_keg=b.kd_keg 
and a.kd_prog=b.kd_prog group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) as c on c.kd_keg=a.kd_keg 
and a.kd_prog=c.kd_prog and a.kd_prov=c.kd_prov and a.kd_kab=c.kd_kab and a.kd_kec=c.kd_kec and a.kd_desa=c.kd_desa
left join (select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun, count(a.kd_keg) as jml_keg from data_desa_mandiri a 
group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) d on a.kd_prov=d.kd_prov and a.kd_kab=d.kd_kab 
and a.kd_kec=d.kd_kec and a.kd_desa=d.kd_desa 
where b.kd_kab=$kd_kab and b.kd_kec=$kd_kec
group by b.kd_prov, b.kd_kab, b.kd_kec, b.kd_desa");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_bidangDesa($kd_kab, $kd_kec, $kd_desa, $tahun) {
        $query = $this->db->query("select c.* from data_desa_mandiri a 
join ref_kegiatan b on a.kd_keg=b.kd_keg and a.kd_prog=b.kd_prog
join ref_sotk_bidang c on b.kd_bid=c.kd_bid where a.kd_kab=$kd_kab and a.kd_kec=$kd_kec and a.kd_desa=$kd_desa and a.tahun=$tahun group by c.kd_bid;");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_kegiatanDesa($kd_kab, $kd_kec, $kd_desa, $tahun) {
        $query = $this->db->query("select * from data_desa_mandiri a 
join ref_kegiatan b on a.kd_keg=b.kd_keg and a.kd_prog=b.kd_prog where a.kd_kab=$kd_kab and a.kd_kec=$kd_kec and a.kd_desa=$kd_desa and a.tahun=$tahun and b.tahun=$tahun");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_penilaianIdm($kd_kab = '', $tahun) {
        $nilai = penilaianIdm();
        $tertinggal = $nilai['tertinggal'];
        $berkembang = $nilai['berkembang'];
        $maju = $nilai['maju'];
        if ($kd_kab == '') {
            $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, 
            round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm, if(((a.iks+a.ike+a.ikl)/3)>0 and ((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) as status, a.`status` as sttsIdm  from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
where b.tipe='DESA' order by b.kd_kab, b.kd_kec, b.kd_desa");
        } else {
            $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, 
            round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm, if(((a.iks+a.ike+a.ikl)/3)>0 and ((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) as status, a.`status` as sttsIdm  from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
where b.kd_kab=$kd_kab and b.tipe='DESA' order by b.kd_kab, b.kd_kec, b.kd_desa");
        }
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_penilaianIdmWhere($kd_prov, $kd_kab, $kd_kec, $kd_desa, $tahun) {
        $nilai = penilaianIdm();
        $tertinggal = $nilai['tertinggal'];
        $berkembang = $nilai['berkembang'];
        $maju = $nilai['maju'];
        $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, 
            round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm, if(((a.iks+a.ike+a.ikl)/3)>0 and ((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) as status from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
where b.kd_prov=$kd_prov and b.kd_kab=$kd_kab and b.kd_kec=$kd_kec and b.kd_desa=$kd_desa and b.tipe='DESA' order by b.kd_kab, b.kd_kec, b.kd_desa");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_penilaianIdmFilter($kd_kab = '', $tahun, $filter) {
        $nilai = penilaianIdm();
        $tertinggal = $nilai['tertinggal'];
        $berkembang = $nilai['berkembang'];
        $maju = $nilai['maju'];
        if ($kd_kab == '') {
            $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, 
            round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm, if(((a.iks+a.ike+a.ikl)/3)>0 and ((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) as status, a.`status` as sttsIdm  from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
having b.tipe='DESA' and status='$filter'  order by b.kd_kab, b.kd_kec, b.kd_desa");
        } else {
            $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, 
            round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm, if(((a.iks+a.ike+a.ikl)/3)>0 and ((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) as status, a.`status` as sttsIdm  from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
having b.kd_kab=$kd_kab and b.tipe='DESA' and status='$filter'  order by b.kd_kab, b.kd_kec, b.kd_desa");
        }
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_jmlMandiri($kd_kab, $tahun) {
        $nilai = penilaianIdm();
        $tertinggal = $nilai['tertinggal'];
        $berkembang = $nilai['berkembang'];
        $maju = $nilai['maju'];
        $query = $this->db->query("select b.kd_desa, b.kd_kec, b.kd_kab, b.kd_prov,
sum(case when status_desa='$this->pesanBaik' then 1 else 0 end) jml_baik,
sum(case when status_desa='$this->pesanSedang' then 1 else 0 end) jml_sedang,
sum(case when status_desa='$this->pesanRendah' then 1 else 0 end) jml_rendah,
sum(case when ((a.iks+a.ike+a.ikl)/3)>=$maju then 1 else 0 end) jml_mandiri, 
sum(case when ((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<0.8156 then 1 else 0 end) jml_maju,
sum(case when ((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<0.7073 then 1 else 0 end) jml_berkembang,
sum(case when ((a.iks+a.ike+a.ikl)/3)<$tertinggal then 1 else 0 end) jml_tertinggal 
from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
left join 
(select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun,  c.jml_bid, d.jml_keg,
if(c.jml_bid>=4 and d.jml_keg>=4, '$this->pesanBaik', 
if(c.jml_bid>=3 and d.jml_keg>=3 , '$this->pesanSedang', if(c.jml_bid<=3 and d.jml_keg<=3, '$this->pesanRendah', '$this->pesanBelum'))) as status_desa
 from data_desa_mandiri a 
left join ref_desa b on a.kd_prov=b.kd_prov 
and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa
join (select a.*, count(distinct b.kd_bid) jml_bid from data_desa_mandiri a join ref_kegiatan b on a.kd_keg=b.kd_keg 
and a.kd_prog=b.kd_prog group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) as c on c.kd_keg=a.kd_keg 
and a.kd_prog=c.kd_prog and a.kd_prov=c.kd_prov and a.kd_kab=c.kd_kab and a.kd_kec=c.kd_kec and a.kd_desa=c.kd_desa
join (select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun, count(a.kd_keg) as jml_keg from data_desa_mandiri a 
group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) d on a.kd_prov=d.kd_prov and a.kd_kab=d.kd_kab 
and a.kd_kec=d.kd_kec and a.kd_desa=d.kd_desa) 
e on e.kd_prov=b.kd_prov and b.kd_kab=e.kd_kab and b.kd_kec=e.kd_kec and b.kd_desa=e.kd_desa and e.tahun=$tahun
group by b.kd_prov, b.kd_kab
having b.kd_kab=$kd_kab order by b.kd_kab, b.kd_kec, b.kd_desa;");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_viewDesaNilai($kd_kab = '', $tahun) {
        $nilai = penilaianIdm();
        $tertinggal = $nilai['tertinggal'];
        $berkembang = $nilai['berkembang'];
        $maju = $nilai['maju'];
        if ($kd_kab == '') {
            $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm,
case status_desa 
when 'Mandiri' then status_desa
else if(((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', 
if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) 
end as stts_desa,
a.`status` as sttsIdm, e.jml_bid, e.jml_keg  from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
left join 
(select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun,  c.jml_bid, d.jml_keg,
if(c.jml_bid>=4 and d.jml_keg>=4, '$this->pesanBaik', 
if(c.jml_bid>=3 and d.jml_keg>=3 , '$this->pesanSedang', if(c.jml_bid<=3 and d.jml_keg<=3, '$this->pesanRendah', '$this->pesanBelum'))) as status_desa
 from data_desa_mandiri a 
left join ref_desa b on a.kd_prov=b.kd_prov 
and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa
join (select a.*, count(distinct b.kd_bid) jml_bid from data_desa_mandiri a join ref_kegiatan b on a.kd_keg=b.kd_keg 
and a.kd_prog=b.kd_prog group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) as c on c.kd_keg=a.kd_keg 
and a.kd_prog=c.kd_prog and a.kd_prov=c.kd_prov and a.kd_kab=c.kd_kab and a.kd_kec=c.kd_kec and a.kd_desa=c.kd_desa
join (select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun, count(a.kd_keg) as jml_keg from data_desa_mandiri a 
group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) d on a.kd_prov=d.kd_prov and a.kd_kab=d.kd_kab 
and a.kd_kec=d.kd_kec and a.kd_desa=d.kd_desa) 
e on e.kd_prov=b.kd_prov and b.kd_kab=e.kd_kab and b.kd_kec=e.kd_kec and b.kd_desa=e.kd_desa and e.tahun=$tahun
where b.tipe='DESA' order by b.kd_kab, b.kd_kec, b.kd_desa");
        } else {
            $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm,
case status_desa 
when 'Mandiri' then status_desa
else if(((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', 
if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) 
end as stts_desa,
a.`status` as sttsIdm, e.jml_bid, e.jml_keg  from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
left join 
(select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun,  c.jml_bid, d.jml_keg,
if(c.jml_bid>=4 and d.jml_keg>=4, '$this->pesanBaik', 
if(c.jml_bid>=3 and d.jml_keg>=3 , '$this->pesanSedang', if(c.jml_bid<=3 and d.jml_keg<=3, '$this->pesanRendah', '$this->pesanBelum'))) as status_desa
 from data_desa_mandiri a 
left join ref_desa b on a.kd_prov=b.kd_prov 
and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa
join (select a.*, count(distinct b.kd_bid) jml_bid from data_desa_mandiri a join ref_kegiatan b on a.kd_keg=b.kd_keg 
and a.kd_prog=b.kd_prog group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) as c on c.kd_keg=a.kd_keg 
and a.kd_prog=c.kd_prog and a.kd_prov=c.kd_prov and a.kd_kab=c.kd_kab and a.kd_kec=c.kd_kec and a.kd_desa=c.kd_desa
join (select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun, count(a.kd_keg) as jml_keg from data_desa_mandiri a 
group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) d on a.kd_prov=d.kd_prov and a.kd_kab=d.kd_kab 
and a.kd_kec=d.kd_kec and a.kd_desa=d.kd_desa) 
e on e.kd_prov=b.kd_prov and b.kd_kab=e.kd_kab and b.kd_kec=e.kd_kec and b.kd_desa=e.kd_desa and e.tahun=$tahun
where b.kd_kab=$kd_kab and b.tipe='DESA' order by b.kd_kab, b.kd_kec, b.kd_desa");
        }
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_viewDesaNilaiFilter($kd_kab = '', $tahun, $filter) {
        $nilai = penilaianIdm();
        $tertinggal = $nilai['tertinggal'];
        $berkembang = $nilai['berkembang'];
        $maju = $nilai['maju'];
        if ($kd_kab == '') {
            $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm,
case status_desa 
when 'Mandiri' then status_desa
else if(((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', 
if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) 
end as stts_desa,
a.`status` as sttsIdm, e.jml_bid, e.jml_keg  from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
left join 
(select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun,  c.jml_bid, d.jml_keg,
if(c.jml_bid>=4 and d.jml_keg>=4, '$this->pesanBaik', 
if(c.jml_bid>=3 and d.jml_keg>=3 , '$this->pesanSedang', if(c.jml_bid<=3 and d.jml_keg<=3, '$this->pesanRendah', '$this->pesanBelum'))) as status_desa
 from data_desa_mandiri a 
left join ref_desa b on a.kd_prov=b.kd_prov 
and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa
join (select a.*, count(distinct b.kd_bid) jml_bid from data_desa_mandiri a join ref_kegiatan b on a.kd_keg=b.kd_keg 
and a.kd_prog=b.kd_prog group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) as c on c.kd_keg=a.kd_keg 
and a.kd_prog=c.kd_prog and a.kd_prov=c.kd_prov and a.kd_kab=c.kd_kab and a.kd_kec=c.kd_kec and a.kd_desa=c.kd_desa
join (select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun, count(a.kd_keg) as jml_keg from data_desa_mandiri a 
group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) d on a.kd_prov=d.kd_prov and a.kd_kab=d.kd_kab 
and a.kd_kec=d.kd_kec and a.kd_desa=d.kd_desa) 
e on e.kd_prov=b.kd_prov and b.kd_kab=e.kd_kab and b.kd_kec=e.kd_kec and b.kd_desa=e.kd_desa and e.tahun=$tahun
having b.tipe='DESA' and stts_desa='$filter' order by b.kd_kab, b.kd_kec, b.kd_desa");
        } else {
            $query = $this->db->query("select b.*, c.nama as nm_kec, d.nama as nm_kab, a.tahun, a.iks, a.ike, a.ikl, round((a.iks+a.ike+a.ikl)/3, 4) as jml_idm,
case status_desa 
when 'Mandiri' then status_desa
else if(((a.iks+a.ike+a.ikl)/3)<$tertinggal, 'Tertinggal',
if(((a.iks+a.ike+a.ikl)/3)>=$tertinggal and ((a.iks+a.ike+a.ikl)/3)<$berkembang, 'Berkembang', 
if(((a.iks+a.ike+a.ikl)/3)>=$berkembang and ((a.iks+a.ike+a.ikl)/3)<$maju,'Maju', 
if(((a.iks+a.ike+a.ikl)/3)>=$maju, 'Mandiri', 'Belum Terdata')))) 
end as stts_desa,
a.`status` as sttsIdm, e.jml_bid, e.jml_keg  from ref_desa b 
left join ref_kab d on d.kd_prov=b.kd_prov and d.kd_kab=b.kd_kab    
left join ref_kec c on c.kd_prov=b.kd_prov and c.kd_kab=b.kd_kab and c.kd_kec=b.kd_kec
left join data_idm a on a.kd_prov=b.kd_prov and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa and a.tahun=$tahun
left join 
(select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun,  c.jml_bid, d.jml_keg,
if(c.jml_bid>=4 and d.jml_keg>=4, '$this->pesanBaik', 
if(c.jml_bid>=3 and d.jml_keg>=3 , '$this->pesanSedang', if(c.jml_bid<=3 and d.jml_keg<=3, '$this->pesanRendah', '$this->pesanBelum'))) as status_desa
 from data_desa_mandiri a 
left join ref_desa b on a.kd_prov=b.kd_prov 
and a.kd_kab=b.kd_kab and a.kd_kec=b.kd_kec and a.kd_desa=b.kd_desa
join (select a.*, count(distinct b.kd_bid) jml_bid from data_desa_mandiri a join ref_kegiatan b on a.kd_keg=b.kd_keg 
and a.kd_prog=b.kd_prog group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) as c on c.kd_keg=a.kd_keg 
and a.kd_prog=c.kd_prog and a.kd_prov=c.kd_prov and a.kd_kab=c.kd_kab and a.kd_kec=c.kd_kec and a.kd_desa=c.kd_desa
join (select a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa, a.tahun, count(a.kd_keg) as jml_keg from data_desa_mandiri a 
group by a.kd_prov, a.kd_kab, a.kd_kec, a.kd_desa) d on a.kd_prov=d.kd_prov and a.kd_kab=d.kd_kab 
and a.kd_kec=d.kd_kec and a.kd_desa=d.kd_desa) 
e on e.kd_prov=b.kd_prov and b.kd_kab=e.kd_kab and b.kd_kec=e.kd_kec and b.kd_desa=e.kd_desa and e.tahun=$tahun
having b.kd_kab=$kd_kab and b.tipe='DESA' and stts_desa='$filter' order by b.kd_kab, b.kd_kec, b.kd_desa");
        }
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

}
