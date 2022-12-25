<?php

define('FPDF_FONTPATH',APPPATH .'plugins/font/');
require(APPPATH .'plugins/fpdf.php');

class Print_PDF_Laporan extends FPDF {

    function __construct()
    {
        parent::__construct();
        $ci =& get_instance();
        $ci->load->helper('library_helper');
        $ci->load->model('Mpelayanan');
    }

    function judul()
    {
        $this->image('assets/document/style/img/logo_kota_tegal.png',30,12,20,20);
        $this->Cell(25);
        $this->SetFont('Times','B','18');
        $this->Cell(0,15,"LAPORAN ADUAN INSTANSI PEMERINTAH",0,1,'C');
        $this->Cell(25);
        $this->SetFont('Times','B','14');
        $this->Cell(0,1,"KOTA TEGAL",0,1,'C');
        $this->garis();
    }

    function garis()
    {
        $this->SetLineWidth(1);
        $this->Line(10,35,290,35);
        $this->SetLineWidth(0);
        $this->Line(10,34,290,34);
    }

    function ket()
    {
        $this->Cell(5);
        $this->cell(0,15,"",0,1);
        $this->Cell(230);
        $this->setFont('times','',12);
        $this->cell(0,5,"Tegal, ".setTglIndoSurat(date('Y-m-d')),0,1);
    }

    function tabel($jenis,$thn)
    {
        $this->Ln();
        $this->Cell(1);
        $this->setFont('times','B',10);
        //$this->SetFillColor(217,237,247);
        $this->Cell(10,7,"No",1,0,'C',false);
        $this->Cell(50,7,"Isi Aduan",1,0,'C',false);
        $this->Cell(35,7,"Nama Pengadu",1,0,'C',false);
        $this->Cell(35,7,"Nama Instansi",1,0,'C',false);
        $this->Cell(35,7,"Respon Masyarakat",1,0,'C',false);
        $this->Cell(27,7,"Respon Admin",1,0,'C',false);
        $this->Cell(45,7,"Alamat",1,0,'C',false);
        $this->Cell(40,7,"Tanggal Aduan",1,0,'C',false);
        $this->Ln();

        $CI = get_instance();
        if ($jenis=="semua"){
            $dt_where=array('deleted_flage'=>"1");
        } else {
            $dt_where=array('deleted_flage'=>"1",'id_tb_aduan'=>$jenis);
        }
        $dt=array();$no=0;
        $stmt=$CI->Mpelayanan->getDataWhereLikeOrder("cdate",$thn,$dt_where,"tb_aduan","id_tb_aduan","ASC");
        foreach ($stmt->result() as $val){
            $no++;
            $dt_w_comment=array('id_tb_aduan'=>$val->id_tb_aduan);
            $dt_w_user=array('id_tb_user'=>$val->id_tb_user);
            $dt_w_admin=array('id_tb_admin'=>$val->id_tb_admin);
            $dt[$no]['no']=$no;
            $dt[$no]['isi_aduan']=$val->isi_aduan;
            $dt[$no]['nama_user']=$CI->Mpelayanan->getDataDetail($dt_w_user,"tb_user","id_tb_user","ASC")->row()->nama_user;
            $dt[$no]['nama_admin']=$CI->Mpelayanan->getDataDetail($dt_w_admin,"tb_admin","id_tb_admin","ASC")->row()->nama_admin;
            $stmt_comment=$CI->Mpelayanan->getDataDetail($dt_w_comment,"tb_comment_aduan","id_tb_comment_aduan","ASC");
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
            $stmt=$CI->Mpelayanan->getDataDetail($dt_w_comment,"tb_comment_aduan","id_tb_aduan","ASC");
            foreach ($stmt->result() as $item) {
                $no_2++;
                $dt_komentar[$no_2]['no']=$no_2;
                $dt_komentar[$no_2]['isi_komentar']=json_decode('"'.$item->isi_comment.'"');
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
        $ttl_debit=0;$ttl_credit=0;$ttl_jml="";
        foreach ($dt as $key) {
            $this->setFont('times','',12);
            $this->SetWidths(array(10,50,35,35,35,27,45,40));
            $this->SetAligns(array('C','','','','C','C','','C'));
            $this->Cell(1);
            $this->setFont('times','',10);
            //$this->SetFillColor(245,245,245);
            $this->Row(array($key['no'],$key['isi_aduan'],$key['nama_user'],$key['nama_admin'],$key['ttl_respon_user'],$key['ttl_respon_admin'],$key['alamat'],$key['cdate']));

            $this->Cell(1);
            $this->setFont('times','B',10);
            //$this->SetFillColor(210,214,222);
            $this->Cell(10,7,"",1,0,'C',false);
            $this->Cell(50,7,"No",1,0,'C',false);
            $this->Cell(132,7,"Isi Komentar",1,0,'C',false);
            $this->Cell(45,7,"Nama Pengirim",1,0,'C',false);
            $this->Cell(40,7,"Waktu Mengirim",1,0,'C',false);
            $this->Ln();

            if (count($key['komentar']) > 0){
                foreach ($key['komentar'] as $item) {
                    $isi_komentar="";
                    if (!empty($item['img_comment'])){
                        $isi_komentar="(Gambar) ".preg_replace('/[^\x{20}-\x{7F}]/u','',$item['isi_komentar']);
                    } else {
                        $isi_komentar=preg_replace('/[^\x{20}-\x{7F}]/u','',$item['isi_komentar']);
                    }

                    $this->setFont('times','',12);
                    $this->SetWidths(array(10,50,132,45,40));
                    $this->SetAligns(array('','C','','','C'));
                    $this->Cell(1);
                    $this->setFont('times','',10);
                    //$this->SetFillColor(255,243,224);
                    $this->Row(array("",$item['no'],$isi_komentar,$item['nama_pengirim'],$item['cdate']));
                }
            } else {
                $this->setFont('times','',12);
                $this->SetWidths(array(277));
                $this->SetAligns(array('C'));
                $this->Cell(1);
                $this->setFont('times','',10);
                $this->Row(array("Tidak Ada Komentar"));
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------------------

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a,false);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
}
?>
