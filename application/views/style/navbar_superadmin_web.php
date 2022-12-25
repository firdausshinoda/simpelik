<link href="<?php echo base_url('assets/materialize/style_index/style.min.css');?>" type="text/css" rel="stylesheet" media="screen,projection">
<a href="javascript:void(0);" class="brand-logo">
  <img class="responsive-img style-logo" src="<?php echo base_url('assets/document/style/img/icon_1.png')?>" alt="Pelayanan Publik">
</a>
<ul class="right hide-on-med-and-down">
    <li>
        <p><?php echo $this->session->userdata('nama_superadmin');?></p>
    </li>
    <li>
        <div class="circle responsive-img" style="margin-top: 50%;width: 30px;height: auto;margin-right: 10%">
            <img src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png');?>" alt="profile image" class="circle responsive-img activator">
        </div>
    </li>
    <li>
        <a href="<?php echo base_url('Superadmin')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Beranda">
            <i class="material-icons">home</i>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('Superadmin/lokasi_tempat_umum')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Lokasi">
            <i class="material-icons">map</i>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('Superadmin/admin')?>" class="waves-effect waves-block waves-light tooltipped"data-position="bottom" data-delay="50" data-tooltip="Instansi">
            <i class="material-icons">location_city</i>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('Superadmin/user')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Masyarakat">
            <i class="material-icons">people</i>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button dropdown-button" data-activates="menu-dropdown">
            <span><i class="material-icons">arrow_drop_down</i></span>
        </a>
    </li>
</ul>
<ul id="menu-dropdown" class="dropdown-content dropdown-content-nav">
  <li>
    <a href="<?php echo base_url('Superadmin/profil')?>"><i class="material-icons left">perm_identity</i>Profil</a>
  </li>
  <li>
    <a href="<?php echo base_url('Superadmin/laporan')?>"><i class="material-icons left">assessment</i>Laporan</a>
  </li>
  <li>
    <a href="<?php echo base_url('Superadmin/catatan')?>"><i class="material-icons left">library_books</i>Log Aktivitas</a>
  </li>
  <li>
    <a href="<?php echo base_url('Superadmin/logout')?>"><i class="material-icons left">exit_to_app</i>Log Out</a>
  </li>
</ul>
<div class="container">
    <a href="#" data-activates="nav-mobile" class="button-collapse" style="color: #fff"><i class="material-icons">menu</i></a>
</div>
