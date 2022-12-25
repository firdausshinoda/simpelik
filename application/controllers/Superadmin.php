<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		$this->load->model('Mpelayanan');
		$this->load->helper('library_helper');
		if (isset($this->session->userdata['logged_in_superadmin_pelayanan_publik']) != TRUE){
		    redirect(base_url('Sistem'));
		}
	}

	public function index()
	{
		$dt_aduan=array();
		$dt_aduan_gallery=array();
		$stmt=$this->Mpelayanan->getDataAduanListWeb("","","");
		$i=0;
        $dt=array();
		foreach ($stmt->result() as $value) {
			$i++;
			$dt[$i]['id_tb_aduan']=safe_encode($value->id_tb_aduan);
			$dt[$i]['isi_aduan']=$value->isi_aduan;
            $dt[$i]['lati']=$value->lati;
            $dt[$i]['longi']=$value->longi;
			$dt[$i]['nama_user']=$value->nama_user;
			$dt[$i]['nama_admin']=$value->nama_admin;
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
		$this->template->superadmin('superadmin/dashboard/index',$data);
	}

	public function detail_post()
	{
		$id = safe_decode($this->uri->segment(3));
		$dt_1=array('id_tb_aduan'=>$id);
		$data['detail']=$this->Mpelayanan->getDataAduanListWeb($id,"","")->row();
		$data['ttl_like']=$this->Mpelayanan->getDataDetail($dt_1,"tb_like_aduan","id_tb_like_aduan","DESC")->num_rows();
        $data['ttl_komen']=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
		$data['gallery']=$this->Mpelayanan->getDataDetail($dt_1,"tb_gallery_aduan","id_tb_gallery_aduan","ASC");
		$data['page']="detail";
		$this->template->superadmin('superadmin/dashboard/index',$data);
	}

    public function deleteAduan(){
        $date=date('Y-m-d H:i:s');
        $id = safe_decode($this->input->post('id'));
        $dt_where=array('id_tb_aduan'=>$id);
        $dt=array('deleted_flage'=>0,'ddate'=>$date,'deleted_by'=>"1",'deleted_ket'=>"superadmin");
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_aduan");
        if ($stmt){
            $dt_log = array('keterangan'=>"Superadmin menghapus aduan user",'id_tb_admin'=>"1",'ddate'=>$date,'deleted_by'=>"1",
                'deleted_ket'=>"superadmin");
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
		$data['komentar']=$komentar;
		$data['page']="komentar";
        $data['ttl_pagi']=$this->Mpelayanan->getDataDetail($dt_1,"tb_comment_aduan","id_tb_comment_aduan","DESC")->num_rows();
		$this->load->view('superadmin/dashboard/index',$data);
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
			$no_2=0;
			foreach ($stmt_2->result() as $val_2) {
				$no_2++;

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
        $no=0;
        $dt = array('deleted_flage'=>"1");
        $stmt = $this->Mpelayanan->getDataDetail($dt,"tb_aduan","id_tb_aduan","DESC");
        foreach ($stmt->result() as $val) {
            $no++;
            $dt_aduan[$no]['lt']=$val->lati;
            $dt_aduan[$no]['lg']=$val->longi;
            $dt_aduan[$no]['id_aduan']=safe_encode($val->id_tb_aduan);
            $dt_aduan[$no]['deskripsi']=$val->isi_aduan;
            $dt_aduan[$no]['nama']=getValueWhere('nama_admin','tb_admin','id_tb_admin',$val->id_tb_admin)->row()->nama_admin;
        }
        $dt_sum = array('deleted_flage'=>"1");
        $data['jml_aduan'] = $this->Mpelayanan->getDataSelectWhere("count(id_tb_aduan) as jml",$dt_sum,"tb_aduan","","")->row()->jml;
		$data['dt_jenis_lokasi'] = $dt_jenis_lokasi;
		$data['page']="index";
        $data['dt_aduan'] = $dt_aduan;
        $data['dt_lokasi']=json_encode($dt_lokasi_f);
		$this->load->view('superadmin/lokasi/index',$data);
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

	public function edit_lokasi_tempat_umum()
	{
		$id_superadmin=$this->session->userdata('id_tb_superadmin');
		$date=date('Y-m-d H:i:s');
		$id=$this->input->post('id_tb_lokasi_tempat_umum');
		$nama=$this->input->post('nama');
		$dt_where=array('id_tb_lokasi_tempat_umum'=>$id);
		$dt=array('nama_lokasi'=>$nama,'deskripsi_lokasi'=>$this->input->post('deskripsi'),
								'id_tb_jenis_lokasi_tempat_umum'=>$this->input->post('jenis_lokasi'),'mdate'=>$date,'modify_by'=>$id_superadmin,
								'modify_ket'=>"superadmin");
		$stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_lokasi_tempat_umum");
		if ($stmt) {
			$dt = array('keterangan'=>"Superadmin mengubah tempat umum dengan nama ".$nama,'id_tb_superadmin'=>$id_superadmin,'cdate'=>$date,'input_by'=>$id_superadmin,
									'input_ket'=>"superadmin");
			$this->log($dt);
			echo 1;
		} else {
			echo 0;
		}
	}

	public function tambah_foto_lokasi_tempat_umum()
	{
		$id_superadmin=$this->session->userdata('id_tb_superadmin');
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
											'input_ket'=>"superadmin",'input_by'=>$id_superadmin);
					$stmt_2 = $this->Mpelayanan->input_data("tb_gallery_lokasi_tempat_umum",$dt_2);
				}
			}
			if ($stmt_2) {
				$dt = array('keterangan'=>"Superadmin menambahkan foto tempat umum dengan nama ".$nama,'id_tb_superadmin'=>$id_superadmin,'cdate'=>$date,'input_by'=>$id_superadmin,
										'input_ket'=>"superadmin");
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
		$id_superadmin=$this->session->userdata('id_tb_superadmin');
		$date=date('Y-m-d H:i:s');
		$nama=$this->input->post('nama');
		$deskripsi=$this->input->post('deskripsi');
		$lati=$this->input->post('lati');
		$longi=$this->input->post('longi');
		$jenis_lokasi=$this->input->post('jenis_lokasi');

		$dt = array('id_tb_jenis_lokasi_tempat_umum'=>$jenis_lokasi,'nama_lokasi'=>$nama,'deskripsi_lokasi'=>$deskripsi,
								'lati'=>$lati,'longi'=>$longi,'cdate'=>$date,'input_by'=>$id_superadmin,'input_ket'=>"superadmin");
		$stmt=$this->Mpelayanan->input_data_returnId("tb_lokasi_tempat_umum",$dt);
		if ($stmt) {
			$dt = array('keterangan'=>"Superadmin menambahkan tempat umum dengan nama ".$nama,'id_tb_superadmin'=>$id_superadmin,'cdate'=>$date,'input_by'=>$id_superadmin,
									'input_ket'=>"superadmin");
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
												'input_ket'=>"superadmin",'input_by'=>$id_superadmin);
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

	public function tambah_jenis_lokasi()
	{
		$id_superadmin=$this->session->userdata('id_tb_superadmin');
		$date=date('Y-m-d H:i:s');
		$nama=$this->input->post('nama');
		$dt = array('nama_jenis_lokasi'=>$nama,'icon_materialize'=>$this->input->post('icons'),'cdate'=>$date);
		$stmt = $this->Mpelayanan->input_data("tb_jenis_lokasi_tempat_umum",$dt);
		if ($stmt) {
			$dt_2 = array('keterangan'=>"Superadmin menambahkan jenis tempat umum dengan nama ".$nama,'id_tb_superadmin'=>$id_superadmin,'cdate'=>$date,'input_by'=>$id_superadmin,
									'input_ket'=>"superadmin");
			$this->log($dt_2);
			echo 1;
		} else {
			echo 0;
		}
	}

	public function admin()
	{
		$dt = array('deleted_flage'=>"1");
		$data['result'] = $this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","ASC");
		$data['page']="index";
		$this->template->superadmin('superadmin/admin/index',$data);
	}

	public function detail_admin()
	{
        $id = safe_decode($this->uri->segment(3));
		$dt = array('id_tb_admin'=>$id);
		$data['val'] = $this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","ASC")->row();
		$data['val_num_rows'] = $this->Mpelayanan->getDataDetail($dt,"tb_aduan","id_tb_aduan","ASC")->num_rows();
		$data['val_gallery'] = $this->Mpelayanan->getDataDetail($dt,"tb_gallery_admin","id_tb_admin","ASC");
        $data['page']="detail";


        $stmt=$this->Mpelayanan->getDataAduanListWeb("","",$id);
        $i=0;
        $dt=array();
        foreach ($stmt->result() as $value) {
            $i++;
            $dt[$i]['id_tb_aduan']= safe_encode($value->id_tb_aduan);
            $dt[$i]['isi_aduan']=$value->isi_aduan;
            $dt[$i]['lati']=$value->lati;
            $dt[$i]['longi']=$value->longi;
            $dt[$i]['nama_user']=$value->nama_user;
            $dt[$i]['nama_admin']=$value->nama_admin;
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
        $this->template->superadmin('superadmin/admin/index',$data);
	}

	public function add_admin()
	{
        $data['page']="add";
        $this->template->superadmin('superadmin/admin/index',$data);
	}

	public function insert_add_admin()
	{
        $nama="";
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
        }

		$date=date('Y-m-d H:i:s');
		$nama_admin=$this->input->post('nama_admin');
		$dt = array('nama_admin'=>$nama_admin,
                    'username'=>$this->input->post('username'),'password'=>md5($this->input->post('password')),
                    'img_admin'=>$nama,'cdate'=>$date,'input_by'=>"1","input_ket"=>"superadmin");
		$stmt=$this->Mpelayanan->input_data("tb_admin",$dt);
		if ($stmt) {
			$dt = array('keterangan'=>"Superadmin menambahkan admin baru dengan nama ".$nama_admin,
                  'id_tb_superadmin'=>"1",'cdate'=>$date,'input_by'=>"1",'input_ket'=>"superadmin");
            $this->log($dt);
            echo 1;
		} else {
		    echo 0;
		}
	}

	public function ubah_profil_admin()
	{
		$date=date('Y-m-d H:i:s');
		$id_superadmin=$this->session->userdata('id_tb_superadmin');
		$id_admin=$this->input->post('id_admin');
		$nama_admin=$this->input->post('nama');
		$dt_where=array('id_tb_admin'=>$id_admin);
		$dt = array('nama_admin'=>$nama_admin,'username'=>$this->input->post('username'),
								'mdate'=>$date,'modify_by'=>$id_superadmin,"modify_ket"=>"superadmin");
		$stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_admin");
		if ($stmt) {
			$dt = array('keterangan'=>"Superadmin mengubah profil admin dengan nama baru ".$nama_admin,'id_tb_superadmin'=>$id_superadmin,
									'cdate'=>$date,'input_by'=>$id_superadmin,'input_ket'=>"superadmin");
      $this->log($dt);
			echo 1;
		} else {
			echo 0;
		}
	}

	public function ubah_password_admin()
	{
		$date=date('Y-m-d H:i:s');
		$id_superadmin=$this->session->userdata('id_tb_superadmin');
		$id_admin=$this->input->post('id_admin');
		$pass_lama = md5($this->input->post('password_lama'));
		$dt = array('id_tb_admin'=>$id_admin);
		$stmt=$this->Mpelayanan->getDataDetail($dt,"tb_admin","id_tb_admin","DESC")->row();
		if ($pass_lama == $stmt->password) {
			$dt_where=array('id_tb_admin'=>$id_admin);
			$dt = array('password'=>md5($this->input->post('password_baru')),'mdate'=>$date,'modify_by'=>$id_superadmin,
									"modify_ket"=>"superadmin");
			$stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_admin");
			if ($stmt) {
				$nama_admin=getValueWhere('nama_admin','tb_admin','id_tb_admin',$id_admin)->row()->nama_admin;
				$dt = array('keterangan'=>"Superadmin mengubah password admin dengan nama ".$nama_admin,
										'id_tb_superadmin'=>$id_superadmin,'cdate'=>$date,'input_by'=>$id_superadmin,'input_ket'=>"superadmin");
	      $this->log($dt);
				echo 1;
			} else {
				echo "Gagal merubah password.";
			}
		} else {
			echo "Password lama salah.";
		}
	}

	public function user()
	{
        $dt = array('deleted_flage'=>"1");
        $data['result'] = $this->Mpelayanan->getDataDetail($dt,"tb_user","id_tb_user","ASC");
        $data['page']="index";
		$this->template->superadmin('superadmin/user/index',$data);
	}

	public function add_akun_user(){
        $date=date('Y-m-d H:i:s');
        $nik=$this->input->post('no_nik');
        $kk=$this->input->post('no_kk');
        $username=$this->input->post('username');
        $password=$this->input->post('password');

        $dt=array('no_nik'=>$nik,'no_kk'=>$kk);
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_masyarakat","id_tb_masyarakat","ASC");
        if ($stmt->num_rows() > 0){
            $nama=$stmt->row()->nama;
            $sex=$stmt->row()->jk;
            $dt_input=array('no_nik'=>$nik,'no_kk'=>$kk,'password'=>md5($password),'username'=>$username,
                'nama_user'=>$nama,'sex'=>$sex,'cdate'=>$date,'input_by'=>1,'input_ket'=>"superadmin");
            $stmt_2 = $this->Mpelayanan->input_data("tb_user",$dt_input);
            if ($stmt_2){
                $dt_log = array('keterangan'=>"Superadmin menambahkan user dengan nama ".$nama,
                    'id_tb_superadmin'=>1,'cdate'=>$date,'input_by'=>1,'input_ket'=>"superadmin");
                $this->log($dt_log);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 2;
        }
    }

	public function detail_user()
	{
		$id = safe_decode($this->uri->segment(3));
        $stmt=$this->Mpelayanan->getDataAduanListWeb("",$id,"");
        $i=0;
        $dt=array();
        foreach ($stmt->result() as $value) {
            $i++;
            $dt[$i]['id_tb_aduan']= safe_encode($value->id_tb_aduan);
            $dt[$i]['isi_aduan']=$value->isi_aduan;
            $dt[$i]['lati']=$value->lati;
            $dt[$i]['longi']=$value->longi;
            $dt[$i]['nama_user']=$value->nama_user;
            $dt[$i]['nama_admin']=$value->nama_admin;
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

        $dt_where=array('id_tb_user'=>$id);
        $data['data_user']=$this->Mpelayanan->getDataDetail($dt_where,"tb_user","id_tb_user","DESC")->row();
        $data['data']=$dt;
		$data['id_tb_user'] = $id;
		$data['page']="detail";
		$this->template->superadmin('superadmin/user/index',$data);
	}

    public function ubah_profil_user()
    {
        $date=date('Y-m-d H:i:s');
        $id_superadmin=$this->session->userdata('id_tb_superadmin');
        $id_user=$this->input->post('id_tb_user');
        $nama_user=$this->input->post('nama');
        $dt_where=array('id_tb_user'=>$id_user);
        $dt = array('nama_user'=>$nama_user,'username'=>$this->input->post('username'),
            'mdate'=>$date,'modify_by'=>$id_superadmin,"modify_ket"=>"superadmin");
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_user");
        if ($stmt) {
            $dt = array('keterangan'=>"Superadmin mengubah profil user dengan nama baru ".$nama_user,'id_tb_superadmin'=>$id_superadmin,
                'cdate'=>$date,'input_by'=>$id_superadmin,'input_ket'=>"superadmin");
            $this->log($dt);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function ubah_password_user()
    {
        $date=date('Y-m-d H:i:s');
        $id_superadmin=$this->session->userdata('id_tb_superadmin');
        $id_user=$this->input->post('id_user');
        $dt_where=array('id_tb_user'=>$id_user);
        $dt = array('password'=>md5($this->input->post('password_baru')),'mdate'=>$date,'modify_by'=>$id_superadmin,
            "modify_ket"=>"superadmin");
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_user");
        if ($stmt) {
            $nama_user=getValueWhere('nama_user','tb_user','id_tb_user',$id_user)->row()->nama_user;
            $dt = array('keterangan'=>"Superadmin mengubah password user dengan nama ".$nama_user,
                'id_tb_superadmin'=>$id_superadmin,'cdate'=>$date,'input_by'=>$id_superadmin,'input_ket'=>"superadmin");
            $this->log($dt);
            echo 1;
        } else {
            echo "Gagal merubah password.";
        }
    }

	public function add_user()
	{
	    $data['page']="add";
		$this->template->superadmin('superadmin/user/index',$data);
	}

	public function profil()
	{
        $dt_where = array('deleted_flage'=>"1");
        $dt_admin = array('id_tb_superadmin'=>"1");
        $data['data']=$this->Mpelayanan->getDataDetail($dt_admin,"tb_superadmin","id_tb_superadmin","DESC")->row();
        $data['ttl_admin']=$this->Mpelayanan->getDataDetail($dt_where,"tb_admin","id_tb_admin","DESC")->num_rows();
        $data['ttl_user']=$this->Mpelayanan->getDataDetail($dt_where,"tb_user","id_tb_user","DESC")->num_rows();
		$this->template->superadmin('superadmin/profil/index',$data);
	}

    public function ubah_profil_superadmin()
    {
        $date=date('Y-m-d H:i:s');
        $id_superadmin=$this->session->userdata('id_tb_superadmin');
        $nama=$this->input->post('nama');
        $username=$this->input->post('username');
        $email=$this->input->post('email');
        $dt_where=array('id_tb_superadmin'=>$id_superadmin);
        $dt = array('nama_superadmin'=>$nama,'username'=>$username,'email'=>$email,
            'mdate'=>$date,'modify_by'=>$id_superadmin,"modify_ket"=>"superadmin");
        $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_superadmin");
        if ($stmt) {
            $dt = array('keterangan'=>"Superadmin mengubah profil superadmin dengan nama baru ".$nama,'id_tb_superadmin'=>$id_superadmin,
                'cdate'=>$date,'input_by'=>$id_superadmin,'input_ket'=>"superadmin");
            $this->log($dt);
            $data_session = array('nama_superadmin'=>$nama, 'username'=>$username);
            $this->session->set_userdata($data_session);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function ubah_password_superadmin()
    {
        $date=date('Y-m-d H:i:s');
        $id_superadmin=$this->session->userdata('id_tb_superadmin');
        $id_admin=$this->input->post('id_admin');
        $pass_lama = md5($this->input->post('password_lama'));
        $dt = array('id_tb_superadmin'=>$id_superadmin);
        $stmt=$this->Mpelayanan->getDataDetail($dt,"tb_superadmin","id_tb_superadmin","DESC")->row();
        if ($pass_lama == $stmt->password) {
            $dt_where=array('id_tb_superadmin'=>$id_superadmin);
            $dt = array('password'=>md5($this->input->post('password_baru')),'mdate'=>$date,'modify_by'=>$id_superadmin,
                "modify_ket"=>"superadmin");
            $stmt=$this->Mpelayanan->update_data($dt_where,$dt,"tb_superadmin");
            if ($stmt) {
                $dt = array('keterangan'=>"Superadmin mengubah password superadmin",
                    'id_tb_superadmin'=>$id_superadmin,'cdate'=>$date,'input_by'=>$id_superadmin,'input_ket'=>"superadmin");
                $this->log($dt);
                echo 1;
            } else {
                echo "Gagal merubah password.";
            }
        } else {
            echo "Password lama salah.";
        }
    }

    public function laporan(){
        $dt_tahun=array();
        $dt_thn=$this->Mpelayanan->getDataSelect("max(year(cdate)) as thn_max,min(year(cdate)) as thn_min","tb_aduan");
        if ($dt_thn->num_rows()>0){
            $thn_max=$dt_thn->row()->thn_max;
            $thn_min=$dt_thn->row()->thn_min;
            for ($i=$thn_min;$i<=$thn_max;$i++){
                $dt_tahun[$i]['tahun']=$i;
            }
        }
        $dt_where=array('deleted_flage'=>"1");
        $data['instansi']=$this->Mpelayanan->getDataDetail($dt_where,"tb_admin","id_tb_admin","ASC");
        $data['page']="index";
        $data['tahun']=$dt_tahun;
        $this->template->superadmin('superadmin/laporan/index',$data);
    }

    public function getDataLaporanMenu(){
        $jenis=$this->input->post('jenis');
        $thn=$this->input->post('tahun');
        if ($jenis=="tabel"){
            $instansi=$this->input->post('instansi');
            if ($instansi=="semua"){
                $dt_where=array('deleted_flage'=>"1");
            } else {
                $dt_where=array('deleted_flage'=>"1",'id_tb_aduan'=>$instansi);
            }
            $dt=array();$no=0;
            $stmt=$this->Mpelayanan->getDataWhereLikeOrder("cdate",$thn,$dt_where,"tb_aduan","id_tb_aduan","ASC");
            foreach ($stmt->result() as $val){
                $no++;
                $dt_w_comment=array('id_tb_aduan'=>$val->id_tb_aduan);
                $dt_w_user=array('id_tb_user'=>$val->id_tb_user);
                $dt_w_admin=array('id_tb_admin'=>$val->id_tb_admin);
                $dt[$no]['no']=$no;
                $dt[$no]['id_tb_aduan']=$val->id_tb_aduan;
                $dt[$no]['isi_aduan']=$val->isi_aduan;
                $dt[$no]['id_tb_user']=$this->Mpelayanan->getDataDetail($dt_w_user,"tb_user","id_tb_user","ASC")->row()->id_tb_user;
                $dt[$no]['nama_user']=$this->Mpelayanan->getDataDetail($dt_w_user,"tb_user","id_tb_user","ASC")->row()->nama_user;
                $dt[$no]['id_tb_admin']=$this->Mpelayanan->getDataDetail($dt_w_admin,"tb_admin","id_tb_admin","ASC")->row()->id_tb_admin;
                $dt[$no]['nama_admin']=$this->Mpelayanan->getDataDetail($dt_w_admin,"tb_admin","id_tb_admin","ASC")->row()->nama_admin;
                $stmt_comment=$this->Mpelayanan->getDataDetail($dt_w_comment,"tb_comment_aduan","id_tb_comment_aduan","ASC");
                $ttl_respon_user=0;
                $ttl_respon_admin=0;
                foreach ($stmt_comment->result() as $val_comment) {
                    if (!empty($val_comment->id_tb_user)){
                        $ttl_respon_user+=1;
                    }
                    if (!empty($val_comment->id_tb_admin)){
                        $ttl_respon_admin+=1;
                    }
                }
                $dt[$no]['ttl_respon_user']=$ttl_respon_user;
                $dt[$no]['ttl_respon_admin']=$ttl_respon_admin;
                $dt[$no]['alamat']=getAddress($val->lati,$val->longi);
                $dt[$no]['cdate']=setTglIndo($val->cdate);

                $no_2=0;
                $dt_komentar=array();
                $stmt=$this->Mpelayanan->getDataDetail($dt_w_comment,"tb_comment_aduan","id_tb_aduan","ASC");
                foreach ($stmt->result() as $item) {
                    $no_2++;
                    $dt_komentar[$no_2]['no']=$no_2;
                    $dt_komentar[$no_2]['isi_komentar']=$item->isi_comment;
                    $dt_komentar[$no_2]['img_comment']=$item->img_comment;
                    if (!empty($item->id_tb_user)){
                        $dt_komentar[$no_2]['nama_pengirim']=getValueWhere("nama_user","tb_user","id_tb_user",$item->id_tb_user)->row()->nama_user;
                    } else if (!empty($item->id_tb_admin)){
                        $dt_komentar[$no_2]['nama_pengirim']=getValueWhere("nama_admin","tb_admin","id_tb_admin",$item->id_tb_admin)->row()->nama_admin;
                    }
                    $dt_komentar[$no_2]['cdate']=setTglIndo($item->cdate);
                }
                $dt[$no]['komentar']=$dt_komentar;
            }
            $data['data']=$dt;
        } else if ($jenis=="grafik"){
            $dt_grafik=array();$label="";
            $dt_thn=$this->Mpelayanan->getDataSelect("max(year(cdate)) as thn_max,min(year(cdate)) as thn_min","tb_aduan");
            if ($dt_thn->num_rows()>0){
                $thn_max=$dt_thn->row()->thn_max;
                $thn_min=$dt_thn->row()->thn_min;
                for ($i=$thn_min;$i<=$thn_max;$i++){
                    $dt_tahun[$i]['tahun']=$i;
                }
            }
            for ($i=$thn_min;$i<=$thn_max;$i++){
                $dt_where=array('deleted_flage'=>"1");
                $stmt=$this->Mpelayanan->getDataDetail($dt_where,"tb_admin","id_tb_admin","ASC");
                foreach ($stmt->result() as $val){
                    $dt_where_2=array('deleted_flage'=>"1",'id_tb_admin'=>$val->id_tb_admin);
                    $stmt_2=$this->Mpelayanan->getDataWhereLikeOrder("cdate",$i,$dt_where_2,"tb_aduan","id_tb_aduan","ASC");
                    if ($stmt_2->num_rows() > 0){
                        $jml=$stmt_2->num_rows();
                    } else {
                        $jml=0;
                    }
                    $nm_admin = str_replace(" ","_",strtolower($val->nama_admin));
                    $dt_grafik = array_merge($dt_grafik,array("year"=>$i,$nm_admin=>$jml));
                }
                $data_grafik[] = $dt_grafik;
            }

            $data_label=array();
            $dt_where=array('deleted_flage'=>"1");
            $stmt=$this->Mpelayanan->getDataDetail($dt_where,"tb_admin","id_tb_admin","ASC");
            foreach ($stmt->result() as $item) {
                $nm_admin = str_replace(" ","_",strtolower($item->nama_admin));
                $label = array("balloonText"=>"<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas"=>"0.8",
                    "labelText"=>"[[value]]",
                    "lineAlpha"=>"0.3",
                    "title"=>$item->nama_admin,
                    "type"=>"column",
                    "color"=>"#000000",
                    "valueField"=>$nm_admin);
                $data_label[] = $label;
            }


            $data['data_grafik'] = $data_grafik;
            $data['data_label'] = $data_label;
        }
        $data['page']=$jenis;
        $this->load->view('superadmin/laporan/index',$data);
    }

	public function catatan(){
        $dt_where = array('deleted_flage'=>"1");
        $stmt=$this->Mpelayanan->getDataDetail($dt_where,"tb_log","id_tb_log","DESC");
        $dt=array();
        $i=0;
        foreach ($stmt->result() as $val) {
            $i++;
            $dt[$i]['keterangan']=$val->keterangan;
            $dt[$i]['waktu']=waktu_lalu($val->cdate);
            if ($val->id_tb_user!=0){
                $dt[$i]['pengguna']="User";
                $stmt_user=getValueWhere('nama_user','tb_user','id_tb_user',$val->id_tb_user);
                if ($stmt_user->num_rows()>0){
                    $dt[$i]['nama_pengguna']=$stmt_user->row()->nama_user;
                } else {
                    $dt[$i]['nama_pengguna']="-";
                }
            } else if ($val->id_tb_superadmin!=0){
                $dt[$i]['pengguna']="Superadmin";
                $stmt_pengguna=getValueWhere('nama_superadmin','tb_superadmin','id_tb_superadmin',$val->id_tb_superadmin);
                if ($stmt_pengguna->num_rows()>0){
                    $dt[$i]['nama_pengguna']=$stmt_pengguna->row()->nama_superadmin;
                } else {
                    $dt[$i]['nama_pengguna']="-";
                }
            } else if ($val->id_tb_admin!=0){
                $dt[$i]['pengguna']="Admin";
                $stmt_admin=getValueWhere('nama_admin','tb_admin','id_tb_admin',$val->id_tb_admin);
                if ($stmt_admin->num_rows()>0){
                    $dt[$i]['nama_pengguna']=$stmt_admin->row()->nama_admin;
                } else {
                    $dt[$i]['nama_pengguna']="-";
                }
            }
        }
        $data['data']=$dt;
	    $data['page']="index";
        $this->template->superadmin('superadmin/catatan/index',$data);
    }

	public function modal()
	{
		$type=$this->input->get('type');
		if ($type=="tambah_lokasi") {
			$dt = array('deleted_flage'=>"1");
			$data['dt_jenis_lokasi'] = $this->Mpelayanan->getDataDetail($dt,"tb_jenis_lokasi_tempat_umum","id_tb_jenis_lokasi_tempat_umum","ASC");
			$data['lati']=$this->input->get('lati');
			$data['longi']=$this->input->get('longi');
		} elseif ($type=="ubah_password_admin") {
			$data['id_admin']=$this->input->get('id');
		} elseif ($type=="ubah_password_user") {
            $data['id_user']=$this->input->get('id');
        } elseif ($type=="ubah_password_superadmin"){
            $data['id_superadmin']=$this->session->userdata('id_tb_superadmin');
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
        }

		$data['modal']=$type;
		$this->load->view('style/modal_superadmin',$data);
	}

    public function logout()
    {
        $dt = array('keterangan'=>"Superadmin log-out dari aplikasi",
            'id_tb_superadmin'=>"1",'cdate'=>date('Y-m-d H:i:s'),'input_by'=>"1",'input_ket'=>"superadmin");
        $this->log($dt);
        $this->session->sess_destroy();
        redirect(base_url('Sistem'));
    }

    public function log($dt)
    {
        $this->Mpelayanan->input_data("tb_log",$dt);
    }

}
