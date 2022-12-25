<?php
function waktu_lalu($timestamp)
{
    $selisih = time() - strtotime($timestamp);
    $detik = $selisih;
    $menit = round($selisih/60);
    $jam = round($selisih/3600);
    $hari = round($selisih/86400);
    $minggu = round($selisih/604800);
    $bulan = round($selisih/2419200);
    $tahun = round($selisih/29030400);
    global $waktu_lalu;
    $waktu_jam = substr($waktu_lalu,11,5);
    if ($detik <= 30)
    {
        $waktu = ' baru saja';
    }
    elseif ($detik <= 60)
    {
        $waktu = $detik.' detik yang lalu';
    }
    elseif ($menit <= 60)
    {
        $waktu = $menit.' menit yang lalu';
    }
    elseif ($jam <= 24)
    {
        $waktu = $jam.' jam yang lalu';
    }
    elseif ($hari <= 1)
    {
        $waktu = ' kemarin '.$waktu_jam;
    }
    elseif ($hari <= 7)
    {
        $waktu = $hari.' hari yang lalu '.$waktu_jam;
    }
    elseif ($minggu <= 4)
    {
        $waktu = $minggu.' minggu yang lalu '.$waktu_jam;
    }
    elseif ($bulan <= 12)
    {
        $waktu = $bulan.' bulan yang lalu '.$waktu_jam;
    }
    else {
        $waktu = $tahun.' tahun yang lalu '.$waktu_jam;
    }
    return $waktu;
}
function getValueWhere($value,$tb,$field,$where)
{
  $ci =& get_instance();
  $ci->load->database();
  $result = $ci->db->select($value)->where($field, $where)->get($tb);
  return $result;
}
function setTglIndo($cdate)
{
  $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
  $hari=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
  $wkt_indo = strtotime($cdate);
  return $hari[date("w",$wkt_indo)].", ".date("j",$wkt_indo)." ".$bulan[date("n",$wkt_indo)]." ".date("Y",$wkt_indo);
}
function safe_b64encode($string) {
  $data = base64_encode($string);
  $data = str_replace(array('+','/','='),array('-','_',''),$data);
  return $data;
}
function safe_b64decode($string) {
  $data = str_replace(array('-','_'),array('+','/'),$string);
  $mod4 = strlen($data) % 4;
  if ($mod4) {
      $data .= substr('====', $mod4);
  }
  return base64_decode($data);
}
function safe_encode($value){
  if(!$value){return false;}
    $text = $value;
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, "FirdausShinoda12", $text, MCRYPT_MODE_ECB, $iv);
    $data = base64_encode($crypttext);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return trim($data);
}
function safe_decode($value){
    if(!$value){return false;}
    $data = str_replace(array('-','_'),array('+','/'),$value);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $crypttext = base64_decode($data);
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, "FirdausShinoda12", $crypttext, MCRYPT_MODE_ECB, $iv);
    return trim($decrypttext);
}
function setTglIndoSurat($cdate)
{
    $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $wkt_indo = strtotime($cdate);
    return date("j",$wkt_indo)." ".$bulan[date("n",$wkt_indo)]." ".date("Y",$wkt_indo);
}

function getAddress($latitude,$longitude){
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false&key=AIzaSyCnNpZ0vxJXqcMDTaclUEIxUTUB8Izb1V0', false, stream_context_create($arrContextOptions));
    $output = json_decode($geocodeFromLatLong);
    $status = $output->status;
    $address = ($status=="OK")?$output->results[0]->formatted_address:'';
    //Return address of the given latitude and longitude
    if(!empty($address)){
        return $address;
    }else{
        return "Nama Jalan tidak terdeteksi";
    }
}
?>
