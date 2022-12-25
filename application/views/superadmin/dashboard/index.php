<?php if ($page=="index"): ?>
    <div class="col s12">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s6 m6 l6 offset-s3 offset-m3 offset-l3">
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
                                <?php $j=0; foreach ($data[$i]['gallery'] as $key): $j++; ?>
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
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.carousel.carousel-slider').carousel({fullWidth: true});
        $(document).ready(function(){
            $('.modal').modal();
        });
        (function($) {
            $(function() {
                $(".dropdown-button").dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrain_width: false,
                    hover: true,
                    belowOrigin: false,
                    alignment: 'left'
                });
            });
        })(jQuery);
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
    </script>
<?php endif; ?>
<?php if ($page=="detail"): ?>
    <div class="demo-ribbon blue-grey lighten-3"></div>
    <div class="col s12 demo-main">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s8 m8 l8 offset-s2 offset-m2 offset-l2">
                <div id="profile-page-wall-post" class="card">
                    <div class="card-profile-title" style="padding:10px">
                        <div class="row" style="margin-bottom:auto">
                            <div class="col s1">
                                <?php if (empty($detail->img_user)): ?>
                                    <img src="<?php echo base_url('assets/document/style/img/profile.jpg')?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                                <?php else: ?>
                                    <img src="<?php echo base_url('assets/document/img/user/'.$detail->img_user);?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                                <?php endif; ?>
                            </div>
                            <div class="col s10">
                                <p class="grey-text text-darken-4 margin"><?php echo $detail->nama_user; ?></p>
                                <span class="grey-text text-darken-1 ultra-small">Dibagikan pada - <?php echo waktu_lalu($detail->cdate); ?></span>
                            </div>
                            <div class="col s1 right-align">
                                <a href="javascript:void(0);" data-activates="dropdown1" class="dropdown-button"><i class="material-icons">expand_more</i></a>
                                <ul id="dropdown1" class="dropdown-content dropdown-icon">
                                    <li><a href="javascript:avoid()" onclick="deleteAduan('<?php echo safe_encode($detail->id_tb_aduan);?>')"><i class="material-icons">delete</i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-image profile-large" style="height: 350px;">
                        <div class="carousel carousel-slider center" data-indicators="true">
                            <?php foreach ($gallery->result() as $value): ?>
                                <a class="carousel-item" href="#four!"><img class="responsive-img profile-large" src="<?php echo base_url('assets/document/img/aduan_gallery/'.$value->img_gallery_aduan);?>"></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn-floating waves-effect waves-light light-blue right" onclick="mapAduan('<?php echo $detail->lati;?>',<?php echo $detail->longi;?>)"><i class="material-icons activator">location_on</i></button>
                        <a class="btn-floating waves-effect waves-light pink lighten-1 right" style="margin-right:1%" href="javascript:avoid()"><i class="material-icons">comment</i></a>
                        <a href="#" style="margin-right:0px" class="black-text right"><?php echo $ttl_komen; ?></a>
                        <a class="btn-floating waves-effect waves-light green accent-4 right" style="margin-right:1%"><i class="material-icons">thumb_up</i></a>
                        <a href="#" style="margin-right:0px" class="black-text right"><?php echo $ttl_like; ?></a>
                    </div>
                    <div class="card-content">
                        <h5><b><?php echo $detail->nama_admin;; ?></b></h5>
                        <p><?php echo $detail->isi_aduan; ?></p>
                    </div>
                    <div class="progress display_none" id="load-progress-komentar" style="margin: 0 0 0 0;">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="grey lighten-4">
                        <div id="view_komentar"></div>
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
        (function($) {$(function() {
            $(".dropdown-button").dropdown({
                inDuration: 300,
                outDuration: 225,
                constrain_width: false,
                hover: true,
                belowOrigin: false,
                alignment: 'left'
            });
        });})(jQuery);
        var page=1;
        $(document).ready(function(){
            $("#load-progress-komentar").show();
            page=1;
            getKomentar("<?php echo $detail->id_tb_aduan;?>");
        });
        function getKomentar(str) {
            $.ajax(
                {
                    type: "GET",
                    data:{id:str,page:page},
                    url: "<?php echo base_url('Superadmin/komentar_aduan'); ?>",
                    success: function(data){
                        $("#load-progress-komentar").hide();
                        $('#view_komentar').html(data);
                        page+=1;
                    },
                    error:function(data){
                        $("#load-progress-komentar").hide();
                        swal("Oops...", "Terjadi kesalahan. Silahkan coba lagi!!!.", "error");
                    }
                });
        }
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
                                    window.history.back();
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
    </script>
<?php endif; ?>
<?php if ($page=="komentar"): ?>
    <?php $i=0; foreach ($komentar as $value): $i++; ?>
        <div class="card-profile-title" style="padding:10px">
            <div class="row"  style="margin-bottom:auto;">
                <div class="col s1 m1 l1">
                    <?php if (empty($komentar[$i]['img_'])): ?>
                        <img src="<?php echo base_url('assets/document/style/img/avatar5.png')?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                    <?php else: ?>
                        <img src="<?php echo base_url($komentar[$i]['img_'])?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                    <?php endif; ?>
                </div>
                <div class="col s10">
                    <p class="grey-text text-darken-4 margin"><?php echo $komentar[$i]['nama_']; ?></p>
                    <span class="grey-text text-darken-1 ultra-small">Dibagikan pada - <?php echo $komentar[$i]['cdate'] ?></span>
                </div>
            </div>
            <div class="row" style="margin-bottom:auto;padding:0px">
                <?php if ($komentar[$i]['img_comment']!=""): ?>
                    <div class="col s4" style="padding:0px">
                        <div class="card">
                            <div class="card-image">
                                <img class="materialboxed" style="width:100%;height:auto;" src="<?php echo base_url('assets/document/img/komentar_gallery/'.$komentar[$i]['img_comment']);?>" id="uploadPreviewsp1" alt="office">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col s8">
                    <p class="komentar"><?php echo json_decode('"'.$komentar[$i]['isi_comment'].'"'); ?></p>
                </div>
            </div>
        </div>
        <div class="divider"></div>
    <?php endforeach; ?>
    <?php if ($pagi < $ttl_pagi): ?>
        <center>
            <button style="margin:5px;" class="waves-effect waves-light btn" type="button" onclick="getKomentar('<?php echo $id;?>');">Selanjutnya...</button>
        </center>
    <?php endif; ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.materialboxed').materialbox();
        });
    </script>
<?php endif; ?>
