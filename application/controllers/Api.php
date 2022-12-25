<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Api extends CI_Controller
{

    public $result = array();
    public $result2 = array();
    public $result3 = array();

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mpelayanan');
        $this->load->helper('library_helper');
    }


    //-------------------------------user----------------------------------------

    public function cari_nik_kk()
    {
        $this->nik;
        $nik = $this->input->post('no_nik');
        $kk = $this->input->post('no_kk');
        $dt = array('no_nik'=>$nik,'no_kk'=>$kk);
        $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_masyarakat','id_tb_masyarakat','DESC');
        if ($stmt->num_rows() > 0) {
            foreach ($stmt->result() as $val) {
                array_push($this->result,array('status'=>"1",'no_nik'=>$val->no_nik,'no_kk'=>$val->no_kk,'nama_user'=>$val->nama));
            }
        } else {
            array_push($this->result,array('status'=>"0",'no_nik'=>"",'no_kk'=>"",'nama_user'=>""));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function cari_user()
    {
        $nik = $this->input->post('no_nik');
        $kk = $this->input->post('no_kk');
        $dt = array('no_nik'=>$nik,'no_kk'=>$kk);
        $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_user','id_tb_user','DESC');
        if ($stmt->num_rows() > 0) {
            foreach ($stmt->result() as $val) {
                array_push($this->result,array('status'=>"1",'id_tb_user'=>$val->id_tb_user,'no_nik'=>$val->no_nik,'no_kk'=>$val->no_kk,'nama_user'=>$val->nama_user,'username'=>$val->username));
            }
        } else {
            array_push($this->result,array('status'=>"0",'id_tb_user'=>"",'no_nik'=>"",'no_kk'=>"",'nama_user'=>"",'username'=>""));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function sign_up()
    {
        $date=date('Y-m-d H:i:s');
        $dt = array('no_nik'=>$this->input->post('no_nik'),
            'no_kk'=>$this->input->post('no_kk'),
            'nama_user'=>$this->input->post('nama_user'),
            'username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password')),
            'cdate'=>$this->input->post('cdate'),
            'input_ket'=>$this->input->post('input_ket'));
        $stmt = $this->Mpelayanan->input_data_returnId('tb_user',$dt);
        if ($stmt) {
            $dt = array('id_tb_user'=>$stmt);
            $dt = array('input_by'=>$stmt);
            $dt_where=array('id_tb_user'=>$stmt);
            $this->Mpelayanan->update_data($dt_where,$dt,"tb_user");
            $dt = array('keterangan'=>"Pengguna masyarakat baru",'id_tb_user'=>$stmt,'cdate'=>$date,'input_by'=>$stmt,
                'input_ket'=>"user");
            $this->log($dt);
            array_push($this->result,array('status'=>"1"));
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function inputRegister()
    {
        $dt = array('username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password')),
            'deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_user','id_tb_user','DESC');
        if ($stmt->num_rows() > 0) {
            array_push($this->result,array('status'=>"1"));
            $id = $stmt->row()->id_tb_user;
            $dt = array('keterangan'=>"Pengguna masyarakat sign-in ke aplikasi",
                'id_tb_user'=>$id,'cdate'=>date('Y-m-d H:i:s'),'input_by'=>$id,'input_ket'=>"user");
            $this->log($dt);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result,'result2' => $stmt->result());
        $this->setJSON($response);
    }

    public function getAduanListAPI()
    {
        $id_user="";
        $id_tb_user_2="";
        $type=$this->input->post('type');
        $dari=$this->input->post('dari');
        $status=$this->input->post('status');
        if ($type=="all") {
            $id_tb_user_2=$this->input->post('id_tb_user');
        } else if ($type=="profil") {
            $id_tb_user=$this->input->post('id_tb_user');
            $id_tb_user_2=$id_tb_user;
            $id_user=$id_tb_user;
        }
        $stmt=$this->Mpelayanan->getDataAduanListAPI("",$id_user,"",$status,$dari);
        $result2=array();
        $no=0;
        foreach ($stmt->result() as $value) {
            $no++;
            $dt_1=array('id_tb_aduan'=>$value->id_tb_aduan,'deleted_flage'=>"1");
            $dt_2=array('id_tb_aduan'=>$value->id_tb_aduan,'id_tb_user'=>$id_tb_user_2,
                'deleted_flage'=>"1");
            $ttl_koment=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
            $ttl_like=$this->Mpelayanan->getDataDetail($dt_1,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
            $stmt_2=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
            $like=$this->Mpelayanan->getDataDetail($dt_2,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
            if ($like>0) { $stt=true; }
            else { $stt=false; }
            $result2[$no]=array();
            foreach ($stmt_2->result() as $value_2) {
                array_push($result2[$no],array('img_gallery_aduan'=>$value_2->img_gallery_aduan));
            }
            array_push($this->result,array('id_tb_user'=>$value->id_tb_user,'id_tb_aduan'=>$value->id_tb_aduan,
                'isi_aduan'=>$value->isi_aduan,
                'nama_user'=>$value->nama_user,'img_user'=>$value->img_user,'nama_admin'=>$value->nama_admin,
                'cdate'=>$value->cdate,'ttl_komen'=>$ttl_koment,'lati'=>$value->lati,'longi'=>$value->longi,
                'ttl_like'=>$ttl_like,'gallery_aduan'=>$result2[$no],'like'=>$stt));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getKomenAduan()
    {
        $id=$this->input->post('id_tb_aduan');
        $dt_1=array('id_tb_aduan'=>$id);
        $stmt=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","ASC")->result();
        foreach ($stmt as $value) {
            if (!empty($value->id_tb_user)) {
                $dt_2=array('id_tb_user'=>$value->id_tb_user);
                $stmt_2=$this->Mpelayanan->getDataDetail($dt_2,"tb_user","id_tb_user","DESC")->row();
                $nama=$stmt_2->nama_user;
                if (empty($stmt_2->img_user)){
                    $img="assets/document/style/img/profile.jpg";
                } else {
                    $img="assets/document/img/user/".$stmt_2->img_user;
                }
            }
            if (!empty($value->id_tb_admin)) {
                $dt_2=array('id_tb_admin'=>$value->id_tb_admin);
                $stmt_2=$this->Mpelayanan->getDataDetail($dt_2,"tb_admin","id_tb_admin","DESC")->row();
                $nama=$stmt_2->nama_admin;
                if (empty($stmt_2->img_admin)){
                    $img="assets/document/style/img/logo_kota_tegal.png";
                } else {
                    $img="assets/document/img/admin/".$stmt_2->img_admin;
                }
            }
            array_push($this->result,array('id_tb_comment_aduan'=>$value->id_tb_comment_aduan,'isi_comment'=>$value->isi_comment,
                'img_comment'=>$value->img_comment,'cdate'=>$value->cdate,'nama'=>$nama,'img'=>$img));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getLikeAduan(){
        $id=$this->input->post('id_tb_aduan');
        $dt_where=array('id_tb_aduan'=>$id,'deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataSelectWhere("id_tb_user,cdate",$dt_where,"tb_like_aduan","","");
        foreach ($stmt->result() as $val){
            $dt_where2=array('id_tb_user'=>$val->id_tb_user,'deleted_flage'=>"1");
            $stmt2=$this->Mpelayanan->getDataSelectWhere("nama_user,img_user",$dt_where2,"tb_user","","")->row();
            if (empty($stmt2->img_user)){
                $img="assets/document/style/img/profile.jpg";
            } else {
                $img="assets/document/img/user/".$stmt2->img_user;
            }
            array_push($this->result,array('img_user'=>$img,'nama_user'=>$stmt2->nama_user,'cdate'=>$val->cdate,'ttl_like'=>$stmt->num_rows()));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getSearchAduan()
    {
        $search=strtolower($this->input->post('search'));
        $id_tb_user=$this->input->post('id_tb_user');
        $dari=$this->input->post('dari');
        $stmt=$this->Mpelayanan->getSearchAduan($search,$dari);
        $result2=array();
        $no=0;
        foreach ($stmt->result() as $value) {
            $no++;
            $dt_1=array('id_tb_aduan'=>$value->id_tb_aduan,'deleted_flage'=>"1");
            $dt_2=array('id_tb_aduan'=>$value->id_tb_aduan,'id_tb_user'=>$id_tb_user, 'deleted_flage'=>"1");
            $ttl_koment=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
            $ttl_like=$this->Mpelayanan->getDataDetail($dt_1,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
            $stmt_2=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
            $like=$this->Mpelayanan->getDataDetail($dt_2,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
            if ($like>0) { $stt=true; }
            else { $stt=false; }
            $result2[$no]=array();
            foreach ($stmt_2->result() as $value_2) {
                array_push($result2[$no],array('img_gallery_aduan'=>$value_2->img_gallery_aduan));
            }
            array_push($this->result,array('id_tb_user'=>$value->id_tb_user,'id_tb_aduan'=>$value->id_tb_aduan,'isi_aduan'=>$value->isi_aduan,
                'nama_user'=>$value->nama_user,'img_user'=>$value->img_user,'nama_admin'=>$value->nama_admin,
                'cdate'=>$value->cdate,'ttl_komen'=>$ttl_koment,'lati'=>$value->lati,'longi'=>$value->longi,
                'ttl_like'=>$ttl_like,'gallery_aduan'=>$result2[$no],'like'=>$stt));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function input_komen()
    {
        $nama="";
        $uploadPath = './assets/document/img/komentar_gallery/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = '*';
        $config['file_name'] = date('ymdHis');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('file')){
            $fileData = $this->upload->data();
            $nama = $fileData['file_name'];
            $size = $fileData['file_size'];
            $tipe = $fileData['file_type'];
            if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
                $image_data = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 822;
                $this->load->library('image_lib');
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
        }

        $id_aduan=$this->input->post('id_tb_aduan');
        $id_tb_user=$this->input->post('id_tb_user');
        $cdate=$this->input->post('cdate');

        $stt_notif=0;
        $dt_cek=array('id_tb_aduan'=>$id_aduan);
        $cek_=$this->Mpelayanan->getDataDetail($dt_cek,"tb_aduan","id_tb_aduan","DESC")->row();
        if ($cek_->id_tb_user != $id_tb_user) {
            $stt_notif=1;
        }


        $dt_1=array('id_tb_aduan'=>$id_aduan,'deleted_flage'=>"1");
        $ttl_koment=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
        $dt=array('id_tb_aduan'=>$id_aduan,'id_tb_user'=>$id_tb_user,
            'img_comment'=>$nama,'isi_comment'=>$this->input->post('isi_comment'),
            'stt_notif_user'=>$stt_notif,'stt_notif_admin'=>"1",
            'cdate'=>$cdate,'input_by'=>$this->input->post('input_by'),
            'input_ket'=>$this->input->post('input_ket'));
        $stmt=$this->Mpelayanan->input_data_returnId("tb_comment_aduan",$dt);
        if ($stmt) {
            array_push($this->result,array('status'=>"1",'id_tb_comment_aduan'=>$stmt,'img_gallery_aduan'=>$nama,
                'ttl_komen'=>$ttl_koment));
            $dt_log = array('keterangan'=>"Pengguna masyarakat memberikan komentar",
                'id_tb_user'=>$id_tb_user,'cdate'=>$cdate,'input_by'=>$id_tb_user,'input_ket'=>"user");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0",'id_tb_comment_aduan'=>"",'img_gallery_aduan'=>"",'ttl_komen'=>""));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function input_gallery_lokasi()
    {
        $id_lokasi=$this->input->post('id_tb_lokasi_tempat_umum');
        $id_tb_user=$this->input->post('id_tb_user');
        $nama_lokasi=$this->input->post('nama_lokasi');
        $date=$this->input->post('cdate');

        if (!empty($_FILES['file']['name'])){
            $filesCount = count($_FILES['file']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['files']['name'] = $_FILES['file']['name'][$i];
                $_FILES['files']['type'] = $_FILES['file']['type'][$i];
                $_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                $_FILES['files']['error'] = $_FILES['file']['error'][$i];
                $_FILES['files']['size'] = $_FILES['file']['size'][$i];

                $nama="";
                $uploadPath = './assets/document/img/lokasi_tempat_umum_gallery/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = '*';
                $config['file_name'] = date('ymdHis').$i;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('files')){
                    $fileData = $this->upload->data();
                    $nama = $fileData['file_name'];
                    $size = $fileData['file_size'];
                    $tipe = $fileData['file_type'];
                    if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg" || $tipe == "image/JPEG" || $tipe == "image/PNG" || $tipe == "image/JPG") {
                        $image_data = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $image_data['full_path'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 822;
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                    $dt=array('id_tb_lokasi_tempat_umum'=>$id_lokasi,'img_gallery_lokasi_tempat_umum'=>$nama,
                        'cdate'=>$date,'input_by'=>$id_tb_user,'input_ket'=>"user");
                    $stmt=$this->Mpelayanan->input_data("tb_gallery_lokasi_tempat_umum",$dt);
                    array_push($this->result2,array('img_gallery_lokasi_tempat_umum'=>$nama));
                }
            }
            if ($stmt) {
                array_push($this->result,array('status'=>"1",'gallery_lokasi'=>$this->result2));
                $dt_log = array('keterangan'=>"Pengguna masyarakat menambahkan gallery dengan nama lokasi tempat umum ".$nama_lokasi,
                    'id_tb_user'=>$id_tb_user,'cdate'=>$date,'input_by'=>$id_tb_user,'input_ket'=>"user");
                $this->log($dt_log);
            }
            else {
                array_push($this->result,array('status'=>"0",'gallery_lokasi'=>$this->result2));
            }
        } else {
            array_push($this->result,array('status'=>"0",'gallery_lokasi'=>$this->result2));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function likeAduan()
    {
        $id_aduan=$this->input->post('id_tb_aduan');
        $id_user=$this->input->post('id_tb_user');
        $cdate=$this->input->post('cdate');
        $dt=array('id_tb_aduan'=>$id_aduan,'id_tb_user'=>$id_user);
        $like=$this->Mpelayanan->getDataDetail($dt,"tb_like_aduan","id_tb_like_aduan","DESC");
        if ($like->num_rows() > 0) {
            $dt2=array('id_tb_aduan'=>$id_aduan,'id_tb_user'=>$id_user);
            if ($like->row()->deleted_flage == "1") {
                $data=array('deleted_flage'=>"0",'mdate'=>$cdate);
                $stmt=$this->Mpelayanan->update_data($dt2,$data,"tb_like_aduan");
                if ($stmt) {
                    array_push($this->result,array('status'=>"1"));
                } else {
                    array_push($this->result,array('status'=>"0"));
                }
            } else {
                $data=array('deleted_flage'=>"1",'mdate'=>$cdate);
                $stmt=$this->Mpelayanan->update_data($dt2,$data,"tb_like_aduan");
                if ($stmt) {
                    array_push($this->result,array('status'=>"1"));
                } else {
                    array_push($this->result,array('status'=>"0"));
                }
            }
        }
        else {
            $data=array('deleted_flage'=>"1",'cdate'=>$cdate,'id_tb_aduan'=>$id_aduan,'id_tb_user'=>$id_user);
            $stmt=$this->Mpelayanan->input_data("tb_like_aduan",$data);
            if ($stmt) {
                array_push($this->result,array('status'=>"1"));
            } else {
                array_push($this->result,array('status'=>"0"));
            }
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getInstansiList()
    {
        $dt = array('deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_admin','id_tb_admin','DESC');
        foreach ($stmt->result() as $val) {
            $this->result2=array();
            $dt2 = array('deleted_flage'=>"1",'id_tb_admin'=>$val->id_tb_admin);
            $stmt2=$this->Mpelayanan->getDataDetail($dt2,'tb_gallery_admin','id_tb_gallery_admin','ASC');
            foreach ($stmt2->result() as $val_2) {
                array_push($this->result2,array('img_gallery_admin'=>$val_2->img_gallery_admin));
            }
            array_push($this->result,array('id_tb_admin'=>$val->id_tb_admin,'nama_admin'=>$val->nama_admin,
                'deskripsi_admin'=>$val->deskripsi_admin,'img_admin'=>$val->img_admin,
                'lati'=>$val->lati,'longi'=>$val->longi,'gallery_admin'=>$this->result2));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getJenisLokasiList()
    {
        $dt = array('deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_jenis_lokasi_tempat_umum','id_tb_jenis_lokasi_tempat_umum','ASC');
        $response = array('result' => $stmt->result());
        $this->setJSON($response);
    }

    public function getLokasiList()
    {
        $id_jenis_lokasi=$this->input->post('id_tb_jenis_lokasi_tempat_umum');
        $terdekat=$this->input->post('terdekat');
        $lati=$this->input->post('lati');
        $longi=$this->input->post('longi');
        $dt = array('deleted_flage'=>"1",'id_tb_jenis_lokasi_tempat_umum'=>$id_jenis_lokasi);
        $nama_jenis_lokasi=$this->Mpelayanan->getDataDetail($dt,'tb_jenis_lokasi_tempat_umum','id_tb_jenis_lokasi_tempat_umum','ASC')->row()->nama_jenis_lokasi;
        if ($terdekat=="true"){
            $stmt=$this->Mpelayanan->getLokasiTerdeakt($id_jenis_lokasi,$lati,$longi);
        } else {
            $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_lokasi_tempat_umum','id_tb_lokasi_tempat_umum','ASC');
        }
        foreach ($stmt->result() as $value) {
            if ($terdekat=="true"){
                $jarak=$value->jarak;
            } else {
                $jarak = "";
            }
            array_push($this->result,array('id_tb_jenis_lokasi_tempat_umum'=>$value->id_tb_jenis_lokasi_tempat_umum,
                'id_tb_lokasi_tempat_umum'=>$value->id_tb_lokasi_tempat_umum,
                'nama_lokasi'=>$value->nama_lokasi,'lati'=>$value->lati,'longi'=>$value->longi,
                'nama_jenis_lokasi'=>$nama_jenis_lokasi,'jarak'=>$jarak));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getSearchLokasi()
    {
        $nama_lokasi=$this->input->post('nama_lokasi');
        $stmt=$this->Mpelayanan->getSearchLokasi($nama_lokasi);
        foreach ($stmt->result() as $value) {
            array_push($this->result,array('id_tb_jenis_lokasi_tempat_umum'=>$value->id_tb_jenis_lokasi_tempat_umum,
                'id_tb_lokasi_tempat_umum'=>$value->id_tb_lokasi_tempat_umum,
                'nama_lokasi'=>$value->nama_lokasi,'lati'=>$value->lati,'longi'=>$value->longi,
                'nama_jenis_lokasi'=>$value->nama_jenis_lokasi));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getNotifAduanUser()
    {
        $id_tb_user=$this->input->post('id_tb_user');
        $dt_where=array('tb_aduan.id_tb_user'=>$id_tb_user);
        $stmt=$this->Mpelayanan->getNotifAduanUser($dt_where);
        $result=array();$no=0;
        foreach ($stmt->result() as $value) {
            if ($value->id_user_comment != $id_tb_user) {
                $no++;
                $dt_1=array('id_tb_aduan'=>$value->id_tb_aduan,'deleted_flage'=>"1");
                $dt_2=array('id_tb_aduan'=>$value->id_tb_aduan,'id_tb_user'=>$id_tb_user,'deleted_flage'=>"1");
                $ttl_koment=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
                $stmt_2=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
                $ttl_like=$this->Mpelayanan->getDataDetail($dt_1,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
                $like=$this->Mpelayanan->getDataDetail($dt_2,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
                if ($like>0) { $stt=true; }
                else { $stt=false; }
                $result2[$no]=array();
                foreach ($stmt_2->result() as $value_2) {
                    array_push($result2[$no],array('img_gallery_aduan'=>$value_2->img_gallery_aduan));
                }

                $keterangan="";
                $img_notif="";
                if ($value->id_user_comment!="") {
                    $dt_notif=array('id_tb_user'=>$value->id_user_comment);
                    $stmt_notif=$this->Mpelayanan->getDataDetail($dt_notif,"tb_user","id_tb_user","DESC")->row_array();
                    if (empty($stmt_notif['img_user'])){
                        $img_notif = "assets/document/style/img/profile/jpg";
                    } else {
                        $img_notif = "assets/document/img/user/".$stmt_notif['img_user'];
                    }
                    $keterangan=$stmt_notif['nama_user']." mengomentari aduan anda";
                }
                if ($value->id_admin_comment!="") {
                    $dt_notif=array('id_tb_admin'=>$value->id_admin_comment);
                    $stmt_notif=$this->Mpelayanan->getDataDetail($dt_notif,"tb_admin","id_tb_admin","DESC")->row_array();
                    if (empty($stmt_notif['img_admin'])){
                        $img_notif = "assets/document/style/img/logo_kota_tegal.png";
                    } else {
                        $img_notif = "assets/document/img/admin/".$stmt_notif['img_admin'];
                    }
                    $keterangan=$stmt_notif['nama_admin']." mengomentari aduan anda";
                }
                if (empty($value->img_user)){
                    $img_user="assets/document/style/img/profile/jpg";
                } else {
                    $img_user=$value->img_user;
                }

                array_push($this->result,array('id_tb_aduan'=>$value->id_tb_aduan,'isi_aduan'=>$value->isi_aduan,
                    'nama_user'=>$value->nama_user,'img_user'=>$img_user,'nama_admin'=>$value->nama_admin,
                    'cdate_comment'=>$value->cdate_comment,'cdate_aduan'=>$value->cdate_aduan,'ttl_komen'=>$ttl_koment,
                    'lati'=>$value->lati,'longi'=>$value->longi,'ttl_like'=>$ttl_like,'gallery_aduan'=>$result2[$no],
                    'like'=>$stt,'isi_aduan'=>$value->isi_aduan,'keterangan'=>$keterangan,'img_notif'=>$img_notif));
            }
        }
        $stmt_ttl = $this->Mpelayanan->getDataAduanListAPI("",$id_tb_user,"","pagi","")->num_rows();
        $response = array('result' => $this->result,'result2' => $stmt_ttl);
        $this->setJSON($response);
    }

    public function input_aduan()
    {
        $date=$this->input->post('cdate');
        $id_user=$this->input->post('id_tb_user');
        $id_admin=$this->input->post('id_tb_admin');
        $lati=$this->input->post('lati');
        $longi=$this->input->post('longi');
        $isi_aduan=$this->input->post('isi_aduan');
        $dt = array('id_tb_user'=>$id_user,'id_tb_admin'=>$id_admin,'isi_aduan'=>$isi_aduan,'cdate'=>$date,
            'lati'=>$lati,'longi'=>$longi,'input_ket'=>"user",'input_by'=>$id_user);
        $stmt = $this->Mpelayanan->input_data_returnId("tb_aduan",$dt);
        if ($stmt) {
            if (!empty($_FILES['file']['name'])){
                $filesCount = count($_FILES['file']['name']);
                for($i = 0; $i < $filesCount; $i++){
                    $_FILES['files']['name'] = $_FILES['file']['name'][$i];
                    $_FILES['files']['type'] = $_FILES['file']['type'][$i];
                    $_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                    $_FILES['files']['error'] = $_FILES['file']['error'][$i];
                    $_FILES['files']['size'] = $_FILES['file']['size'][$i];

                    $uploadPath = './assets/document/img/aduan_gallery/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $config['file_name'] = date('ymdHis').$i;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('files')){
                        $fileData = $this->upload->data();
                        $nama = $fileData['file_name'];
                        $size = $fileData['file_size'];
                        $tipe = $fileData['file_type'];
                        if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg" || $tipe == "image/JPEG" || $tipe == "image/PNG" || $tipe == "image/JPG") {
                            $image_data = $this->upload->data();
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $image_data['full_path'];
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 822;
                            $this->load->library('image_lib');
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                        $dt_2 = array('id_tb_aduan'=>$stmt,'img_gallery_aduan'=>$nama,'cdate'=>$date,
                            'input_ket'=>"user",'input_by'=>$id_user);
                        $stmt_2 = $this->Mpelayanan->input_data("tb_gallery_aduan",$dt_2);
                    }
                }
                if ($stmt_2) {
                    array_push($this->result,array('status'=>"1"));
                    $nama_instansi=getValueWhere("nama_admin","tb_admin","id_tb_admin",$id_admin)->row()->nama_admin;
                    $dt_log = array('keterangan'=>"Pengguna masyarakat menambahkan aduan dengan isi aduan ".$isi_aduan.
                        " kepada instansi ".$nama_instansi,'id_tb_user'=>$id_user,'cdate'=>$date,
                        'input_by'=>$id_user,'input_ket'=>"user");
                    $this->log($dt_log);
                }
                else {
                    array_push($this->result,array('status'=>"0"));
                }
            }
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function input_lokasi()
    {
        $date=$this->input->post('cdate');
        $id_user=$this->input->post('id_tb_user');
        $id_lokasi=$this->input->post('id_tb_jenis_lokasi_tempat_umum');
        $nama_lokasi=$this->input->post('nama_lokasi');
        $dt = array('id_tb_jenis_lokasi_tempat_umum'=>$id_lokasi,'nama_lokasi'=>$nama_lokasi,
            'deskripsi_lokasi'=>$this->input->post('deskripsi_lokasi'),
            'lati'=>$this->input->post('lati'),'longi'=>$this->input->post('longi'),
            'input_ket'=>"user",'input_by'=>$id_user,'cdate'=>$date,'deleted_flage'=>"2");
        $stmt = $this->Mpelayanan->input_data_returnId("tb_lokasi_tempat_umum",$dt);
        if ($stmt) {
            if (!empty($_FILES['file']['name'])){
                $filesCount = count($_FILES['file']['name']);
                for($i = 0; $i < $filesCount; $i++){
                    $_FILES['files']['name'] = $_FILES['file']['name'][$i];
                    $_FILES['files']['type'] = $_FILES['file']['type'][$i];
                    $_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                    $_FILES['files']['error'] = $_FILES['file']['error'][$i];
                    $_FILES['files']['size'] = $_FILES['file']['size'][$i];

                    $uploadPath = './assets/document/img/lokasi_tempat_umum_gallery/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $config['file_name'] = date('ymdHis').$i;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('files')){
                        $fileData = $this->upload->data();
                        $nama = $fileData['file_name'];
                        $size = $fileData['file_size'];
                        $tipe = $fileData['file_type'];
                        if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
                            $image_data = $this->upload->data();
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $image_data['full_path'];
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 822;
                            $this->load->library('image_lib');
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                        $dt_2 = array('id_tb_lokasi_tempat_umum'=>$stmt,'img_gallery_lokasi_tempat_umum'=>$nama,
                            'cdate'=>$date,'input_ket'=>"user",'input_by'=>$id_user);
                        $stmt_2 = $this->Mpelayanan->input_data("tb_gallery_lokasi_tempat_umum",$dt_2);
                    }
                }
                if ($stmt_2) {
                    array_push($this->result,array('status'=>"1"));
                    $jenis_lokasi=getValueWhere("nama_jenis_lokasi","tb_jenis_lokasi_tempat_umum","id_tb_jenis_lokasi_tempat_umum",$id_lokasi)->row()->nama_jenis_lokasi;
                    $dt_log = array('keterangan'=>"Pengguna masyarakat menambahkan lokasi tempat umum dengan nama ".$nama_lokasi.
                        " dengan jenis lokasi ".$jenis_lokasi,'id_tb_user'=>$id_user,'cdate'=>$date,
                        'deleted_flage'=>"2", 'input_by'=>$id_user,'input_ket'=>"user");
                    $this->log($dt_log);
                }
                else {
                    array_push($this->result,array('status'=>"0"));
                }
            }
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getDetailLokasiUmum()
    {
        $no=0;
        $id_lokasi = $this->input->post('id_tb_lokasi_tempat_umum');
        $dt = array('id_tb_lokasi_tempat_umum'=>$id_lokasi,'deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","DESC");
        foreach ($stmt->result() as $value) {
            $no++;
            $stmt_2=$this->Mpelayanan->getDataDetail($dt,"tb_gallery_lokasi_tempat_umum","id_tb_gallery_lokasi_umum","DESC");
            foreach ($stmt_2->result() as $value_2) {
                array_push($this->result2,array('img_gallery_lokasi_tempat_umum'=>$value_2->img_gallery_lokasi_tempat_umum));
            }

            array_push($this->result,array('nama_lokasi'=>$value->nama_lokasi,'deskripsi_lokasi'=>$value->deskripsi_lokasi,
                'lati'=>$value->lati,'longi'=>$value->longi,'gallery_lokasi'=>$this->result2));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_lokasi()
    {
        $id_lokasi = $this->input->post('id_tb_lokasi_tempat_umum');
        $nama_lokasi = $this->input->post('nama_lokasi');
        $cdate = $this->input->post('cdate');
        $id_user = $this->input->post('id_tb_user');
        $dt=array('nama_lokasi'=>$nama_lokasi,'deskripsi_lokasi'=>$this->input->post('deskripsi_lokasi'),
            'lati'=>$this->input->post('lati'),'longi'=>$this->input->post('longi'),
            'mdate'=>$cdate,'modify_by'=>$id_user,'modify_ket'=>"user");
        $dt_where=array('id_tb_lokasi_tempat_umum'=>$id_lokasi);
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_lokasi_tempat_umum");
        if ($stmt) {
            array_push($this->result,array('status'=>"1"));
            $dt_log = array('keterangan'=>"Pengguna masyarakat mengubah lokasi tempat umum dengan nama ".$nama_lokasi,
                'id_tb_user'=>$id_user,'cdate'=>$cdate,'input_by'=>$id_user,'input_ket'=>"user");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_aduan()
    {
        $id_aduan = $this->input->post('id_tb_aduan');
        $id_user = $this->input->post('id_tb_user');
        $isi_aduan = $this->input->post('isi_aduan');
        $date = $this->input->post('cdate');
        $dt=array('isi_aduan'=>$isi_aduan,'lati'=>$this->input->post('lati'),'longi'=>$this->input->post('longi'),
            'mdate'=>$date,'modify_by'=>$id_user,'modify_ket'=>"user");
        $dt_where=array('id_tb_aduan'=>$id_aduan);
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_aduan");
        if ($stmt) {
            array_push($this->result,array('status'=>"1"));
            $dt_log = array('keterangan'=>"Pengguna masyarakat mengubah aduan pada instansi ".$this->input->post('nama_admin'),
                'id_tb_user'=>$id_user,'cdate'=>$date,'input_by'=>$id_user,'input_ket'=>"user");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_profil()
    {
        $nama="";
        $id_tb_user=$this->input->post('id_tb_user');
        $nama_user=$this->input->post('nama_user');
        $username=$this->input->post('username');
        $date=$this->input->post('cdate');

        if (!empty($_FILES['file']['name'])){
            $uploadPath = './assets/document/img/user/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = '*';
            $config['file_name'] = date('ymdHis');

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('file')){
                $fileData = $this->upload->data();
                $nama = $fileData['file_name'];
                $size = $fileData['file_size'];
                $tipe = $fileData['file_type'];
                if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
                    $image_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $image_data['full_path'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 822;
                    $this->load->library('image_lib');
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $dt=array('img_user'=>$nama,'nama_user'=>$nama_user,'username'=>$username,'mdate'=>$date,'modify_ket'=>"user",'modify_by'=>$id_tb_user);
                $cek=getValueWhere("img_user","tb_user","id_tb_user",$id_tb_user)->row_array();
                if (!empty($cek['img_user'] || $cek['img_user'] != "" || $cek['img_user'] != "null")) {
                    unlink("./assets/document/img/user/".$cek['img_user']);
                }
            }
        } else {
            $dt=array('nama_user'=>$nama_user,'username'=>$username,'mdate'=>$date,'modify_ket'=>"user",'modify_by'=>$id_tb_user);
        }
        $dt_where=array('id_tb_user'=>$id_tb_user);
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_user");
        if ($stmt) {
            array_push($this->result,array('status'=>"1",'img_user'=>$nama));
            $dt_log = array('keterangan'=>"Pengguna masyarakat mengubah profil",'id_tb_user'=>$id_tb_user,'cdate'=>$date,'input_by'=>$id_tb_user,'input_ket'=>"user");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0",'img_user'=>""));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_password()
    {
        $old_password=$this->input->post('old_password');
        $new_password=$this->input->post('new_password');
        $retype_password=$this->input->post('retype_password');
        $id_tb_user=$this->input->post('id_tb_user');
        $date=$this->input->post('cdate');

        $dt = array('id_tb_user'=>$id_tb_user);
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_user","id_tb_user","DESC");
        if ($stmt) {
            if ($stmt->row()->password==md5($old_password)) {
                $dt_update=array('password'=>md5($retype_password),'mdate'=>$date,'input_by'=>$id_tb_user,'input_ket'=>"user");
                $dt_where=array('id_tb_user'=>$id_tb_user);
                $stmt=$this->Mpelayanan->update_data($dt_where,$dt_update,"tb_user");
                if ($stmt) {
                    array_push($this->result,array('status'=>"1"));
                    $dt_log = array('keterangan'=>"Pengguna masyarakat mengubah password",'id_tb_user'=>$id_tb_user,'cdate'=>$date,'input_by'=>$id_tb_user,'input_ket'=>"user");
                    $this->log($dt_log);
                } else {
                    array_push($this->result,array('status'=>"0"));
                }
            } else {
                array_push($this->result,array('status'=>"2"));
            }
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_forgot_password()
    {
        $new_password=$this->input->post('new_password');
        $retype_password=$this->input->post('retype_password');
        $id_tb_user=$this->input->post('id_tb_user');
        $date=$this->input->post('cdate');

        $dt = array('id_tb_user'=>$id_tb_user);
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_user","id_tb_user","DESC");
        if ($stmt) {
            $dt_update=array('password'=>md5($retype_password),'mdate'=>$date,'input_by'=>$id_tb_user,'input_ket'=>"user");
            $dt_where=array('id_tb_user'=>$id_tb_user);
            $stmt=$this->Mpelayanan->update_data($dt_where,$dt_update,"tb_user");
            if ($stmt) {
                array_push($this->result,array('status'=>"1"));
                $dt_log = array('keterangan'=>"Pengguna masyarakat lupa password dan mengubah password",'id_tb_user'=>$id_tb_user,'cdate'=>$date,'input_by'=>$id_tb_user,'input_ket'=>"user");
                $this->log($dt_log);
            } else {
                array_push($this->result,array('status'=>"0",'img_user'=>""));
            }
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function delete_aduan()
    {
        $id_aduan = $this->input->post('id_tb_aduan');
        $id_user = $this->input->post('id_tb_user');
        $date = $this->input->post('cdate');
        $dt=array('deleted_flage'=>"0",'ddate'=>$date,'deleted_by'=>$id_user,'deleted_ket'=>"user");
        $dt_where=array('id_tb_aduan'=>$id_aduan);
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_aduan");
        if ($stmt) {
            array_push($this->result,array('status'=>"1"));
            $dt_log = array('keterangan'=>"Pengguna masyarakat menghapus aduan pada instansi ".$this->input->post('nama_admin'),
                'id_tb_user'=>$id_user,'cdate'=>$date,'input_by'=>$id_user,'input_ket'=>"user");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function cek_notif()
    {
        $id_user=$this->input->post('id_tb_user');
        $dt=array('tb_comment_aduan.stt_notif_user'=>"1",'tb_aduan.id_tb_user'=>$id_user);
        $stmt=$this->Mpelayanan->getNotifAduanUser($dt);
        if ($stmt) {
            if ($stmt->num_rows() > 0) {
                array_push($this->result,array('status'=>"1",'jumlah'=>$stmt->num_rows()));
                foreach ($stmt->result() as $val) {
                    $dt_where=array('id_tb_comment_aduan'=>$val->id_tb_comment_aduan);
                    $dt_update=array('stt_notif_user'=>"0");
                    $this->Mpelayanan->update_data($dt_where,$dt_update,"tb_comment_aduan");
                }
            }
        } else {
            array_push($this->result,array('status'=>"0",'jumlah'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    //-------------------------------end user----------------------------------------
    //-------------------------------admin-------------------------------------------
    public function sign_in_admin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $date = $this->input->post('cdate');
        $dt=array('deleted_flage'=>"1",'username'=>$username,'password'=>md5($password));
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","DESC");
        if ($stmt->num_rows() > 0) {
            foreach ($stmt->result() as $val) {
                array_push($this->result,array('status'=>"1"));
                array_push($this->result2,array('id_tb_admin'=>$val->id_tb_admin,'nama_admin'=>$val->nama_admin,
                    'username'=>$val->username,'img_admin'=>$val->img_admin,
                    'deskripsi_admin'=>$val->deskripsi_admin,'lati'=>$val->lati,'longi'=>$val->longi));
                $dt_log = array('keterangan'=>"Pengguna instansi dengan nama ".$val->nama_admin." masuk ke aplikasi mobile",
                    'id_tb_admin'=>$val->id_tb_admin,'cdate'=>$date,'input_by'=>$val->id_tb_admin,'input_ket'=>"admin");
                $this->log($dt_log);
            }
        } else {
            array_push($this->result,array('status'=>"0"));
            array_push($this->result2,array('id_tb_admin'=>"",'nama_admin'=>"",'img_admin'=>"",'username'=>"",
                'deskripsi_admin'=>"",'lati'=>"",'longi'=>""));
        }
        $response = array('result' => $this->result,'result2' => $this->result2);
        $this->setJSON($response);
    }

    public function sign_in()
    {
        $dt = array('username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password')),
            'deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_user','id_tb_user','DESC');
        if ($stmt->num_rows() > 0) {
            array_push($this->result,array('status'=>"1"));
            $id = $stmt->row()->id_tb_user;
            $dt = array('keterangan'=>"Pengguna masyarakat sign-in ke aplikasi",
                'id_tb_user'=>$id,'cdate'=>date('Y-m-d H:i:s'),'input_by'=>$id,'input_ket'=>"user");
            $this->log($dt);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result,'result2' => $stmt->result());
        $this->setJSON($response);
    }

    public function getAduanListAdmin()
    {
        $id_tb_admin=$this->input->post('id_tb_admin');
        $dari=$this->input->post('dari');
        $status=$this->input->post('status');
        $stmt=$this->Mpelayanan->getDataAduanListAPI("","",$id_tb_admin,$status,$dari);
        $result2=array();
        $no=0;
        foreach ($stmt->result() as $value) {
            $no++;
            $dt_1=array('id_tb_aduan'=>$value->id_tb_aduan,'deleted_flage'=>"1");
            $ttl_koment=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
            $ttl_like=$this->Mpelayanan->getDataDetail($dt_1,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
            $stmt_2=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
            $result2[$no]=array();
            foreach ($stmt_2->result() as $value_2) {
                array_push($result2[$no],array('img_gallery_aduan'=>$value_2->img_gallery_aduan));
            }
            array_push($this->result,array('id_tb_user'=>$value->id_tb_user,'id_tb_aduan'=>$value->id_tb_aduan,'isi_aduan'=>$value->isi_aduan,
                'nama_user'=>$value->nama_user,'img_user'=>$value->img_user,'nama_admin'=>$value->nama_admin,
                'cdate'=>$value->cdate,'ttl_komen'=>$ttl_koment,'lati'=>$value->lati,'longi'=>$value->longi,
                'ttl_like'=>$ttl_like,'gallery_aduan'=>$result2[$no]));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getNewLokasiAdmin()
    {
        $data=array("deleted_flage"=>"2");
        $stmt=$this->Mpelayanan->getDataDetail($data,"tb_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","DESC");
        $no=0;
        foreach ($stmt->result() as $value) {
            $img="";
            $dt_1=array('id_tb_lokasi_tempat_umum'=>$value->id_tb_lokasi_tempat_umum,'deleted_flage'=>"1");
            $stmt_2=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_lokasi_tempat_umum","id_tb_gallery_lokasi_umum","ASC");
            if ($stmt_2->num_rows() > 0){
                $img=$stmt_2->row()->img_gallery_lokasi_tempat_umum;
            }

            $dt_2=array('id_tb_jenis_lokasi_tempat_umum'=>$value->id_tb_jenis_lokasi_tempat_umum,'deleted_flage'=>"1");
            $stmt_2=$this->Mpelayanan->getDataDetail($dt_2,"tb_jenis_lokasi_tempat_umum","id_tb_jenis_lokasi_tempat_umum","ASC");
            $jenis=$stmt_2->row()->nama_jenis_lokasi;

            $dt_3=array('id_tb_user'=>$value->input_by);
            $stmt_3=$this->Mpelayanan->getDataDetail($dt_3,"tb_user","id_tb_user","ASC");
            $img_user=$stmt_3->row()->img_user;
            $nm=$stmt_3->row()->nama_user;
            array_push($this->result,array('id_tb_lokasi_tempat_umum'=>$value->id_tb_lokasi_tempat_umum,
                'lati'=>$value->lati,'longi'=>$value->longi,'deskripsi_lokasi'=>$value->deskripsi_lokasi,'nama_user'=>$nm,'img_user'=>$img_user,
                'nama_jenis_lokasi'=>$jenis,'nama_lokasi'=>$value->nama_lokasi,'img_gallery_lokasi_tempat_umum'=>$img,
                'cdate'=>$value->cdate));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getKomenAduanAdmin()
    {
        $id=$this->input->post('id_tb_aduan');
        $dt_1=array('id_tb_aduan'=>$id);
        $stmt=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","ASC")->result();
        foreach ($stmt as $value) {
            if (!empty($value->id_tb_user)) {
                $dt_2=array('id_tb_user'=>$value->id_tb_user);
                $stmt_2=$this->Mpelayanan->getDataDetail($dt_2,"tb_user","id_tb_user","DESC")->row();
                $nama=$stmt_2->nama_user;
                if (empty($stmt_2->img_user)){
                    $img="assets/document/style/img/profile.jpg";
                } else {
                    $img="assets/document/img/user/".$stmt_2->img_user;
                }
            }
            if (!empty($value->id_tb_admin)) {
                $dt_2=array('id_tb_admin'=>$value->id_tb_admin);
                $stmt_2=$this->Mpelayanan->getDataDetail($dt_2,"tb_admin","id_tb_admin","DESC")->row();
                $nama=$stmt_2->nama_admin;
                if (empty($stmt_2->img_admin)){
                    $img="assets/document/style/img/logo_kota_tegal.png";
                } else {
                    $img="assets/document/img/admin/".$stmt_2->img_admin;
                }
            }
            array_push($this->result,array('id_tb_comment_aduan'=>$value->id_tb_comment_aduan,'isi_comment'=>$value->isi_comment,
                'img_comment'=>$value->img_comment,'cdate'=>$value->cdate,'nama'=>$nama,'img'=>$img));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function input_komen_admin()
    {
        $nama="";
        $uploadPath = './assets/document/img/komentar_gallery/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = '*';
        $config['file_name'] = date('ymdHis');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('file')){
            $fileData = $this->upload->data();
            $nama = $fileData['file_name'];
            $size = $fileData['file_size'];
            $tipe = $fileData['file_type'];
            if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
                $image_data = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 822;
                $this->load->library('image_lib');
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
        }

        $id_aduan=$this->input->post('id_tb_aduan');
        $id_tb_admin=$this->input->post('id_tb_admin');
        $cdate=$this->input->post('cdate');

        $stt_notif=0;
        $dt_cek=array('id_tb_aduan'=>$id_aduan);
        $cek_=$this->Mpelayanan->getDataDetail($dt_cek,"tb_aduan","id_tb_aduan","DESC")->row();
        if ($cek_->id_tb_admin != $id_tb_admin) {
            $stt_notif=1;
        }

        $dt_1=array('id_tb_aduan'=>$id_aduan,'deleted_flage'=>"1");
        $ttl_koment=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
        $dt=array('id_tb_aduan'=>$id_aduan,'id_tb_admin'=>$id_tb_admin,
            'img_comment'=>$nama,'isi_comment'=>$this->input->post('isi_comment'),
            'stt_notif_user'=>"1",'stt_notif_admin'=>$stt_notif,
            'cdate'=>$cdate,'input_by'=>$this->input->post('input_by'),
            'input_ket'=>$this->input->post('input_ket'));
        $stmt=$this->Mpelayanan->input_data_returnId("tb_comment_aduan",$dt);
        if ($stmt) {
            array_push($this->result,array('status'=>"1",'id_tb_comment_aduan'=>$stmt,'img_gallery_aduan'=>$nama,
                'ttl_komen'=>$ttl_koment));
            $dt_log = array('keterangan'=>"Pengguna admin memberikan komentar",
                'id_tb_admin'=>$id_tb_admin,'cdate'=>$cdate,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0",'id_tb_comment_aduan'=>"",'img_gallery_aduan'=>"",'ttl_komen'=>""));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function delete_aduan_admin()
    {
        $id_aduan = $this->input->post('id_tb_aduan');
        $id_admin = $this->input->post('id_tb_admin');
        $date = $this->input->post('cdate');
        $dt=array('deleted_flage'=>"0",'ddate'=>$date,'deleted_by'=>$id_admin,'deleted_ket'=>"admin");
        $dt_where=array('id_tb_aduan'=>$id_aduan);
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_aduan");
        if ($stmt) {
            array_push($this->result,array('status'=>"1"));
            $dt_log = array('keterangan'=>"Pengguna admin menghapus aduan masyarakat ",
                'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,'input_ket'=>"admin");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getJenisLokasiListAdmin()
    {
        $dt = array('deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_jenis_lokasi_tempat_umum','id_tb_jenis_lokasi_tempat_umum','ASC');
        $response = array('result' => $stmt->result());
        $this->setJSON($response);
    }

    public function getLokasiListAdmin()
    {
        $id_jenis_lokasi=$this->input->post('id_tb_jenis_lokasi_tempat_umum');
        $terdekat=$this->input->post('terdekat');
        $lati=$this->input->post('lati');
        $longi=$this->input->post('longi');
        $dt = array('deleted_flage'=>"1",'id_tb_jenis_lokasi_tempat_umum'=>$id_jenis_lokasi);
        $nama_jenis_lokasi=$this->Mpelayanan->getDataDetail($dt,'tb_jenis_lokasi_tempat_umum','id_tb_jenis_lokasi_tempat_umum','ASC')->row()->nama_jenis_lokasi;
        if ($terdekat=="true"){
            $stmt=$this->Mpelayanan->getLokasiTerdeakt($id_jenis_lokasi,$lati,$longi);
        } else {
            $stmt=$this->Mpelayanan->getDataDetail($dt,'tb_lokasi_tempat_umum','id_tb_lokasi_tempat_umum','ASC');
        }
        foreach ($stmt->result() as $value) {
            if ($terdekat=="true"){
                $jarak=$value->jarak;
            } else {
                $jarak = "";
            }
            array_push($this->result,array('id_tb_jenis_lokasi_tempat_umum'=>$value->id_tb_jenis_lokasi_tempat_umum,
                'id_tb_lokasi_tempat_umum'=>$value->id_tb_lokasi_tempat_umum,
                'nama_lokasi'=>$value->nama_lokasi,'lati'=>$value->lati,'longi'=>$value->longi,
                'nama_jenis_lokasi'=>$nama_jenis_lokasi,'jarak'=>$jarak));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getSearchLokasiAdmin()
    {
        $nama_lokasi=$this->input->post('nama_lokasi');
        $stmt=$this->Mpelayanan->getSearchLokasi($nama_lokasi);
        foreach ($stmt->result() as $value) {
            array_push($this->result,array('id_tb_jenis_lokasi_tempat_umum'=>$value->id_tb_jenis_lokasi_tempat_umum,
                'id_tb_lokasi_tempat_umum'=>$value->id_tb_lokasi_tempat_umum,
                'nama_lokasi'=>$value->nama_lokasi,'lati'=>$value->lati,'longi'=>$value->longi,
                'nama_jenis_lokasi'=>$value->nama_jenis_lokasi));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getDetailLokasiUmumAdmin()
    {
        $no=0;
        $id_lokasi = $this->input->post('id_tb_lokasi_tempat_umum');
        $dt = array('id_tb_lokasi_tempat_umum'=>$id_lokasi,'deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","DESC");
        foreach ($stmt->result() as $value) {
            $no++;
            $stmt_2=$this->Mpelayanan->getDataDetail($dt,"tb_gallery_lokasi_tempat_umum","id_tb_gallery_lokasi_umum","DESC");
            foreach ($stmt_2->result() as $value_2) {
                array_push($this->result2,array('img_gallery_lokasi_tempat_umum'=>$value_2->img_gallery_lokasi_tempat_umum));
            }

            array_push($this->result,array('nama_lokasi'=>$value->nama_lokasi,'deskripsi_lokasi'=>$value->deskripsi_lokasi,
                'lati'=>$value->lati,'longi'=>$value->longi,'gallery_lokasi'=>$this->result2));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function input_gallery_lokasi_admin()
    {
        $id_lokasi=$this->input->post('id_tb_lokasi_tempat_umum');
        $id_tb_admin=$this->input->post('id_tb_admin');
        $nama_lokasi=$this->input->post('nama_lokasi');
        $date=$this->input->post('cdate');

        if (!empty($_FILES['file']['name'])){
            $filesCount = count($_FILES['file']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['files']['name'] = $_FILES['file']['name'][$i];
                $_FILES['files']['type'] = $_FILES['file']['type'][$i];
                $_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                $_FILES['files']['error'] = $_FILES['file']['error'][$i];
                $_FILES['files']['size'] = $_FILES['file']['size'][$i];

                $nama="";
                $uploadPath = './assets/document/img/lokasi_tempat_umum_gallery/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = '*';
                $config['file_name'] = date('ymdHis').$i;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('files')){
                    $fileData = $this->upload->data();
                    $nama = $fileData['file_name'];
                    $size = $fileData['file_size'];
                    $tipe = $fileData['file_type'];
                    if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg" || $tipe == "image/JPEG" || $tipe == "image/PNG" || $tipe == "image/JPG") {
                        $image_data = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $image_data['full_path'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 822;
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                    $dt=array('id_tb_lokasi_tempat_umum'=>$id_lokasi,'img_gallery_lokasi_tempat_umum'=>$nama,
                        'cdate'=>$date,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
                    $stmt=$this->Mpelayanan->input_data("tb_gallery_lokasi_tempat_umum",$dt);
                    array_push($this->result2,array('img_gallery_lokasi_tempat_umum'=>$nama));
                }
            }
            if ($stmt) {
                array_push($this->result,array('status'=>"1",'gallery_lokasi'=>$this->result2));
                $dt_log = array('keterangan'=>"Pengguna admin menambahkan gallery dengan nama lokasi tempat umum ".$nama_lokasi,
                    'id_tb_admin'=>$id_tb_admin,'cdate'=>$date,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
                $this->log($dt_log);
            }
            else {
                array_push($this->result,array('status'=>"0",'gallery_lokasi'=>$this->result2));
            }
        } else {
            array_push($this->result,array('status'=>"0",'gallery_lokasi'=>$this->result2));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_lokasi_admin()
    {
        $id_lokasi = $this->input->post('id_tb_lokasi_tempat_umum');
        $nama_lokasi = $this->input->post('nama_lokasi');
        $cdate = $this->input->post('cdate');
        $id_admin = $this->input->post('id_tb_admin');
        $dt=array('nama_lokasi'=>$nama_lokasi,'deskripsi_lokasi'=>$this->input->post('deskripsi_lokasi'),
            'lati'=>$this->input->post('lati'),'longi'=>$this->input->post('longi'),
            'mdate'=>$cdate,'modify_by'=>$id_admin,'modify_ket'=>"admin");
        $dt_where=array('id_tb_lokasi_tempat_umum'=>$id_lokasi);
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_lokasi_tempat_umum");
        if ($stmt) {
            array_push($this->result,array('status'=>"1"));
            $dt_log = array('keterangan'=>"Pengguna admin mengubah lokasi tempat umum dengan nama ".$nama_lokasi,
                'id_tb_admin'=>$id_admin,'cdate'=>$cdate,'input_by'=>$id_admin,'input_ket'=>"admin");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_maps_admin()
    {
        $id_admin = $this->input->post('id_tb_admin');
        $cdate = $this->input->post('cdate');
        $id_admin = $this->input->post('id_tb_admin');
        $dt=array('lati'=>$this->input->post('lati'),'longi'=>$this->input->post('longi'),
            'mdate'=>$cdate,'modify_by'=>$id_admin,'modify_ket'=>"admin");
        $dt_where=array('id_tb_admin'=>$id_admin);
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_admin");
        if ($stmt) {
            array_push($this->result,array('status'=>"1"));
            $dt_log = array('keterangan'=>"Pengguna admin mengubah peta lokasi admin",'id_tb_admin'=>$id_admin,'cdate'=>$cdate,
                'input_by'=>$id_admin,'input_ket'=>"admin");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function input_lokasi_admin()
    {
        $date=$this->input->post('cdate');
        $id_admin=$this->input->post('id_tb_admin');
        $id_lokasi=$this->input->post('id_tb_jenis_lokasi_tempat_umum');
        $nama_lokasi=$this->input->post('nama_lokasi');
        $dt = array('id_tb_jenis_lokasi_tempat_umum'=>$id_lokasi,'nama_lokasi'=>$nama_lokasi,
            'deskripsi_lokasi'=>$this->input->post('deskripsi_lokasi'),
            'lati'=>$this->input->post('lati'),'longi'=>$this->input->post('longi'),
            'input_ket'=>"admin",'input_by'=>$id_admin,'cdate'=>$date);
        $stmt = $this->Mpelayanan->input_data_returnId("tb_lokasi_tempat_umum",$dt);
        if ($stmt) {
            if (!empty($_FILES['file']['name'])){
                $filesCount = count($_FILES['file']['name']);
                for($i = 0; $i < $filesCount; $i++){
                    $_FILES['files']['name'] = $_FILES['file']['name'][$i];
                    $_FILES['files']['type'] = $_FILES['file']['type'][$i];
                    $_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                    $_FILES['files']['error'] = $_FILES['file']['error'][$i];
                    $_FILES['files']['size'] = $_FILES['file']['size'][$i];

                    $uploadPath = './assets/document/img/lokasi_tempat_umum_gallery/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $config['file_name'] = date('ymdHis').$i;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('files')){
                        $fileData = $this->upload->data();
                        $nama = $fileData['file_name'];
                        $size = $fileData['file_size'];
                        $tipe = $fileData['file_type'];
                        if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
                            $image_data = $this->upload->data();
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $image_data['full_path'];
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 822;
                            $this->load->library('image_lib');
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                        $dt_2 = array('id_tb_lokasi_tempat_umum'=>$stmt,'img_gallery_lokasi_tempat_umum'=>$nama,
                            'cdate'=>$date,'input_ket'=>"admin",'input_by'=>$id_admin);
                        $stmt_2 = $this->Mpelayanan->input_data("tb_gallery_lokasi_tempat_umum",$dt_2);
                    }
                }
                if ($stmt_2) {
                    array_push($this->result,array('status'=>"1"));
                    $jenis_lokasi=getValueWhere("nama_jenis_lokasi","tb_jenis_lokasi_tempat_umum","id_tb_jenis_lokasi_tempat_umum",$id_lokasi)->row()->nama_jenis_lokasi;
                    $dt_log = array('keterangan'=>"Pengguna admin menambahkan lokasi tempat umum dengan nama ".$nama_lokasi.
                        " dengan jenis lokasi ".$jenis_lokasi,'id_tb_admin'=>$id_admin,'cdate'=>$date,
                        'input_by'=>$id_admin,'input_ket'=>"admin");
                    $this->log($dt_log);
                }
                else {
                    array_push($this->result,array('status'=>"0"));
                }
            }
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getNotifAdmin()
    {
        $id_tb_admin=$this->input->post('id_tb_admin');
        $dt_where=array('tb_aduan.id_tb_admin'=>$id_tb_admin);
        $stmt=$this->Mpelayanan->getNotifAdmin($dt_where);
        $result=array();$no=0;
        foreach ($stmt->result() as $value) {
            if ($value->id_admin_comment != $id_tb_admin) {
                $no++;
                $dt_1=array('id_tb_aduan'=>$value->id_tb_aduan,'deleted_flage'=>"1");
                $ttl_koment=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
                $stmt_2=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
                $ttl_like=$this->Mpelayanan->getDataDetail($dt_1,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
                $result2[$no]=array();
                foreach ($stmt_2->result() as $value_2) {
                    array_push($result2[$no],array('img_gallery_aduan'=>$value_2->img_gallery_aduan));
                }

                $keterangan="";
                $img_notif="";
                if ($value->id_user_comment!="") {
                    $dt_notif=array('id_tb_user'=>$value->id_user_comment);
                    $stmt_notif=$this->Mpelayanan->getDataDetail($dt_notif,"tb_user","id_tb_user","DESC")->row_array();
                    $keterangan=$stmt_notif['nama_user']." mengomentari aduan anda";
                    if (empty($stmt_notif['img_user'])){
                        $img_notif = "assets/document/style/img/profile.jpg";
                    } else {
                        $img_notif = "assets/document/img/user/".$stmt_notif['img_user'];
                    }
                }
                if ($value->id_admin_comment!="") {
                    $dt_notif=array('id_tb_admin'=>$value->id_admin_comment);
                    $stmt_notif=$this->Mpelayanan->getDataDetail($dt_notif,"tb_admin","id_tb_admin","DESC")->row_array();
                    $keterangan=$stmt_notif['nama_admin']." mengomentari aduan anda";
                    if (empty($stmt_notif['img_admin'])){
                        $img_notif = "assets/document/style/img/logo_kota_tegal.png";
                    } else {
                        $img_notif = "assets/document/img/admin/".$stmt_notif['img_admin'];
                    }
                }

                if (empty($value->img_user)){
                    $img_user="assets/document/style/img/profile.jpg";
                } else {
                    $img_user=$value->img_user;
                }

                array_push($this->result,array('id_tb_aduan'=>$value->id_tb_aduan,'isi_aduan'=>$value->isi_aduan,
                    'nama_user'=>$value->nama_user,'img_user'=>$img_user,'nama_admin'=>$value->nama_admin,
                    'cdate_comment'=>$value->cdate_comment,'cdate_aduan'=>$value->cdate_aduan,'ttl_komen'=>$ttl_koment,
                    'lati'=>$value->lati,'longi'=>$value->longi,'ttl_like'=>$ttl_like,'gallery_aduan'=>$result2[$no],
                    'isi_aduan'=>$value->isi_aduan,'keterangan'=>$keterangan,'img_notif'=>$img_notif));
            }
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function cek_notif_admin()
    {
        $id_admin=$this->input->post('id_tb_admin');
        $dt_aduan=array('id_tb_admin'=>$id_admin,'deleted_flage'=>"1",'stt_notif_admin'=>"1");
        $ttl_aduan=$this->Mpelayanan->getDataDetail($dt_aduan,"tb_aduan","id_tb_aduan","DESC");

        $dt=array('tb_comment_aduan.stt_notif_admin'=>"1",'tb_aduan.id_tb_admin'=>$id_admin);
        $stmt=$this->Mpelayanan->getNotifAduanUser($dt);
        if ($stmt->num_rows() > 0) {
            foreach ($stmt->result() as $val) {
                $dt_where=array('id_tb_comment_aduan'=>$val->id_tb_comment_aduan);
                $dt_update=array('stt_notif_admin'=>"0");
                $this->Mpelayanan->update_data($dt_where,$dt_update,"tb_comment_aduan");
            }
        }
        if ($ttl_aduan->num_rows() > 0) {
            foreach ($ttl_aduan->result() as $val) {
                $dt_where=array('id_tb_aduan'=>$val->id_tb_aduan);
                $dt_update=array('stt_notif_admin'=>"0");
                $this->Mpelayanan->update_data($dt_where,$dt_update,"tb_aduan");
            }
        }
        array_push($this->result,array('jumlah_komentar'=>$stmt->num_rows(),'jumlah_aduan'=>$ttl_aduan->num_rows()));
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function getProfilAdmin()
    {
        $id_admin=$this->input->post('id_tb_admin');
        $dt=array('id_tb_admin'=>$id_admin,'deleted_flage'=>"1");
        $ttl_aduan=$this->Mpelayanan->getDataDetail($dt,"tb_aduan","id_tb_aduan","DESC")->num_rows();
        $stmt_gal=$this->Mpelayanan->getDataDetail($dt,"tb_gallery_admin","id_tb_admin","DESC");
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","DESC");
        if ($stmt) {
            foreach ($stmt_gal->result() as $val_gal) {
                array_push($this->result2,array('img_gallery_admin'=>$val_gal->img_gallery_admin));
            }
            foreach ($stmt->result() as $val) {
                array_push($this->result,array('status'=>"1",'nama_admin'=>$val->nama_admin,'img_admin'=>$val->img_admin,
                    'deskripsi_admin'=>$val->deskripsi_admin,'lati'=>$val->lati,'longi'=>$val->longi,
                    'gallery_admin'=>$this->result2,'ttl_aduan'=>$ttl_aduan));
            }
        } else {
            array_push($this->result,array('status'=>"0",'nama_admin'=>"",'img_admin'=>"",'deskripsi_admin'=>"",'lati'=>"",
                'longi'=>"",'gallery_admin'=>"",'ttl_aduan'=>""));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_profil_admin()
    {
        $nama="";
        $id_tb_admin=$this->input->post('id_tb_admin');
        $nama_admin=$this->input->post('nama_admin');
        $username=$this->input->post('username');
        $deskripsi=$this->input->post('deskripsi_admin');
        $date=$this->input->post('cdate');

        if (!empty($_FILES['file']['name'])){
            $uploadPath = './assets/document/img/admin/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = '*';
            $config['file_name'] = date('ymdHis');

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('file')){
                $fileData = $this->upload->data();
                $nama = $fileData['file_name'];
                $size = $fileData['file_size'];
                $tipe = $fileData['file_type'];
                if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
                    $image_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $image_data['full_path'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 822;
                    $this->load->library('image_lib');
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $dt=array('img_admin'=>$nama,'nama_admin'=>$nama_admin,'username'=>$username,'deskripsi_admin'=>$deskripsi,'mdate'=>$date,
                    'modify_ket'=>"admin",'modify_by'=>$id_tb_admin);
                $cek=getValueWhere("img_admin","tb_admin","id_tb_admin",$id_tb_admin)->row_array();
                if (!empty($cek['img_admin'] || $cek['img_admin'] != "" || $cek['img_admin'] != "null")) {
                    unlink("./assets/document/img/admin/".$cek['img_admin']);
                }
            }
        } else {
            $dt=array('nama_admin'=>$nama_admin,'username'=>$username,'deskripsi_admin'=>$deskripsi,'mdate'=>$date,
                'modify_ket'=>"admin",'modify_by'=>$id_tb_admin);
        }
        $dt_where=array('id_tb_admin'=>$id_tb_admin);
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_admin");
        if ($stmt) {
            array_push($this->result,array('status'=>"1",'img_admin'=>$nama));
            $dt_log = array('keterangan'=>"Pengguna admin mengubah profil",'id_tb_admin'=>$id_tb_admin,'cdate'=>$date,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0",'img_admin'=>""));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function update_password_admin()
    {
        $old_password=$this->input->post('old_password');
        $new_password=$this->input->post('new_password');
        $retype_password=$this->input->post('retype_password');
        $id_tb_admin=$this->input->post('id_tb_admin');
        $date=$this->input->post('cdate');

        $dt = array('id_tb_admin'=>$id_tb_admin);
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","DESC");
        if ($stmt) {
            if ($stmt->row()->password==md5($old_password)) {
                $dt_update=array('password'=>md5($retype_password),'mdate'=>$date,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
                $dt_where=array('id_tb_admin'=>$id_tb_admin);
                $stmt=$this->Mpelayanan->update_data($dt_where,$dt_update,"tb_admin");
                if ($stmt) {
                    array_push($this->result,array('status'=>"1"));
                    $dt_log = array('keterangan'=>"Pengguna admin mengubah password",'id_tb_admin'=>$id_tb_admin,'cdate'=>$date,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
                    $this->log($dt_log);
                } else {
                    array_push($this->result,array('status'=>"0"));
                }
            } else {
                array_push($this->result,array('status'=>"2"));
            }
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function input_gallery_admin()
    {
        $id_tb_admin=$this->input->post('id_tb_admin');
        $date=$this->input->post('cdate');

        if (!empty($_FILES['file']['name'])){
            $filesCount = count($_FILES['file']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['files']['name'] = $_FILES['file']['name'][$i];
                $_FILES['files']['type'] = $_FILES['file']['type'][$i];
                $_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                $_FILES['files']['error'] = $_FILES['file']['error'][$i];
                $_FILES['files']['size'] = $_FILES['file']['size'][$i];

                $nama="";
                $uploadPath = './assets/document/img/admin_gallery/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = '*';
                $config['file_name'] = date('ymdHis').$i;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('files')){
                    $fileData = $this->upload->data();
                    $nama = $fileData['file_name'];
                    $size = $fileData['file_size'];
                    $tipe = $fileData['file_type'];
                    if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg" || $tipe == "image/JPEG" || $tipe == "image/PNG" || $tipe == "image/JPG") {
                        $image_data = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $image_data['full_path'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 822;
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                    $dt=array('id_tb_admin'=>$id_tb_admin,'img_gallery_admin'=>$nama,
                        'cdate'=>$date,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
                    $stmt=$this->Mpelayanan->input_data("tb_gallery_admin",$dt);
                }
            }
            if ($stmt) {
                array_push($this->result,array('status'=>"1"));
                $dt_log = array('keterangan'=>"Pengguna admin menambahkan gallery profil",
                    'id_tb_admin'=>$id_tb_admin,'cdate'=>$date,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
                $this->log($dt_log);
            }
            else {
                array_push($this->result,array('status'=>"0"));
            }
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function delete_gallery_admin(){
        $date=$this->input->post('cdate');
        $id_tb_admin=$this->input->post('id_tb_admin');
        $img_gallery_admin=$this->input->post('img_gallery_admin');
        for($i = 0; $i < count($img_gallery_admin); $i++){
            if (file_exists("./assets/document/img/admin_gallery/".$img_gallery_admin[$i])){
                unlink("./assets/document/img/admin_gallery/".$img_gallery_admin[$i]);
            }
            $dt=array('id_tb_admin'=>$id_tb_admin,'img_gallery_admin'=>$img_gallery_admin[$i]);
            $stmt=$this->Mpelayanan->delete_data($dt,"tb_gallery_admin");
        }
        if ($stmt){
            array_push($this->result,array('status'=>"1"));
            $dt_log = array('keterangan'=>"Pengguna admin menghapus gallery profil",
                'id_tb_admin'=>$id_tb_admin,'cdate'=>$date,'input_by'=>$id_tb_admin,'input_ket'=>"admin");
            $this->log($dt_log);
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }

    public function updeNewLokasi_admin(){
        $id_admin=$this->input->post('id_tb_admin');
        $date=$this->input->post('cdate');
        $id=$this->input->post('id_tb_lokasi_tempat_umum');
        $jns=$this->input->post('jenis');
        $nama=$this->input->post('nama_lokasi');
        $dt_where=array('id_tb_lokasi_tempat_umum'=>$id);
        if ($jns=="konfirm"){
            $dt=array('deleted_flage'=>"1");
            $dt_log = array('keterangan'=>"Admin mengkonfirmasi tempat umum dengan nama ".$nama,'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
                'input_ket'=>"admin");
        } else {
            $dt=array('deleted_flage'=>"0");
            $dt_log = array('keterangan'=>"Admin tidak mengkonfirmasi tempat umum dengan nama ".$nama,'id_tb_admin'=>$id_admin,'ddate'=>$date,'deleted_by'=>$id_admin,
                'deleted_ket'=>"admin");
        }
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_lokasi_tempat_umum");
        if ($stmt){
            $this->log($dt_log);
            array_push($this->result,array('status'=>"1"));
        } else {
            array_push($this->result,array('status'=>"0"));
        }
        $response = array('result' => $this->result);
        $this->setJSON($response);
    }
    //-------------------------------end admin---------------------------------------

    public function log($dt)
    {
        $this->Mpelayanan->input_data("tb_log",$dt);
    }

    public function setJSON($response)
    {
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }
}

?>
