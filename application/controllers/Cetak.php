<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mpelayanan');
        $this->load->helper('library_helper');
        $this->load->helper('print_pdf_laporan');
        if (isset($this->session->userdata['logged_in_superadmin_pelayanan_publik']) != TRUE){
            redirect(base_url('Sistem'));
        }
    }

    public function index(){
        redirect(base_url('Superadmin/laporan'));
    }

    public function laporan(){
        $jns=$this->uri->segment(3);
        $thn=$this->uri->segment(4);
        $pdf = new Print_PDF_Laporan();
        $pdf->AddPage('L','A4');
        $pdf->judul();
        $pdf->ket();
        $pdf->tabel($jns,$thn);
        $pdf->Output('Laporan Tahunan Aduan Tahun '.$thn.'.pdf','I');
    }
}