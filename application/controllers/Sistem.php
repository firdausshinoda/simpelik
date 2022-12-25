<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Sistem extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->model('Mpelayanan');
        $this->load->helper('library_helper');
        if (isset($this->session->userdata['logged_in_superadmin_pelayanan_publik']) == TRUE){
            redirect(base_url('Superadmin'));
        }
        if (isset($this->session->userdata['logged_in_admin_pelayanan_publik']) == TRUE){
            redirect(base_url('aduan'));
        }
    }

    public function coba(){
        $encode =  safe_b64encode("saya");
        $decode = safe_b64decode($encode);
        echo $encode."===".$decode;
    }

    public function index()
    {
        $this->template->login_superadmin('superadmin/login');
    }

    public function admin()
    {
        $this->template->login_admin('admin/login');
    }

    public function sign_in_superadmin()
    {
        $dt = array('username'=>$this->input->post('username'),'password'=>md5($this->input->post('password')));
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_superadmin","id_tb_superadmin","DESC");
        if ($stmt->num_rows()>0) {
            $val=$stmt->row();
            $data_session = array('id_tb_superadmin'=>$val->id_tb_superadmin,'nama_superadmin'=>$val->nama_superadmin,
                'username'=>$val->username,'logged_in_superadmin_pelayanan_publik'=>TRUE);
            $this->session->set_userdata($data_session);
            $dt = array('keterangan'=>"Superadmin sign-in ke aplikasi",
                'id_tb_superadmin'=>"1",'cdate'=>date('Y-m-d H:i:s'),'input_by'=>"1",'input_ket'=>"superadmin");
            $this->log($dt);
            echo "Superadmin";
        } else {
            echo 0;
        }
    }

    public function sign_in_admin()
    {
        $dt = array('username'=>$this->input->post('username'),'password'=>md5($this->input->post('password')));
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","DESC");
        if ($stmt->num_rows()>0) {
            $val=$stmt->row();
            $id_admin=$val->id_tb_admin;
            $data_session = array('id_tb_admin'=>$id_admin,'nama_admin'=>$val->nama_admin,'img_admin'=>$val->img_admin,
                'username'=>$val->username,'logged_in_admin_pelayanan_publik'=>TRUE);
            $this->session->set_userdata($data_session);
            $dt = array('keterangan'=>"Admin sign-in ke aplikasi",
                'id_tb_admin'=>$id_admin,'cdate'=>date('Y-m-d H:i:s'),'input_by'=>$id_admin,'input_ket'=>"admin");
            $this->log($dt);
            echo "Aduan";
        } else {
            echo 0;
        }
    }

    public function recovery_password_superadmin(){
        $dt = array('id_tb_superadmin'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_superadmin","id_tb_superadmin","DESC");
        $data['data']=$stmt->row();
        $this->load->view('superadmin/recovery_password',$data);
    }

    public function log($dt)
    {
        $this->Mpelayanan->input_data("tb_log",$dt);
    }

    public function recovery_password_exe(){
        $dt = array('id_tb_superadmin'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_superadmin","id_tb_superadmin","DESC")->row();
        $date=substr(md5(date('YmdHis')),10,8);

        $email=$this->input->post('email');
        $config = Array('protocol'=>'smtp',
            'smtp_host'=>'ssl://mail.slice-pro.com',
            'smtp_port'=>465,
            'smtp_user'=>'firdausns@slice-pro.com',
            'smtp_pass'=>'@firdaus12345',
            'mailtype'=>'html',
            'charset'=>'iso-8859-1');
        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
        $this->email->from('firdausns@slice-pro.com', 'Pelayanan Publik Kota Tegal');
        $this->email->to($email);
        $this->email->subject('Pemulihan akun pelayanan publik');
        $this->email->message('Silahkan masuk dengan menggunakan username '.$stmt->username." dan dengan password ".$date);

        if ($this->email->send()) {
            $data_where=array('id_tb_superadmin'=>1);
            $data=array('password'=>md5($date));
            $this->Mpelayanan->update_data($data_where,$data,"tb_superadmin");
            echo 1;
        } else {
            echo 0;
        }
    }
}

?>
