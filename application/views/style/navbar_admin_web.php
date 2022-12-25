<link href="<?php echo base_url('assets/materialize/style_index/style.min.css');?>" type="text/css" rel="stylesheet" media="screen,projection">
<a href="javascript:void(0);" class="brand-logo">
    <img class="responsive-img style-logo" src="<?php echo base_url('assets/document/style/img/icon_1.png')?>" alt="Pelayanan Publik">
</a>
<ul class="right hide-on-med-and-down">
    <li>
        <p><?php echo $this->session->userdata('nama_admin');?></p>
    </li>
    <li>
        <div class="circle responsive-img" style="margin-top: 25%;width: 30px;height: auto;margin-right: 10%">
            <img src="<?php echo base_url('assets/document/img/admin')."/".$this->session->userdata('img_admin');?>" alt="profile image" class="circle responsive-img activator">
        </div>
    </li>
    <li>
        <a href="<?php echo base_url('Aduan')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Beranda">
            <i class="material-icons">home</i>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('peta')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Lokasi">
            <i class="material-icons">map</i>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('notifikasi')?>" class="waves-effect waves-block waves-light translation-button tooltipped" data-position="bottom" data-delay="50" data-tooltip="Pemberitahuan">
            <i class="material-icons">notifications<small class="notification-badge" style="display: none" id="notif_active">0</small></i>
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
        <a href="<?php echo base_url('profil')?>"><i class="material-icons left">perm_identity</i>Profil</a>
    </li>
    <li>
        <a href="<?php echo base_url('logout')?>"><i class="material-icons left">exit_to_app</i>Log Out</a>
    </li>
</ul>
<div class="container">
    <a href="#" data-activates="nav-mobile" class="button-collapse" style="color: #fff"><i class="material-icons">menu</i></a>
</div>
<script type="text/javascript">
    var ttl=0;
    var first_load=true;
    setInterval("getNotif()",15000);
    getNotif();
    function getNotif() {
        $.ajax(
            {
                url: "<?php echo base_url('Admin/getNotifAdminWeb'); ?>"
            }
        ).done(function(data){
            if (first_load==true){
                ttl=data;
                first_load=false;
            } else {
                if (data>ttl){
                    $('#notif_active').show();
                    setTimeout(function() {
                        Materialize.toast('<span>Ada pemberitahuan baru.</span>', 3000);
                    }, 2000);
                }
                ttl=data;
            }
        });
    }
</script>