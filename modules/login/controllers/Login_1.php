<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    var $a;

    public function __construct() {
        parent::__construct();
        $this->a = aksesLog();
        $this->load->model('Model_setting');
    }

    public function index() {
        if ($this->a) {
            $p = penilaianIdm();
            if (is_null($p)) {
                $kd_user = $this->a['kd_user'];
                if ($kd_user == 1) {
                    redirect('database/Data_penilaian/inputPenilaianTahun');
                } else {
                    echo "<script>
                        alert('Data Penilaian Tahun Anggaran yang dipilih belum di Input, Silahkan Hubungi Administrator Untuk Menginput Data Tersebut Terimakasih . . . ');
                        window.location.href='login/Login/logout/$kd_user';
                        </script>";

//                    redirect($this->logout($this->a['kd_user']));
                }
            } else {
                redirect('home/Home');
            }
        } else {
            $req['row_din'] = $this->Model_setting->get_setProfilDinas();
            $req['get_slideShow'] = $this->Model_setting->get_slideShow('Y')->result();
            $this->load->view('form_login', $req);
        }
    }

    public function validasi() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $tahun = $this->input->post('tahun');
        $url = $this->input->post('url');
        $row = $this->Model_Auth->validate_login($username, $password);
        if ($row) {
            $is_active = $row->is_active;
            if ($is_active == 1) {
                $data = array(
                    'tahun' => $tahun,
                    'kd_user' => $row->kd_user,
                    'username' => $row->username,
                    'password' => $row->password,
                    'nama_user' => $row->nama_user,
                    'foto' => $row->foto,
                    'kd_level' => $row->kd_level,
                    'last_login_dt' => $row->last_login_dt,
                    'last_login_tm' => $row->last_login_tm,
                    'ket_level' => $row->ket_level,
                    'email' => $row->email,
                    'no_telpon' => $row->no_telpon,
                    'is_login' => true
                );

                $this->session->set_userdata('is_logined', $data);
                $d['is_login'] = 1;
                $this->update('kd_user', $row->kd_user, 'user', $d);
                $ket = 'Login';
                $this->aktifitas($ket);
//                redirect('login/Login');
                echo "<script>
                        alert('Username dan Password yang anda masukan Benar Silahkan Tekan Tombol Oke Untuk Melanjutkan Login ');
                        window.location.href='home/Home';
                        </script>";
            } else {
                echo "<script>
                        alert('Status Anda Tidak AKtif');
                        window.location.href='login/Login';
                        </script>";
            }
        } else {  //username atau password salah
            echo "<script>
                        alert('Username dan Password yang anda masukan Tidak Tepat');
                        window.location.href='login/Login';
                        </script>";
        }
    }

    function logout($kd_user) {
        $ket = 'Logout';
        $this->aktifitas($ket);
        $data['last_login_dt'] = date('Y-m-d');
        $data['last_login_tm'] = date('H:i:s');
        $data['is_login'] = 0;
        $this->update('kd_user', $kd_user, 'user', $data);
        $this->session->unset_userdata('is_logined');
        redirect('login/Login');
    }

    function lock_screen($kd_user) {
        if ($this->a) {
            $ket = 'Lock Screen';
            $this->aktifitas($ket);
        }
        $data['is_login'] = 0;
        $req['tahun'] = $_GET['tahun'];
        $this->update('kd_user', $kd_user, 'user', $data);
        $req['kd_user'] = $kd_user;
        $req['row_user'] = $this->Model_Auth->get_user($kd_user)->row();
        $this->session->unset_userdata('is_logined');
        $this->load->view('back/lock_screen', $req);
    }

}
