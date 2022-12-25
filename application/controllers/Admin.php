<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->model('Mpelayanan');
        $this->load->helper('library_helper');
        if (isset($this->session->userdata['logged_in_admin_pelayanan_publik']) != TRUE){
            redirect(base_url('Sistem'));
        }
    }

	public function index()
	{
		$dt_aduan=array();
		$dt_aduan_gallery=array();
		$id_admin=$this->session->userdata('id_tb_admin');
		$stmt=$this->Mpelayanan->getDataAduanListWeb("","",$id_admin);
		$i=0;
        $dt=array();
		foreach ($stmt->result() as $value) {
			$i++;
			$dt[$i]['id_tb_aduan']= safe_encode($value->id_tb_aduan);
			$dt[$i]['isi_aduan']=$value->isi_aduan;
            $dt[$i]['lati']=$value->lati;
            $dt[$i]['longi']=$value->longi;
			$dt[$i]['nama_user']=$value->nama_user;
			$dt[$i]['cdate']=waktu_lalu($value->cdate);
			$dt_1=array('id_tb_aduan'=>$value->id_tb_aduan);
			$dt[$i]['ttl_komen']=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
			$dt[$i]['ttl_like']=$this->Mpelayanan->getDataDetail($dt_1,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
			$stmt_2=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
			$j=0;
			foreach ($stmt_2->result() as $value_2) {
				$j++;
				$dt[$i]['gallery'][$j]=$value_2->img_gallery_aduan;
			}
		}
		$data['data']=$dt;
		$data['page']="index";
		$this->template->admin('admin/dashboard/index',$data);
	}
	public function detail_post()
	{
		$id = safe_decode($this->uri->segment(2));
		$dt_1=array('id_tb_aduan'=>$id);
		$data['detail']=$this->Mpelayanan->getDataAduanListWeb($id,"","")->row();
		$data['ttl_like']=$this->Mpelayanan->getDataDetail($dt_1,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
		$data['ttl_komen']=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
		$data['gallery']=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
		$data['page']="detail";
		$this->template->admin('admin/dashboard/index',$data);
	}

	public function deleteAduan(){
        $date=date('Y-m-d H:i:s');
        $id = safe_decode($this->input->post('id'));
        $id_admin=$this->session->userdata('id_tb_admin');
        $dt_where=array('id_tb_aduan'=>$id);
        $dt=array('deleted_flage'=>0,'ddate'=>$date,'deleted_by'=>$id_admin,'deleted_ket'=>"admin");
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_aduan");
        if ($stmt){
            $dt_log = array('keterangan'=>"Admin menghapus aduan user",'id_tb_admin'=>$id_admin,'ddate'=>$date,'deleted_by'=>$id_admin,
                'deleted_ket'=>"admin");
            $this->log($dt_log);
            echo 1;
        } else {
            echo 0;
        }
    }

	public function komentar_aduan()
	{
		$id=$this->input->get('id');
		$page=$this->input->get('page');
	    $limit = 5*$page;
		$dt_1=array('id_tb_aduan'=>$id);
		$komentar=array();
		$stmt=$this->Mpelayanan->getDataDetailPagi($dt_1,"tb_comment_aduan","id_tb_comment_aduan","ASC",$limit);
		$i=0;
		foreach ($stmt->result() as $value) {
			$i++;
			$komentar[$i]['id_tb_comment_aduan']=waktu_lalu($value->id_tb_comment_aduan);
			$komentar[$i]['isi_comment']=$value->isi_comment;
			$komentar[$i]['cdate']=waktu_lalu($value->cdate);
			$komentar[$i]['img_comment']=$value->img_comment;
			if (!empty($value->id_tb_user)) {
				$dt_2=array('id_tb_user'=>$value->id_tb_user);
				$stmt_2=$this->Mpelayanan->getDataDetail($dt_2,"tb_user","id_tb_user","DESC")->row();
				$komentar[$i]['nama_']=$stmt_2->nama_user;
				if (empty($stmt_2->img_user)){
                    $komentar[$i]['img_']="assets/document/style/img/profile.jpg";
                } else{
                    $komentar[$i]['img_']="assets/document/img/user/".$stmt_2->img_user;
                }
			}
			if (!empty($value->id_tb_admin)) {
				$dt_2=array('id_tb_admin'=>$value->id_tb_admin);
				$stmt_2=$this->Mpelayanan->getDataDetail($dt_2,"tb_admin","id_tb_admin","DESC")->row();
				$komentar[$i]['nama_']=$stmt_2->nama_admin;
				if (empty($stmt_2->img_admin)){
                    $komentar[$i]['img_']="assets/document/style/img/logo_kota_tegal.png";
                } else{
                    $komentar[$i]['img_']="assets/document/img/admin/".$stmt_2->img_admin;
                }
			}
		}
		$data['id']=$id;
		$data['pagi']=$limit;
		$data['ttl_pagi']=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
		$data['komentar']=$komentar;
		$data['page']="komentar";
		$this->load->view('admin/dashboard/index',$data);
	}

	public function input_komentar_aduan()
	{
		$date=date('Y-m-d H:i:s');
		$id_admin=$this->session->userdata('id_tb_admin');
		$nama="";
		$isi = substr(json_encode($this->input->post('komentar')), 1, -1);
		$id_aduan = $this->input->post('id_aduan');
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
		$dt=array('id_tb_aduan'=>$id_aduan,'id_tb_admin'=>$id_admin,'isi_comment'=>$isi,'img_comment'=>$nama,
							'stt_notif_user'=>"1",'cdate'=>$date,'input_by'=>$id_admin,'input_ket'=>"admin");
		$stmt=$this->Mpelayanan->input_data('tb_comment_aduan',$dt);
		if ($stmt) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function notifikasi()
    {
        $id_tb_admin=$this->session->userdata('id_tb_admin');
        $dt_where=array('tb_aduan.id_tb_admin'=>$id_tb_admin);
        $stmt=$this->Mpelayanan->getNotifAdmin($dt_where);
        $result=array();$no=0;
        foreach ($stmt->result() as $value) {
            if ($value->id_admin_comment != $id_tb_admin) {
                $no++;
                $dt_1=array('id_tb_aduan'=>$value->id_tb_aduan,'deleted_flage'=>"1");
                $result[$no]['gallery']=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
                $keterangan="";
                $img_notif="";
                if ($value->id_user_comment!="") {
                    $dt_notif=array('id_tb_user'=>$value->id_user_comment);
                    $stmt_notif=$this->Mpelayanan->getDataDetail($dt_notif,"tb_user","id_tb_user","DESC")->row_array();
                    $keterangan=$stmt_notif['nama_user']." mengomentari aduan anda";
                    if (empty($stmt_notif['img_user'])){
                        $result[$no]['img_user'] = "assets/document/style/img/profile.jpg";
                    } else {
                        $result[$no]['img_user'] = "assets/document/img/user/".$stmt_notif['img_user'];
                    }
                }
                if ($value->id_admin_comment!="") {
                    $dt_notif=array('id_tb_admin'=>$value->id_admin_comment);
                    $stmt_notif=$this->Mpelayanan->getDataDetail($dt_notif,"tb_admin","id_tb_admin","DESC")->row_array();
                    $keterangan=$stmt_notif['nama_admin']." mengomentari aduan anda";
                    if (empty($stmt_notif['img_admin'])){
                        $result[$no]['img_user'] = "assets/document/style/img/logo_kota_tegal.png";
                    } else {
                        $result[$no]['img_user'] = "assets/document/img/admin/".$stmt_notif['img_admin'];
                    }
                }
                $result[$no]['img_notif']=$img_notif;
                $result[$no]['keterangan']=$keterangan;
                $result[$no]['id_tb_aduan']=safe_encode($value->id_tb_aduan);
                $result[$no]['cdate']=waktu_lalu($value->cdate_comment);
            }
        }
        $data['page']="index";
        $data['data']=$result;
        $this->template->admin('admin/notifikasi/index',$data);
    }

    public function getNotifAdminWeb(){
        $id_tb_admin=$this->session->userdata('id_tb_admin');
        $dt_where=array('tb_aduan.id_tb_admin'=>$id_tb_admin);
        $stmt=$this->Mpelayanan->getNotifAdmin($dt_where);
        echo $stmt->num_rows();
    }

    public function lokasi_tempat_umum()
	{
		$dt_jenis_lokasi=array();
        $dt_aduan=array();
		$no=0;
		$dt = array('deleted_flage'=>"1");$dt_lokasi_f=array();
		$stmt = $this->Mpelayanan->getDataDetail($dt,"tb_jenis_lokasi_tempat_umum","id_tb_jenis_lokasi_tempat_umum","ASC");
		foreach ($stmt->result() as $val) {
			$no++;
			$dt_sum = array('id_tb_jenis_lokasi_tempat_umum'=>$val->id_tb_jenis_lokasi_tempat_umum,'deleted_flage'=>"1");
			$dt_jenis_lokasi[$no]['id_jenis_lokasi']=$val->id_tb_jenis_lokasi_tempat_umum;
			$dt_jenis_lokasi[$no]['jenis_lokasi']=$val->nama_jenis_lokasi;
			$dt_jenis_lokasi[$no]['icon_materialize']=$val->icon_materialize;
			$dt_jenis_lokasi[$no]['jml']=$this->Mpelayanan->getDataSelectWhere("count(nama_lokasi) as jml",$dt_sum,"tb_lokasi_tempat_umum","","")->row()->jml;
			$stmt_2=$this->Mpelayanan->getDataDetail($dt_sum,"tb_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","ASC");
			foreach ($stmt_2->result() as $val_2) {
				$dt_img=array('id_tb_lokasi_tempat_umum'=>$val_2->id_tb_lokasi_tempat_umum);
				$stmt_2=$this->Mpelayanan->getDataDetail($dt_img,"tb_gallery_lokasi_tempat_umum","id_tb_gallery_lokasi_umum","ASC");
                $gmbar="";
				if ($stmt_2->num_rows()>0) {
					$gmbar=$stmt_2->row()->img_gallery_lokasi_tempat_umum;
				}
                array_push($dt_lokasi_f,array('id_jenis_lokasi'=>$val_2->id_tb_jenis_lokasi_tempat_umum,
                    'lt'=>$val_2->lati,'lg'=>$val_2->longi,'nama'=>$val_2->nama_lokasi,'deskripsi'=>$val_2->deskripsi_lokasi,
                    'id_lokasi'=>$val_2->id_tb_lokasi_tempat_umum,'img_lokasi'=>$gmbar,
                    'deskripsi'=>$val_2->deskripsi_lokasi));
			}
		}

        $data['page']="index";
		$data['dt_jenis_lokasi'] = $dt_jenis_lokasi;
		$data['dt_lokasi']=json_encode($dt_lokasi_f);
		$this->load->view('admin/lokasi/index',$data);
	}

	public function detail_lokasi_tempat_umum()
	{
		$dt_=array('id_tb_lokasi_tempat_umum'=>$this->input->get('id'));
		$stmt_=$this->Mpelayanan->getDataDetail($dt_,"tb_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","ASC")->row();
		$stmt_2=$this->Mpelayanan->getDataDetail($dt_,"tb_gallery_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","ASC");
		if ($stmt_2->num_rows() > 0){
            $stmt_2=$stmt_2->result();
        } else {
            $stmt_2="0";
        }
		$data['detail']=$stmt_;
		$data['gallery']=$stmt_2;
		echo json_encode($data);
	}

    public function setAssigment(){
        $dt_=array('deleted_flage'=>"2");
        $stmt=$this->Mpelayanan->getDataDetail($dt_,"tb_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","ASC");
        $result=array();$i=0;
        foreach ($stmt->result() as $val) {
            $i++;
            $dt_where=array('id_tb_user'=>$val->input_by,'deleted_flage'=>"1");
            $stmt_2=$this->Mpelayanan->getDataDetail($dt_where,"tb_user","id_tb_user","ASC")->row();
            if (empty($stmt_2->img_user)){
                $img_user=base_url('assets/document/style/img/profile.jpg');
            } else {
                $img_user=base_url('assets/document/img/user')."/".$stmt_2->img_user;
            }
            $nama_user=$stmt_2->nama_user;
            $nama_lokasi=$val->nama_lokasi;
            $id_lokasi=$val->id_tb_lokasi_tempat_umum;
            $lati=$val->lati;
            $longi=$val->longi;
            $dt_img=array('id_tb_lokasi_tempat_umum'=>$val->id_tb_lokasi_tempat_umum);
            $stmt_3=$this->Mpelayanan->getDataDetail($dt_img,"tb_gallery_lokasi_tempat_umum","id_tb_gallery_lokasi_umum","ASC");
            if ($stmt_3->num_rows() > 0){
                $img_gallery=base_url('assets/document/img/lokasi_tempat_umum_gallery')."/".$stmt_3->row()->img_gallery_lokasi_tempat_umum;
            } else {
                $img_gallery=base_url('assets/document/style/img/bg_slide_2.jpg');
            }
            array_push($result,array('img_user'=>$img_user,'nama_user'=>$nama_user, 'nama_lokasi'=>$nama_lokasi,
                'id_lokasi'=>$id_lokasi,'lati'=>$lati,'longi'=>$longi,'img_gallery'=>$img_gallery));
        }

        echo $data['data']=$this->setJSON(array('result' => $result));
    }

    public function konfirmAssigmentMaps(){
        $id_admin=$this->session->userdata('id_tb_admin');
        $date=date('Y-m-d H:i:s');
        $id=$this->input->post('id');
        $nama=$this->input->post('nama');
        $jns=$this->input->post('jns');
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
            echo 1;
        } else {
            echo 0;
        }
    }

	public function edit_lokasi_tempat_umum()
	{
		$id_admin=$this->session->userdata('id_tb_admin');
		$date=date('Y-m-d H:i:s');
		$id=$this->input->post('id_tb_lokasi_tempat_umum');
		$nama=$this->input->post('nama');
		$dt=array('nama_lokasi'=>$nama,'deskripsi_lokasi'=>$this->input->post('deskripsi'),
								'id_tb_jenis_lokasi_tempat_umum'=>$this->input->post('jenis_lokasi'),'mdate'=>$date,'modify_by'=>$id_admin,
								'modify_ket'=>"admin");
		$dt_update=array('id_tb_lokasi_tempat_umum'=>$id);
		$stmt=$this->Mpelayanan->update_data($dt_update,$dt,"tb_lokasi_tempat_umum");
		if ($stmt) {
			$dt = array('keterangan'=>"Admin mengubah tempat umum dengan nama ".$nama,'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
									'input_ket'=>"admin");
			$this->log($dt);
			echo 1;
		} else {
			echo 0;
		}
	}

	public function tambah_foto_lokasi_tempat_umum()
	{
		$id_admin=$this->session->userdata('id_tb_admin');
		$date=date('Y-m-d H:i:s');
		$id=$this->input->post('id_tb_lokasi_tempat_umum');
		if (!empty($_FILES['userFiles']['name'])){
			$n = 20;
			$filesCount = count($_FILES['userFiles']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
				$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
				$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
				$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
				$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

				$uploadPath = './assets/document/img/lokasi_tempat_umum_gallery/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*';
				$config['file_name'] = date('ymdHis');

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('userFile')){
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
					$dt_2 = array('id_tb_lokasi_tempat_umum'=>$id,'img_gallery_lokasi_tempat_umum'=>$nama,'cdate'=>$date,
											'input_ket'=>"admin",'input_by'=>$id_admin);
					$stmt_2 = $this->Mpelayanan->input_data("tb_gallery_lokasi_tempat_umum",$dt_2);
				}
			}
			if ($stmt_2) {
				$dt = array('keterangan'=>"Admin menambahkan foto tempat umum dengan nama ".$nama,'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
										'input_ket'=>"admin");
				$this->log($dt);
				echo 1;
			}
			else {
				echo "0";
			}
		} else {
			echo 0;
		}
	}

	public function tambah_lokasi_tempat_umum()
	{
		$id_admin=$this->session->userdata('id_tb_admin');
		$date=date('Y-m-d H:i:s');
		$nama=$this->input->post('nama');
		$deskripsi=$this->input->post('deskripsi');
		$lati=$this->input->post('lati');
		$longi=$this->input->post('longi');
		$jenis_lokasi=$this->input->post('jenis_lokasi');

		$dt = array('id_tb_jenis_lokasi_tempat_umum'=>$jenis_lokasi,'nama_lokasi'=>$nama,'deskripsi_lokasi'=>$deskripsi,
								'lati'=>$lati,'longi'=>$longi,'cdate'=>$date,'input_by'=>$id_admin,'input_ket'=>"admin");
		$stmt=$this->Mpelayanan->input_data_returnId("tb_lokasi_tempat_umum",$dt);
		if ($stmt) {
			$dt = array('keterangan'=>"Admin menambahkan tempat umum dengan nama ".$nama,'id_tb_superadmin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
									'input_ket'=>"admin");
			$this->log($dt);
			if (!empty($_FILES['userFiles']['name'])){
				$n = 20;
				$filesCount = count($_FILES['userFiles']['name']);
				for($i = 0; $i < $filesCount; $i++){
					$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
					$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
					$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
					$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
					$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

					$uploadPath = './assets/document/img/lokasi_tempat_umum_gallery/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = '*';
					$config['file_name'] = date('ymdHis');

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('userFile')){
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
						$dt_2 = array('id_tb_lokasi_tempat_umum'=>$stmt,'img_gallery_lokasi_tempat_umum'=>$nama,'cdate'=>$date,
												'input_ket'=>"admin",'input_by'=>$id_admin);
						$stmt_2 = $this->Mpelayanan->input_data("tb_gallery_lokasi_tempat_umum",$dt_2);
					}
				}
				if ($stmt_2) {
					echo 1;
				}
				else {
					echo "0";
				}
			} else {
				echo 1;
			}
		} else {
			echo 0;
		}
	}

	public function profil()
	{
		$id_admin = $this->session->userdata('id_tb_admin');
		$dt = array('id_tb_admin'=>$id_admin);
		$data['val'] = $this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","ASC")->row();
		$data['val_num_rows'] = $this->Mpelayanan->getDataDetail($dt,"tb_aduan","id_tb_aduan","ASC")->num_rows();
		$data['val_gallery'] = $this->Mpelayanan->getDataDetail($dt,"tb_gallery_admin","id_tb_admin","ASC");
		$this->template->admin('admin/profil/index',$data);
	}

	public function update_foto_admin()
	{
		$id_admin = $this->session->userdata('id_tb_admin');
		$img_admin = getValueWhere("img_admin","tb_admin","id_tb_admin",$id_admin)->row()->img_admin;
        $uploadPath = './assets/document/img/admin/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = '*';
        $config['file_name'] = date('YmdHis');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('file')){
            if (!empty($img_admin)){
                unlink("./assets/document/img/admin/$img_admin");
            }
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
            $dt = array('img_admin'=>$nama,'mdate'=>date('Y-m-d H:i:s'),'modify_by'=>$id_admin,'modify_ket'=>"admin");
            $dt_update=array('id_tb_admin'=>$id_admin);
            $stmt = $this->Mpelayanan->update_data($dt_update,$dt,"tb_admin");
            if ($stmt) {
                $dt_log = array('keterangan'=>"Admin mengubah foto",
                    'id_tb_admin'=>$id_admin,'cdate'=>date('Y-m-d H:i:s'),'input_by'=>$id_admin,'input_ket'=>"admin");
                $this->log($dt_log);
                $data_session = array('img_admin'=>$nama);
                $this->session->set_userdata($data_session);
                echo "1";
            } else {
                echo "0";
            }
        }
	}

	public function ubah_deskripsi_admin()
	{
		$date=date('Y-m-d H:i:s');
		$id_admin=$this->session->userdata('id_tb_admin');
		$dt = array('deskripsi_admin'=>$this->input->post('deskripsi'),'mdate'=>$date,'modify_by'=>$id_admin,"modify_ket"=>"admin");
		$dt_update=array('id_tb_admin'=>$id_admin);
		$stmt=$this->Mpelayanan->update_data($dt_update,$dt,"tb_admin");
		if ($stmt) {
			$dt = array('keterangan'=>"Admin mengubah deskripsi",'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
									'input_ket'=>"admin");
            $this->log($dt);
			echo 1;
		} else {
			echo 0;
		}
	}

	public function tambah_gallery_admin()
	{
		$id_admin=$this->session->userdata('id_tb_admin');
		$date=date('Y-m-d H:i:s');
		if (!empty($_FILES['userFiles']['name']))
		{
			$n = 20;
			$filesCount = count($_FILES['userFiles']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
				$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
				$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
				$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
				$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

				$uploadPath = './assets/document/img/admin_gallery/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*';
				$config['file_name'] = date('ymdHis');

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('userFile')){
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
					$dt = array('id_tb_admin'=>$id_admin,'img_gallery_admin'=>$nama,'cdate'=>$date,'input_ket'=>"admin",
											'input_by'=>$id_admin);
					$stmt = $this->Mpelayanan->input_data("tb_gallery_admin",$dt);
				}
			}
			if ($stmt) {
				$dt = array('keterangan'=>"Admin menambahkan gallery",'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
										'input_ket'=>"admin");
	        $this->log($dt);
				echo 1;
			}
			else {
				echo "0";
			}
		}
	}

	public function cari_lokasi_tempat_umum()
	{
		$dt_json=array();$no=0;
		$cari=$this->input->post('cari');
		$dt=array('deleted_flage'=>"1");
		$stmt=$this->Mpelayanan->getDataWhereLikeOrder("nama_lokasi",$cari,$dt,"tb_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","DESC")->result();
		foreach ($stmt as $value) {
			$dt_2=array('id_tb_lokasi_tempat_umum'=>$value->id_tb_lokasi_tempat_umum);
			$stmt_2=$this->Mpelayanan->getDataDetail($dt_2,"tb_gallery_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","ASC");
			if ($stmt_2->num_rows() > 0) {
				$dt_json[$no]=array('id_lokasi'=>$value->id_tb_lokasi_tempat_umum,'nama_lokasi'=>$value->nama_lokasi,
														'img_lokasi'=>$stmt_2->row()->img_gallery_lokasi_tempat_umum,'lt'=>$value->lati,'lg'=>$value->longi);
			} else {
				$dt_json[$no]=array('id_lokasi'=>$value->id_tb_lokasi_tempat_umum,'nama_lokasi'=>$value->nama_lokasi,'img_lokasi'=>"",
														'lt'=>$value->lati,'lg'=>$value->longi);
			}
			$no++;
		}
		echo json_encode($dt_json);
	}

	public function ubah_profil_admin()
	{
        $date=date('Y-m-d H:i:s');
        $id_admin=$this->session->userdata('id_tb_admin');
        $nama=$this->input->post('nama');
        $username=$this->input->post('username');
        $dt = array('nama_admin'=>$nama,'username'=>$username,
            'mdate'=>$date,'modify_by'=>$id_admin,"modify_ket"=>"admin");
        $dt_update=array('id_tb_admin'=>$id_admin);
        $stmt=$this->Mpelayanan->update_data($dt_update,$dt,"tb_admin");
        if ($stmt) {
            $dt = array('keterangan'=>"Admin mengubah profil",'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
                'input_ket'=>"admin");
            $this->log($dt);
            $data_session = array('nama_admin'=>$nama,'username'=>$username);
            $this->session->set_userdata($data_session);
            echo 1;
        } else {
            echo 0;
        }
	}

	public function ubah_password_admin()
	{
		$date=date('Y-m-d H:i:s');
		$id_admin=$this->session->userdata('id_tb_admin');
		$pass_lama = md5($this->input->post('password_lama'));
		$dt = array('id_tb_admin'=>$id_admin);
		$stmt=$this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","DESC")->row();
		if ($pass_lama == $stmt->password) {
			$dt = array('password'=>md5($this->input->post('password_baru')),'mdate'=>$date,'modify_by'=>$id_admin,
									"modify_ket"=>"admin");
			$dt_update=array('id_tb_admin'=>$id_admin);
			$stmt=$this->Mpelayanan->update_data($dt_update,$dt,"tb_admin");
			if ($stmt) {
				$dt = array('keterangan'=>"Admin mengubah password",'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
										'input_ket'=>"admin");
	      $this->log($dt);
				echo 1;
			} else {
				echo "Gagal merubah password.";
			}
		} else {
			echo "Password lama salah.";
		}
	}

	public function ubah_map_profil(){
        $date=date('Y-m-d H:i:s');
        $id_admin=$this->session->userdata('id_tb_admin');
        $id=$this->input->post('id');
        $lati=$this->input->post('lati');
        $longi=$this->input->post('longi');
        $dt = array('lati'=>$lati,'longi'=>$longi,
            'mdate'=>$date,'modify_by'=>$id_admin,"modify_ket"=>"admin");
        $dt_update=array('id_tb_admin'=>$id_admin);
        $stmt=$this->Mpelayanan->update_data($dt_update,$dt,"tb_admin");
        if ($stmt) {
            $dt = array('keterangan'=>"Admin mengubah profil",'id_tb_admin'=>$id_admin,'cdate'=>$date,'input_by'=>$id_admin,
                'input_ket'=>"admin");
            $this->log($dt);
            echo 1;
        } else {
            echo 0;
        }
    }

	public function modal()
	{
		$type=$this->input->get('type');
		$data['id_admin']=$id_admin=$this->session->userdata('id_tb_admin');
		if ($type=="ubah_deskripsi_admin") {
			$data['deskripsi']=getValueWhere('deskripsi_admin','tb_admin','id_tb_admin',$id_admin)->row()->deskripsi_admin;
		} else if ($type=="tambah_lokasi") {
			$dt = array('deleted_flage'=>"1");
			$data['dt_jenis_lokasi'] = $this->Mpelayanan->getDataDetail($dt,"tb_jenis_lokasi_tempat_umum","id_tb_jenis_lokasi_tempat_umum","ASC");
			$data['lati']=$this->input->get('lati');
			$data['longi']=$this->input->get('longi');
		} elseif ($type=="edit_lokasi") {
			$id=$this->input->get('id');
			$dt = array('id_tb_lokasi_tempat_umum'=>$id);
			$data['dt'] = $this->Mpelayanan->getDataDetail($dt,"tb_lokasi_tempat_umum","id_tb_lokasi_tempat_umum","ASC")->row();
			$dt = array('deleted_flage'=>"1");
			$data['dt_jenis_lokasi'] = $this->Mpelayanan->getDataDetail($dt,"tb_jenis_lokasi_tempat_umum","id_tb_jenis_lokasi_tempat_umum","ASC");
		} else if ($type=="tambah_foto_lokasi") {
			$data['id']=$this->input->get('id');
		} else if ($type=="map_aduan") {
            $data['lati']=$this->input->get('lati');
            $data['longi']=$this->input->get('longi');
        } else if ($type=="map_profil") {
            $data['lati']=$this->input->get('lati');
            $data['longi']=$this->input->get('longi');
            $data['id']=$this->input->get('id');
        }

		$data['modal']=$type;
		$this->load->view('style/modal_admin',$data);
	}

    public function logout()
    {
        $id_admin = $this->session->userdata('id_tb_admin');
        $dt = array('keterangan'=>"Admin log-out dari aplikasi",
            'id_tb_admin'=>$id_admin,'cdate'=>date('Y-m-d H:i:s'),'input_by'=>$id_admin,'input_ket'=>"admin");
        $this->log($dt);
        $this->session->sess_destroy();
        redirect(base_url());
    }

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
