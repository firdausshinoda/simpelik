<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Mpelayanan extends CI_Model
{

    public function getDataDetail($data,$tabel,$primary,$order)
    {
        return $this->db->order_by($primary,$order)->get_where($tabel,$data);
    }

    public function getDataDetailPagi($data,$tabel,$primary,$order,$limit)
    {
        return $this->db->order_by($primary,$order)->limit($limit,0)->get_where($tabel,$data);
    }

    public function getDataAduanListAPI($id_aduan,$id_user,$id_admin,$stt_pagi,$dari)
    {
        $this->db->select('tb_user.id_tb_user,tb_user.nama_user,tb_user.img_user,
          tb_aduan.id_tb_aduan,tb_aduan.isi_aduan,tb_aduan.cdate,tb_aduan.lati,tb_aduan.longi,
          tb_aduan.id_tb_admin,tb_admin.nama_admin')->order_by('tb_aduan.id_tb_aduan',"DESC")
            ->join('tb_user','tb_user.id_tb_user = tb_aduan.id_tb_user')
            ->join('tb_admin','tb_admin.id_tb_admin = tb_aduan.id_tb_admin');
        if (!empty($id_aduan)) {
            $this->db->where('tb_aduan.id_tb_aduan',$id_aduan);
        }
        if (!empty($id_user)) {
            $this->db->where('tb_aduan.id_tb_user',$id_user);
        }
        if (!empty($id_admin)) {
            $this->db->where('tb_aduan.id_tb_admin',$id_admin);
        }
        if ($stt_pagi=="pagi"){
            $this->db->limit(5,$dari);
        }
        return $this->db->where('tb_aduan.deleted_flage',"1")->get('tb_aduan');
    }

    public function getDataAduanListWeb($id_aduan,$id_user,$id_admin)
    {
        $this->db->select('tb_user.id_tb_user,tb_user.nama_user,tb_user.img_user,
          tb_aduan.id_tb_aduan,tb_aduan.isi_aduan,tb_aduan.cdate,tb_aduan.lati,tb_aduan.longi,
          tb_aduan.id_tb_admin,tb_admin.nama_admin')->order_by('tb_aduan.id_tb_aduan',"DESC")
            ->join('tb_user','tb_user.id_tb_user = tb_aduan.id_tb_user')
            ->join('tb_admin','tb_admin.id_tb_admin = tb_aduan.id_tb_admin');
        if (!empty($id_aduan)) {
            $this->db->where('tb_aduan.id_tb_aduan',$id_aduan);
        }
        if (!empty($id_user)) {
            $this->db->where('tb_aduan.id_tb_user',$id_user);
        }
        if (!empty($id_admin)) {
            $this->db->where('tb_aduan.id_tb_admin',$id_admin);
        }
        return $this->db->where('tb_aduan.deleted_flage',"1")->get('tb_aduan');
    }

    public function getSearchAduan($search,$dari)
    {
        $this->db->select('tb_user.id_tb_user,tb_user.nama_user,tb_user.img_user,
          tb_aduan.id_tb_aduan,tb_aduan.isi_aduan,tb_aduan.cdate,tb_aduan.lati,tb_aduan.longi,
          tb_aduan.id_tb_admin,tb_admin.nama_admin')->order_by('tb_aduan.id_tb_aduan',"DESC")
            ->join('tb_user','tb_user.id_tb_user = tb_aduan.id_tb_user')
            ->join('tb_admin','tb_admin.id_tb_admin = tb_aduan.id_tb_admin')
            ->like('tb_admin.nama_admin',$search)
            ->or_like('tb_aduan.isi_aduan',$search)
            ->limit(5,$dari);
        return $this->db->where('tb_aduan.deleted_flage',"1")->get('tb_aduan');
    }

    public function getDataKomentarAduan($id)
    {
        return $this->db->select('tb_comment_aduan.id_tb_comment_aduan,tb_comment_aduan.isi_comment,
                      tb_comment_aduan.img_comment,tb_comment_aduan.cdate,tb_user.id_tb_user,
                      tb_user.nama_user,tb_user.img_user')
            ->join('tb_user','tb_user.id_tb_user=tb_comment_aduan.id_tb_user')
            ->where('tb_comment_aduan.id_tb_aduan',$id)->order_by('tb_comment_aduan.id_tb_comment_aduan',"DESC")
            ->get('tb_comment_aduan');
    }

    public function getNotifAduanUser($dt_where)
    {
        $this->db->select('tb_aduan.id_tb_aduan,tb_aduan.isi_aduan,tb_aduan.lati,tb_aduan.longi,
          tb_aduan.id_tb_admin,tb_aduan.id_tb_user,tb_aduan.cdate as cdate_aduan,
          tb_comment_aduan.id_tb_comment_aduan,
          tb_comment_aduan.id_tb_user as id_user_comment,tb_comment_aduan.id_tb_admin as id_admin_comment,
          tb_comment_aduan.isi_comment,tb_comment_aduan.cdate as cdate_comment,
          tb_user.nama_user,tb_user.img_user,tb_admin.nama_admin')
            ->order_by('tb_comment_aduan.id_tb_comment_aduan',"DESC")
            ->join('tb_aduan','tb_aduan.id_tb_aduan = tb_comment_aduan.id_tb_aduan')
            ->join('tb_user','tb_user.id_tb_user = tb_aduan.id_tb_user')
            ->join('tb_admin','tb_admin.id_tb_admin = tb_aduan.id_tb_admin');
        return $this->db->where('tb_aduan.deleted_flage',"1")
            ->where($dt_where)->get('tb_comment_aduan');
    }

    public function getNotifAdmin($dt_where)
    {
        $this->db->select('tb_aduan.id_tb_aduan,tb_aduan.isi_aduan,tb_aduan.lati,tb_aduan.longi,
          tb_aduan.id_tb_admin,tb_aduan.id_tb_user,tb_aduan.cdate as cdate_aduan,
          tb_comment_aduan.id_tb_comment_aduan,
          tb_comment_aduan.id_tb_user as id_user_comment,tb_comment_aduan.id_tb_admin as id_admin_comment,
          tb_comment_aduan.isi_comment,tb_comment_aduan.cdate as cdate_comment,
          tb_user.nama_user,tb_user.img_user,tb_admin.nama_admin')
            ->order_by('tb_comment_aduan.id_tb_comment_aduan',"DESC")
            ->join('tb_aduan','tb_aduan.id_tb_aduan = tb_comment_aduan.id_tb_aduan')
            ->join('tb_user','tb_user.id_tb_user = tb_aduan.id_tb_user')
            ->join('tb_admin','tb_admin.id_tb_admin = tb_aduan.id_tb_admin');
        return $this->db->where('tb_aduan.deleted_flage',"1")->where('tb_comment_aduan.deleted_flage',"1")
            ->where($dt_where)->get('tb_comment_aduan');
    }

    public function getSearchLokasi($nama)
    {
        $this->db->select('tb_lokasi_tempat_umum.id_tb_lokasi_tempat_umum,tb_lokasi_tempat_umum.nama_lokasi,
            tb_lokasi_tempat_umum.lati,tb_lokasi_tempat_umum.longi,tb_lokasi_tempat_umum.lati,
            tb_jenis_lokasi_tempat_umum.id_tb_jenis_lokasi_tempat_umum,
            tb_jenis_lokasi_tempat_umum.nama_jenis_lokasi')
            ->order_by('tb_lokasi_tempat_umum.id_tb_lokasi_tempat_umum','DESC')
            ->join('tb_jenis_lokasi_tempat_umum','tb_jenis_lokasi_tempat_umum.id_tb_jenis_lokasi_tempat_umum = tb_lokasi_tempat_umum.id_tb_jenis_lokasi_tempat_umum')
            ->like('tb_lokasi_tempat_umum.nama_lokasi',$nama)
            ->limit(7)
            ->where('tb_lokasi_tempat_umum.deleted_flage',"1");
        return $this->db->get('tb_lokasi_tempat_umum');
    }

    public function getDataSelect($field,$tabel)
    {
        return $this->db->select($field)->where('deleted_flage',"1")->get($tabel);
    }

    public function input_data_returnId($tabel,$data)
    {
        $this->db->insert($tabel,$data);
        return $this->db->insert_id();
    }

    public function input_data($tabel,$data)
    {
        return $this->db->insert($tabel,$data);
    }

    public function update_data($data_where,$data,$tabel)
    {
        return $this->db->where($data_where)->update($tabel,$data);
    }

    public function delete_data($data,$tabel)
    {
        return $this->db->where($data)->delete($tabel);
    }

    public function getDataSelectWhere($select,$data,$tabel,$group,$field_group)
    {
        $this->db->select($select);
        if ($group!="") {
            $this->db->group_by($field_group);
        }
        return $this->db->where($data)->get($tabel);
    }

    public function getDataWhereLikeOrder($field,$dt_like,$data,$tabel,$primary_order,$order_by)
    {
        return $this->db->order_by($primary_order,$order_by)->like($field,$dt_like)->get_where($tabel,$data);
    }

    public function getLokasiTerdeakt($id_jenis_lokasi,$lati,$longi)
    {
        return $this->db->query("SELECT id_tb_jenis_lokasi_tempat_umum,id_tb_lokasi_tempat_umum,nama_lokasi,lati,longi,
              (6371 * ACOS(SIN(RADIANS(lati)) * SIN(RADIANS($lati)) + COS(RADIANS(longi - $longi)) * COS(RADIANS(lati)) * COS(RADIANS($lati)))) 
              AS jarak FROM tb_lokasi_tempat_umum WHERE id_tb_jenis_lokasi_tempat_umum = $id_jenis_lokasi HAVING jarak < 2 ORDER BY jarak;");
    }
}

?>
