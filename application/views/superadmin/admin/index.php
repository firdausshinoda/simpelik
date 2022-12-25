<?php if ($page=="index") :?>
    <div class="demo-ribbon blue-grey lighten-2"></div>
    <div class="col s12 m12 l12 demo-main" style="height:100%">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s10 m10 offset-m1">
                <div class="row">
                    <?php foreach ($result->result() as $val): ?>
                        <div class="col s3">
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light" style="background:#000;display:block;width: 100%;position: relative;height: 200px;padding: 56.25% 0 0 0;overflow: hidden;">
                                    <?php if (empty($val->img_admin)): ?>
                                        <img class="activator" style="position: absolute;display: block;margin: auto;left: 0;right: 0;top: 0;bottom: 0;" src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>">
                                    <?php else: ?>
                                        <img class="activator" style="position: absolute;display: block;margin: auto;left: 0;right: 0;top: 0;bottom: 0;" src="<?php echo base_url('assets/document/img/admin/'.$val->img_admin)?>">
                                    <?php endif; ?>
                                </div>
                                <div class="card-content">
                                    <p><a href="<?php echo base_url('Superadmin/detail_admin')."/".safe_encode($val->id_tb_admin);?>"><?php echo $val->nama_admin; ?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
        <a href="<?php echo base_url('Superadmin/add_admin');?>" id="add_admin" class="waves-effect waves-light btn-floating btn-large pink lighten-1">
            <i class="material-icons">person_add</i>
        </a>
    </div>
    <div class="tap-target blue lighten-1" data-activates="add_admin">
        <div class="tap-target-content">
            <h5>Tambah Admin</h5>
            <p>Anda dapat menambahkan admin dengan menekan tombol ini.</p>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tap-target').tapTarget('open');
        });
    </script>
<?php endif; ?>
<?php if ($page=="detail"): ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnNpZ0vxJXqcMDTaclUEIxUTUB8Izb1V0&?sensor=true"></script>
    <div class="container">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s10 m10 l10 offset-s1 offset-m1 offset-l1">
                    <div id="profile-page" class="section">
                        <div id="profile-page-header" class="card">
                            <div class="card-image waves-effect waves-block waves-light" style="height:350px;">
                                <?php if ($val_gallery->num_rows() > 0): ?>
                                    <img class="activator" src="<?php echo base_url('assets/document/img/admin_gallery/'.$val_gallery->row()->img_gallery_admin)?>" alt="user background">
                                <?php else: ?>
                                    <img class="activator" src="<?php echo base_url('assets/document/style/img/bg_slide_2.jpg')?>" alt="user background">
                                <?php endif; ?>
                            </div>
                            <figure class="card-profile-image" style="top:290px;">
                                <div class="center-cropped-large">
                                    <?php if (empty($val->img_admin)) : ?>
                                        <img src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
                                    <?php else: ?>
                                        <img src="<?php echo base_url('assets/document/img/admin/'.$val->img_admin)?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
                                    <?php endif; ?>
                                </div>
                            </figure>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s3 offset-s2">
                                        <h4 class="card-title grey-text text-darken-4"><?php echo $val->nama_admin; ?></h4>
                                        <p class="medium-small grey-text">Kota Tegal</p>
                                    </div>
                                    <div class="col s6 center-align">
                                        <h4 class="card-title grey-text text-darken-4"><?php echo $val_num_rows; ?></h4>
                                        <p class="medium-small grey-text">Aduan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="profile-page-content" class="row">
                        <div id="profile-page-sidebar" class="col s5 m5">
                            <div id="profile-page-wall-posts"class="row">
                                <div class="col s12">
                                    <div id="profile-page-wall-post" class="card">
                                        <div class="progress" id="load-progress-profil" style="margin: 0 0 0 0;display:none;">
                                            <div class="indeterminate"></div>
                                        </div>
                                        <div class="card-profile-title">
                                            <div class="row">
                                                <div class="col s2">
                                                    <div class="center-cropped-small">
                                                        <?php if (empty($val->img_admin)) : ?>
                                                            <img src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>" alt="profile image" class="circle responsive-img valign profile-post-uer-image">
                                                        <?php else: ?>
                                                            <img src="<?php echo base_url('assets/document/img/admin/'.$val->img_admin)?>" alt="profile image" class="circle responsive-img valign profile-post-uer-image">
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col s10">
                                                    <p class="grey-text text-darken-4 margin"><?php echo $val->nama_admin; ?></p>
                                                    <span class="grey-text text-darken-1 ultra-small">Ditambahkan Pada <?php echo setTglIndo($val->cdate); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="row">
                                                <form class="formValidate" id="formValidate">
                                                    <div class="col s12">
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <i class="material-icons prefix">home</i>
                                                                <input name="nama" type="text" id="nama" value="<?php echo $val->nama_admin;?>" placeholder="nama" disabled data-length="20">
                                                                <input name="id_admin" type="hidden" value="<?php echo $val->id_tb_admin;?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <i class="material-icons prefix">account_circle</i>
                                                                <input name="username" type="text" id="username" value="<?php echo $val->username;?>" placeholder="username" disabled data-length="15">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12 m12 l12">
                                                                <?php if (!empty($val->mdate)): ?>
                                                                    <span class="grey-text text-darken-1 ultra-small">Diubah pada <?php echo waktu_lalu($val->mdate); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <button type="button" class="btn-floating waves-effect waves-light red right modal-trigger"
                                                                        onclick="modal('ubah_password_admin','<?php echo $val->id_tb_admin;?>')"><i class="material-icons">lock</i></button>
                                                                <button type="button" class="btn-floating waves-effect waves-light light-blue right" id="btn_edit" onclick="btn_profil('1')"><i class="material-icons">edit</i></button>
                                                                <button type="submit" class="btn-floating waves-effect waves-light purple accent-4 right display_none" id="btn_send"><i class="material-icons">send</i></button>
                                                                <button type="button" class="btn-floating waves-effect waves-light yellow darken-2 right display_none" id="btn_close" onclick="btn_profil('0')"><i class="material-icons">close</i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-image profile-large">
                                    <div class="carousel carousel-slider center" data-indicators="true">
                                        <?php if ($val_gallery->num_rows() > 0): ?>
                                            <?php foreach ($val_gallery->result() as $value): ?>
                                                <a class="carousel-item" href="javascript:avoid()"><img class="responsive-img profile-large" src="<?php echo base_url('assets/document/img/admin_gallery/'.$value->img_gallery_admin)?>"></a>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="carousel-item red white-text" href="#one!">
                                                <h2>Gallery Admin</h2>
                                            </div>
                                            <div class="carousel-item blue white-text" href="#one!">
                                                <h2>Gallery Admin</h2>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content grey lighten-1">
                                    <span class="card-title"><b>Tentang</b></span>
                                </div>
                                <div class="card-content">
                                    <p><?php echo $val->deskripsi_admin; ?>.</p>
                                </div>
                            </div>
                            <div class="map-card">
                                <div class="card">
                                    <div class="card-image waves-effect waves-block waves-light">
                                        <div id="map-canvas" class="blue"></div>
                                    </div>
                                    <div class="card-content">
                                        <p>Peta Lokasi Instansi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="profile-page-wall" class="col s7 m7">
                            <div id="profile-page-wall-posts"class="row">
                                <?php if (count($data) > 0):?>
                                    <?php $i=0; foreach ($data as $value): $i++; ?>
                                        <div id="profile-page-wall-post" class="card">
                                            <div class="card-profile-title" style="padding:10px">
                                                <div class="row" style="margin-bottom:auto">
                                                    <div class="col s1">
                                                        <?php if (empty($value['img_user'])): ?>
                                                            <img src="<?php echo base_url('assets/document/style/img/profile.jpg')?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                                                        <?php else: ?>
                                                            <img src="<?php echo base_url('assets/document/img/user/'.$value['img_user'])?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col s10">
                                                        <p class="grey-text text-darken-4 margin"><?php echo $value['nama_user']; ?></p>
                                                        <span class="grey-text text-darken-1 ultra-small">Dibagikan pada - <?php echo $value['cdate']; ?></span>
                                                    </div>
                                                    <div class="col s1 right-align">
                                                        <a href="javascript:void(0);" data-activates="<?php echo "dropdown".$i?>" class="dropdown-button"><i class="material-icons">expand_more</i></a>
                                                        <ul id="<?php echo "dropdown".$i?>" class="dropdown-content dropdown-icon">
                                                            <li><a href="javascript:avoid()" onclick="deleteAduan('<?php echo $value['id_tb_aduan'];?>')"><i class="material-icons">delete</i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-image profile-large" style="height: 350px;">
                                                <div class="carousel carousel-slider center" data-indicators="true">
                                                    <?php $j=0; foreach ($value['gallery'] as $key): $j++; ?>
                                                        <a class="carousel-item" href="#four!"><img class="responsive-img profile-large" src="<?php echo base_url('assets/document/img/aduan_gallery/'.$key)?>"></a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="card-action">
                                                <a class="btn waves-effect waves-light blue right" href="<?php echo base_url('Superadmin/detail_post')."/".$value['id_tb_aduan'];?>">Baca Selengapnya...</a>
                                                <a class="btn-floating waves-effect waves-light light-blue right modal-trigger" style="margin-right:10px" onclick="mapAduan('<?php echo $value['lati'];?>',<?php echo $value['longi'];?>)"><i class="material-icons activator">location_on</i></a>
                                                <a class="btn-floating waves-effect waves-light pink lighten-1 right" style="margin-right:10px" href="javascript:avoid()"><i class="material-icons">comment</i></a>
                                                <a style="margin-right:0px" class="black-text right"><?php echo $value['ttl_komen']; ?></a>
                                                <button class="btn-floating waves-effect waves-light green accent-4 right" style="margin-right:10px"><i class="material-icons">thumb_up</i></button>
                                                <a style="margin-right:0px" class="black-text right"><?php echo $value['ttl_like']; ?></a>
                                            </div>
                                            <div class="card-content">
                                                <b><?php echo $value['nama_admin']; ?></b>
                                                <p><?php echo $value['isi_aduan']; ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                        <div id="profile-page-wall-post" class="card">
                                            <div class="card-content"><center>Tidak Ada Aduan</center></div>
                                        </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.carousel.carousel-slider').carousel({fullWidth: true});
        $(document).ready(function(){
            $('.modal').modal();
        });
        function btn_profil(str) {
            if (str==1) {
                $("#nama").prop('disabled', false);
                $("#username").prop('disabled', false);
                $("#btn_close").show();
                $("#btn_send").show();
                $("#btn_edit").hide();
            } else if (str==0) {
                $("#nama").prop('disabled', true);
                $("#username").prop('disabled', true);
                $("#btn_close").hide();
                $("#btn_send").hide();
                $("#btn_edit").show();
            }
        }
        function modal(str,str2) {
            $('#load-progress-profil').show();
            $.ajax(
                {
                    type: "GET",
                    data:{type:str,id:str2},
                    url: "<?php echo base_url('Superadmin/modal'); ?>",
                    success: function(data)
                    {
                        $('#load-progress-profil').hide();
                        $('#modal_dialog').html(data);
                        $('#modal_dialog').modal('open');
                    },
                    error:function(data){
                        $('#load-progress-profil').hide();
                        errorr();
                    }
                });
        }
        $(function() {
            $("#formValidate").validate({
                rules: {
                    nama: {
                        required: true,
                        maxlength: 20
                    },
                    username: {
                        required: true,
                        maxlength: 15
                    },
                },
                messages: {
                    nama: {
                        required: "Silahkan diisi...",
                        maxlength: "Maksimal 20 karakter."
                    },
                    username: {
                        required: "Silahkan diisi...",
                        maxlength: "Maksimal 15 karakter."
                    }
                },
                errorElement : 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    var values = $('#formValidate').serialize();
                    $('#load-progress-profil').show();
                    $.ajax({
                        type: "POST",data:values,url: "<?php echo base_url('Superadmin/ubah_profil_admin'); ?>",
                        success: function(data)
                        {
                            $('#load-progress-profil').hide();
                            if (data==1) {
                                window.location.reload();
                            } else if (data==0) {
                                setTimeout(function() {
                                    Materialize.toast('<span>Gagal menyimpan.</span>', 3000);
                                }, 100);
                            }
                            else { alert(data); }
                        },
                        error:function(data){
                            errorr();
                            $('#load-progress-profil').hide();
                        }
                    });
                }
            });
        });
        function deleteAduan(str) {
            swal({
                    title: "Anda Yakin?",
                    text: "Anda akan menghapus aduan!!!",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function(){
                    setTimeout(function(){
                        $.ajax({
                            type: "POST",data:{id:str},url: "<?php echo base_url('Superadmin/deleteAduan'); ?>",
                            success: function(data)
                            {
                                if (data==1) {
                                    swal({title: "Sukses!",type: "success",showConfirmButton: false,timer: 2000});
                                    window.location.reload();
                                } else {
                                    alert(data);
                                    swal("Oops...", "Terjadi kesalahan! Coba lagi.", "error");
                                }
                            },
                            error:function(data)
                            {swal("Oops...", "Terjadi kesalahan!!! Coba lagi.", "error");}
                        });
                    }, 2000);
                });
        }
        function mapAduan(lati,longi) {
            $('#load-progress-navbar').show();
            var str="map_aduan";
            $.ajax(
                {
                    type: "GET",
                    data:{type:str,lati:lati,longi:longi},
                    url: "<?php echo base_url('Superadmin/modal'); ?>",
                    success: function(data)
                    {
                        $('#load-progress-navbar').hide();
                        $('#modal_dialog').html(data);
                        $('#modal_dialog').modal('open');
                    },
                    error:function(data){
                        $('#load-progress-navbar').hide();
                        setTimeout(function() {
                            Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                        }, 100);
                    }
                });
        }
        var map;
        function initMap() {
            var uluru = {lat: -6.872020764416118, lng: 109.11872149999999};
            var position = {lat: <?php echo $val->lati;?>, lng: <?php echo $val->longi;?>};

            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            var time_now = h;
            var style_map;
            if (time_now >= 6 && time_now <= 18){
                style_map=[
                    {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
                    {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
                    {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
                    {
                        featureType: 'administrative',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#c9b2a6'}]
                    },
                    {
                        featureType: 'administrative.land_parcel',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#dcd2be'}]
                    },
                    {
                        featureType: 'administrative.land_parcel',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#ae9e90'}]
                    },
                    {
                        featureType: 'landscape.natural',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#93817c'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'geometry.fill',
                        stylers: [{color: '#a5b076'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#447530'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{color: '#f5f1e6'}]
                    },
                    {
                        featureType: 'road.arterial',
                        elementType: 'geometry',
                        stylers: [{color: '#fdfcf8'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry',
                        stylers: [{color: '#f8c967'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#e9bc62'}]
                    },
                    {
                        featureType: 'road.highway.controlled_access',
                        elementType: 'geometry',
                        stylers: [{color: '#e98d58'}]
                    },
                    {
                        featureType: 'road.highway.controlled_access',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#db8555'}]
                    },
                    {
                        featureType: 'road.local',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#806b63'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#8f7d77'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'labels.text.stroke',
                        stylers: [{color: '#ebe3cd'}]
                    },
                    {
                        featureType: 'transit.station',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry.fill',
                        stylers: [{color: '#b9d3c2'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#92998d'}]
                    }
                ];
            } else {
                style_map=[
                    {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                    {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                    {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                    {
                        featureType: 'administrative.locality',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#d59563'}]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#d59563'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'geometry',
                        stylers: [{color: '#263c3f'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#6b9a76'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{color: '#38414e'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#212a37'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#9ca5b3'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry',
                        stylers: [{color: '#746855'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#1f2835'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#f3d19c'}]
                    },
                    {
                        featureType: 'transit',
                        elementType: 'geometry',
                        stylers: [{color: '#2f3948'}]
                    },
                    {
                        featureType: 'transit.station',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#d59563'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [{color: '#17263c'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#515c6d'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.stroke',
                        stylers: [{color: '#17263c'}]
                    }
                ];
            }

            map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 16,
                center: position,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.LEFT_BOTTOM
                },
                gestureHandling: 'greedy',
                fullscreenControl: false,
                styles: style_map
            });


            var marker = new google.maps.Marker({
                position: position,
                map: map
            });


            var wilayah_kotategal = [

                {lng: 109.152236938477, lat: -6.84749984741205},
                {lng: 109.152122497559, lat: -6.84863996505726},
                {lng: 109.152008056641, lat: -6.84936904907227},
                {lng: 109.151809692383, lat: -6.85067892074579},
                {lng: 109.151329040527, lat: -6.85340118408197},
                {lng: 109.150405883789, lat: -6.85630893707275},
                {lng: 109.149368286133, lat: -6.86114978790278},
                {lng: 109.149261474609, lat: -6.86566019058222},
                {lng: 109.148582458496, lat: -6.86996078491211},
                {lng: 109.148307800293, lat: -6.87205982208252},
                {lng: 109.147537231445, lat: -6.87383079528809},
                {lng: 109.14720916748, lat: -6.87608003616333},
                {lng: 109.146713256836, lat: -6.87756919860834},
                {lng: 109.146392822266, lat: -6.87823915481567},
                {lng: 109.145797729492, lat: -6.8787989616394},
                {lng: 109.145156860352, lat: -6.87921905517578},
                {lng: 109.144546508789, lat: -6.87945985794062},
                {lng: 109.143867492676, lat: -6.87951993942255},
                {lng: 109.143348693848, lat: -6.87962913513184},
                {lng: 109.142906188965, lat: -6.88016891479492},
                {lng: 109.142807006836, lat: -6.88095998764038},
                {lng: 109.143119812012, lat: -6.88201999664301},
                {lng: 109.144065856934, lat: -6.8836989402771},
                {lng: 109.145050048828, lat: -6.88552093505859},
                {lng: 109.145156860352, lat: -6.88664913177485},
                {lng: 109.14501953125, lat: -6.88856077194214},
                {lng: 109.144508361816, lat: -6.89004898071289},
                {lng: 109.144256591797, lat: -6.89148998260498},
                {lng: 109.143798828125, lat: -6.89417886734003},
                {lng: 109.142967224121, lat: -6.89375019073481},
                {lng: 109.141532897949, lat: -6.89391899108887},
                {lng: 109.140083312988, lat: -6.89474010467529},
                {lng: 109.138870239258, lat: -6.8950400352478},
                {lng: 109.138038635254, lat: -6.89496088027948},
                {lng: 109.137001037598, lat: -6.89448022842402},
                {lng: 109.135238647461, lat: -6.89402914047241},
                {lng: 109.133598327637, lat: -6.89340877532959},
                {lng: 109.133087158203, lat: -6.89334011077875},
                {lng: 109.132347106934, lat: -6.89323997497559},
                {lng: 109.130867004395, lat: -6.89405822753906},
                {lng: 109.130447387695, lat: -6.89587879180903},
                {lng: 109.129936218262, lat: -6.89710998535156},
                {lng: 109.129508972168, lat: -6.89785099029535},
                {lng: 109.129318237305, lat: -6.89816999435425},
                {lng: 109.128166198731, lat: -6.89964914321899},
                {lng: 109.126388549805, lat: -6.90000915527344},
                {lng: 109.125389099121, lat: -6.90012979507446},
                {lng: 109.124328613281, lat: -6.90023899078363},
                {lng: 109.122673034668, lat: -6.90059900283813},
                {lng: 109.121955871582, lat: -6.90095901489258},
                {lng: 109.12126159668, lat: -6.90130996704102},
                {lng: 109.12068939209, lat: -6.90197992324829},
                {lng: 109.120040893555, lat: -6.90388822555542},
                {lng: 109.119316101074, lat: -6.90482902526855},
                {lng: 109.117919921875, lat: -6.90548992156982},
                {lng: 109.115966796875, lat: -6.90553998947138},
                {lng: 109.114776611328, lat: -6.90534877777094},
                {lng: 109.112976074219, lat: -6.90426921844482},
                {lng: 109.111526489258, lat: -6.90290117263788},
                {lng: 109.110359191895, lat: -6.90190076828003},
                {lng: 109.109573364258, lat: -6.90124893188477},
                {lng: 109.108001708984, lat: -6.9001088142395},
                {lng: 109.106163024902, lat: -6.89964008331299},
                {lng: 109.103538513184, lat: -6.89914083480835},
                {lng: 109.101249694824, lat: -6.89906978607172},
                {lng: 109.098968505859, lat: -6.89910888671875},
                {lng: 109.097427368164, lat: -6.8993182182312},
                {lng: 109.094833374024, lat: -6.89978981018061},
                {lng: 109.091667175293, lat: -6.90020990371693},
                {lng: 109.090118408203, lat: -6.90034914016718},
                {lng: 109.088119506836, lat: -6.90069007873535},
                {lng: 109.086486816406, lat: -6.90080881118774},
                {lng: 109.084053039551, lat: -6.90056085586542},
                {lng: 109.082000732422, lat: -6.90037822723383},
                {lng: 109.080558776856, lat: -6.90036010742188},
                {lng: 109.079956054688, lat: -6.90036010742188},
                {lng: 109.078086853027, lat: -6.90049886703491},
                {lng: 109.07666015625, lat: -6.90075016021729},
                {lng: 109.07544708252, lat: -6.90098905563349},
                {lng: 109.074188232422, lat: -6.9013791084289},
                {lng: 109.072067260742, lat: -6.90217018127436},
                {lng: 109.070152282715, lat: -6.90223979949951},
                {lng: 109.068458557129, lat: -6.90212917327869},
                {lng: 109.065742492676, lat: -6.90161991119385},
                {lng: 109.065483093262, lat: -6.90018892288208},
                {lng: 109.065299987793, lat: -6.89840888977051},
                {lng: 109.064781188965, lat: -6.8970890045166},
                {lng: 109.064720153809, lat: -6.89657020568842},
                {lng: 109.06453704834, lat: -6.89514112472534},
                {lng: 109.064651489258, lat: -6.89370012283325},
                {lng: 109.064987182617, lat: -6.89220094680786},
                {lng: 109.066078186035, lat: -6.8905301094054},
                {lng: 109.067001342774, lat: -6.889898777008},
                {lng: 109.068031311035, lat: -6.88983917236322},
                {lng: 109.069068908691, lat: -6.88978004455561},
                {lng: 109.070281982422, lat: -6.88971900939941},
                {lng: 109.071083068848, lat: -6.88908100128168},
                {lng: 109.07137298584, lat: -6.88828086853027},
                {lng: 109.071479797363, lat: -6.88741016387939},
                {lng: 109.071586608887, lat: -6.88671922683716},
                {lng: 109.071708679199, lat: -6.88619995117182},
                {lng: 109.071990966797, lat: -6.88550901412964},
                {lng: 109.073539733887, lat: -6.88395881652826},
                {lng: 109.07543182373, lat: -6.88204908370972},
                {lng: 109.076232910156, lat: -6.88015079498291},
                {lng: 109.076568603516, lat: -6.87876987457275},
                {lng: 109.076797485352, lat: -6.87756919860834},
                {lng: 109.076972961426, lat: -6.87652921676636},
                {lng: 109.077308654785, lat: -6.87531900405872},
                {lng: 109.077606201172, lat: -6.87485885620112},
                {lng: 109.078048706055, lat: -6.87416982650757},
                {lng: 109.078742980957, lat: -6.87335920333862},
                {lng: 109.079658508301, lat: -6.87244081497192},
                {lng: 109.080627441406, lat: -6.871169090271},
                {lng: 109.08130645752, lat: -6.86984920501709},
                {lng: 109.081771850586, lat: -6.86823987960815},
                {lng: 109.08171081543, lat: -6.866858959198},
                {lng: 109.081703186035, lat: -6.86547994613647},
                {lng: 109.081703186035, lat: -6.86420822143555},
                {lng: 109.081878662109, lat: -6.86285018920893},
                {lng: 109.081916809082, lat: -6.86253976821888},
                {lng: 109.082443237305, lat: -6.86092901229858},
                {lng: 109.0849609375, lat: -6.85965919494623},
                {lng: 109.086112976074, lat: -6.85988903045654},
                {lng: 109.087036132813, lat: -6.86016988754272},
                {lng: 109.088356018067, lat: -6.86091995239252},
                {lng: 109.089752197266, lat: -6.86177921295166},
                {lng: 109.090377807617, lat: -6.8621301651001},
                {lng: 109.09147644043, lat: -6.86275005340576},
                {lng: 109.092796325684, lat: -6.86331892013544},
                {lng: 109.094482421875, lat: -6.86388921737671},
                {lng: 109.095687866211, lat: -6.86429023742676},
                {lng: 109.096122741699, lat: -6.86431121826172},
                {lng: 109.096786499023, lat: -6.86434984207153},
                {lng: 109.097991943359, lat: -6.86376810073847},
                {lng: 109.098526000977, lat: -6.86319017410278},
                {lng: 109.098907470703, lat: -6.86279106140131},
                {lng: 109.099937438965, lat: -6.85991001129145},
                {lng: 109.100326538086, lat: -6.85715007781982},
                {lng: 109.100440979004, lat: -6.85551977157587},
                {lng: 109.100547790527, lat: -6.85403919219971},
                {lng: 109.100486755371, lat: -6.85270977020258},
                {lng: 109.100479125977, lat: -6.85225915908813},
                {lng: 109.1005859375, lat: -6.85059022903442},
                {lng: 109.100639343262, lat: -6.84886980056763},
                {lng: 109.101028442383, lat: -6.84466886520386},
                {lng: 109.10099029541, lat: -6.84335899353016},
                {lng: 109.101051330566, lat: -6.84201002120972},
                {lng: 109.101119995117, lat: -6.83968019485468},
                {lng: 109.100959777832, lat: -6.8388991355896},
                {lng: 109.100830078125, lat: -6.83861112594599},
                {lng: 109.101387023926, lat: -6.83916997909546},
                {lng: 109.101669311523, lat: -6.83916711807245},
                {lng: 109.101943969727, lat: -6.83930587768543},
                {lng: 109.102989196777, lat: -6.83923578262323},
                {lng: 109.103469848633, lat: -6.83916521072388},
                {lng: 109.103614807129, lat: -6.83944320678711},
                {lng: 109.104095458984, lat: -6.8395800590514},
                {lng: 109.104721069336, lat: -6.83999919891357},
                {lng: 109.105209350586, lat: -6.84014987945557},
                {lng: 109.105735778809, lat: -6.84032487869263},
                {lng: 109.106269836426, lat: -6.84056520462036},
                {lng: 109.106941223145, lat: -6.84083318710321},
                {lng: 109.107223510742, lat: -6.84111213684082},
                {lng: 109.108062744141, lat: -6.84110879898071},
                {lng: 109.108329772949, lat: -6.84139013290405},
                {lng: 109.109169006348, lat: -6.84166812896729},
                {lng: 109.109443664551, lat: -6.84166812896729},
                {lng: 109.109725952149, lat: -6.84194278717041},
                {lng: 109.110282897949, lat: -6.84193897247314},
                {lng: 109.110557556152, lat: -6.84221887588495},
                {lng: 109.110832214356, lat: -6.84221887588495},
                {lng: 109.111106872559, lat: -6.84250020980835},
                {lng: 109.111808776856, lat: -6.84278011322016},
                {lng: 109.112503051758, lat: -6.84305620193481},
                {lng: 109.113334655762, lat: -6.84389019012451},
                {lng: 109.114028930664, lat: -6.84402704238886},
                {lng: 109.114723205566, lat: -6.84416818618774},
                {lng: 109.115280151367, lat: -6.84444379806507},
                {lng: 109.116386413574, lat: -6.84499979019165},
                {lng: 109.116668701172, lat: -6.84499979019165},
                {lng: 109.116943359375, lat: -6.84527778625488},
                {lng: 109.117225646973, lat: -6.84527778625488},
                {lng: 109.117500305176, lat: -6.84555578231812},
                {lng: 109.117774963379, lat: -6.84555578231812},
                {lng: 109.118057250977, lat: -6.84583377838135},
                {lng: 109.118606567383, lat: -6.84582901000977},
                {lng: 109.118888854981, lat: -6.84610986709589},
                {lng: 109.119125366211, lat: -6.84610986709589},
                {lng: 109.11971282959, lat: -6.84638500213623},
                {lng: 109.120277404785, lat: -6.84667682647705},
                {lng: 109.120552062988, lat: -6.84666585922236},
                {lng: 109.121109008789, lat: -6.84722185134882},
                {lng: 109.12166595459, lat: -6.84721994400024},
                {lng: 109.121948242188, lat: -6.84749984741205},
                {lng: 109.123611450195, lat: -6.84749984741205},
                {lng: 109.123886108398, lat: -6.84777784347528},
                {lng: 109.124305725098, lat: -6.84777784347528},
                {lng: 109.124725341797, lat: -6.84791707992548},
                {lng: 109.125274658203, lat: -6.84805583953846},
                {lng: 109.125556945801, lat: -6.84805583953846},
                {lng: 109.125831604004, lat: -6.84805583953846},
                {lng: 109.126113891602, lat: -6.84833383560181},
                {lng: 109.126953125, lat: -6.84833002090443},
                {lng: 109.127220153809, lat: -6.84860992431641},
                {lng: 109.128608703613, lat: -6.84860992431641},
                {lng: 109.128890991211, lat: -6.84860992431641},
                {lng: 109.129173278809, lat: -6.84860992431641},
                {lng: 109.129447937012, lat: -6.84860992431641},
                {lng: 109.129722595215, lat: -6.84860992431641},
                {lng: 109.129997253418, lat: -6.84860992431641},
                {lng: 109.131385803223, lat: -6.84860992431641},
                {lng: 109.13166809082, lat: -6.84888982772827},
                {lng: 109.132499694824, lat: -6.84888982772827},
                {lng: 109.132766723633, lat: -6.8487491607666},
                {lng: 109.133186340332, lat: -6.8487491607666},
                {lng: 109.133605957031, lat: -6.84860992431641},
                {lng: 109.134216308594, lat: -6.84860086441034},
                {lng: 109.134910583496, lat: -6.84861183166504},
                {lng: 109.135559082031, lat: -6.84854221343994},
                {lng: 109.136047363281, lat: -6.84824800491327},
                {lng: 109.13648223877, lat: -6.84786891937256},
                {lng: 109.136978149414, lat: -6.84749794006348},
                {lng: 109.137466430664, lat: -6.84713983535767},
                {lng: 109.13794708252, lat: -6.84680891036982},
                {lng: 109.138397216797, lat: -6.84670877456654},
                {lng: 109.138786315918, lat: -6.84684991836548},
                {lng: 109.139183044434, lat: -6.84704923629761},
                {lng: 109.13956451416, lat: -6.84724187850946},
                {lng: 109.139938354492, lat: -6.8474588394165},
                {lng: 109.140380859375, lat: -6.84755516052235},
                {lng: 109.140808105469, lat: -6.84770107269287},
                {lng: 109.14111328125, lat: -6.84749984741205},
                {lng: 109.142219543457, lat: -6.84749984741205},
                {lng: 109.142501831055, lat: -6.84777784347528},
                {lng: 109.143333435059, lat: -6.84777784347528},
                {lng: 109.143608093262, lat: -6.84805583953846},
                {lng: 109.14444732666, lat: -6.84805583953846},
                {lng: 109.144721984863, lat: -6.84777784347528},
                {lng: 109.144996643067, lat: -6.84777784347528},
                {lng: 109.145278930664, lat: -6.84805583953846},
                {lng: 109.148056030274, lat: -6.84805583953846},
                {lng: 109.148330688477, lat: -6.84777784347528},
                {lng: 109.148612976074, lat: -6.84777784347528},
                {lng: 109.148887634277, lat: -6.84805583953846},
                {lng: 109.149719238281, lat: -6.84805583953846},
                {lng: 109.150001525879, lat: -6.84777784347528},
                {lng: 109.151390075684, lat: -6.8477258682251},
                {lng: 109.151657104492, lat: -6.84749984741205},
                {lng: 109.152236938477, lat: -6.84749984741205}
            ];

            var poly_kota_tegal=[];
            for (var i=0; i<wilayah_kotategal.length; i++) {
                poly_kota_tegal[i] = {lat: wilayah_kotategal[i].lat,lng: wilayah_kotategal[i].lng};
            }

            var flightPath = new google.maps.Polyline({
                path: poly_kota_tegal,
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });
            flightPath.setMap(map);
        }
        initMap();

        function checkTime(i) {
            if (i < 10) {i = "0" + i};
            return i;
        }
    </script>
<?php endif; ?>
<?php if ($page=="add"): ?>
    <div class="demo-ribbon blue-grey lighten-3"></div>
    <div class="col s12 demo-main">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s8 m8 l8 offset-s2 offset-m2 offset-l2">
                <div class="card" id="profile-page-header">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="<?php echo base_url('assets/document/style/img/bg2.jpg')?>" alt="Img">
                    </div>
                    <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
                        <div class="indeterminate"></div>
                    </div>
                    <figure class="card-profile-image">
                        <div class="center-cropped-large">
                            <img id="uploadPreviewsp1" class="circle z-depth-2 responsive-img activator" src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>" alt="profile image">
                        </div>
                    </figure>
                    <div class="card-content">
                        <div class="row">
                            <div class="col s8 offset-s2" style="margin-top:5%">
                                <form class="formValidate" id="formValidate">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">location_city</i>
                                            <input name="nama_admin" type="text" id="nama_admin" data-length="20">
                                            <label>Nama Instansi</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input name="username" type="text" id="username" data-length="15">
                                            <label>Username</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input name="password" type="password" id="password">
                                            <label>Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m12 l12">
                                            <div class="col s1 m1 l1">
                                                <i class="material-icons prefix">add_a_photo</i>
                                            </div>
                                            <div class="col s10 m10 l0">
                                                <div class="file-field input-field">
                                                    <div class="btn blue">
                                                        <span>File</span>
                                                        <input class="btn left" type="file" value="Cari" id="foto" onchange="PreviewImagesp1();" name="foto" accept=".jpeg,.png,.jpg"/>
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 center">
                                            <a href="<?php echo base_url('Superadmin/admin');?>" class="btn waves-effect waves-light" type="button" name="action">Batal
                                                <i class="material-icons right">close</i>
                                            </a>
                                            <button class="btn waves-effect waves-light" type="submit" name="action">Simpan
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $("#formValidate").validate({
                rules: {
                    nama_admin: {
                        required: true,
                        maxlength: 20
                    },
                    username: {
                        required: true,
                        maxlength: 15
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },

                },
                messages: {
                    nama_admin: {
                        required: "Silahkan diisi...",
                        maxlength: "Maksimal 20 karakter."
                    },
                    username: {
                        required: "Silahkan diisi...",
                        maxlength: "Maksimal 15 karakter."
                    },
                    password: {
                        required: "Silahkan diisi.",
                        minlength: "Panjang karakter password minimal 6 karakter."
                    },
                },
                errorElement : 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    var file = $("#foto")[0].files;
                    var values = new FormData();
                    values.append("file", file[0]);
                    values.append("nama_admin", $("#nama_admin").val());
                    values.append("username", $("#username").val());
                    values.append("password", $("#password").val());
                    $('#load-progress-pesan').show();
                    $.ajax({
                        type: "POST",data:values,url: "<?php echo base_url('Superadmin/insert_add_admin'); ?>",
                        processData: false,contentType: false,
                        success: function(data)
                        {
                            $('#load-progress-pesan').hide();
                            if (data == 1){
                                setTimeout(function() {
                                    Materialize.toast('<span>Akun Admin berhasil ditambahkan.</span>', 3000);
                                }, 100);
                                reset_form()
                            } else if (data==0){
                                setTimeout(function() {
                                    Materialize.toast('<span>Gagal menambahkan data. Silahkan coba lagi.</span>', 3000);
                                }, 100);
                            } else {
                                alert(data);
                            }
                        },
                        error:function(data){
                            setTimeout(function() {
                                Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                            }, 100);
                            $('#load-progress-pesan').hide();
                        }
                    });
                }
            });
        });

        function reset_form() {
            $('#formValidate').trigger("reset");
            $('.prefix').removeClass('active');
            $("#uploadPreviewsp1").attr("src","<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>");
        }

        function PreviewImagesp1() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("foto").files[0]);
            oFReader.onload = function (oFREvent)
            {
                document.getElementById("uploadPreviewsp1").src = oFREvent.target.result;
            };
        }
    </script>
<?php endif; ?>
