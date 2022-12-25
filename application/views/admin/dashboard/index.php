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
                                <?php $j=0; foreach ($value['gallery'] as $key): $j++; ?>
                                    <a class="carousel-item" href="#four!">
                                        <img class="responsive-img profile-large" src="<?php echo base_url('assets/document/img/aduan_gallery/'.$key)?>">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card-action">
                            <a class="btn waves-effect waves-light blue right" href="<?php echo base_url('Aduan')."/".$value['id_tb_aduan'];?>">Baca Selengapnya...</a>
                            <a class="btn-floating waves-effect waves-light light-blue right modal-trigger" style="margin-right:10px" onclick="mapAduan('<?php echo $value['lati'];?>',<?php echo $value['longi'];?>)"><i class="material-icons activator">location_on</i></a>
                            <a class="btn-floating waves-effect waves-light pink lighten-1 right" style="margin-right:10px" href="javascript:avoid()"><i class="material-icons">comment</i></a>
                            <a style="margin-right:0px" class="black-text right"><?php echo $value['ttl_komen']; ?></a>
                            <button class="btn-floating waves-effect waves-light green accent-4 right" style="margin-right:10px"><i class="material-icons">thumb_up</i></button>
                            <a style="margin-right:0px" class="black-text right"><?php echo $value['ttl_like']; ?></a>
                        </div>
                        <div class="card-content">
                            <p><?php echo $value['isi_aduan']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.carousel.carousel-slider').carousel({fullWidth: false});
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
                            type: "POST",data:{id:str},url: "<?php echo base_url('Admin/deleteAduan'); ?>",
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
                    url: "<?php echo base_url('Admin/modal'); ?>",
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
                                    <img src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>" alt="" class="circle responsive-img valign profile-post-uer-image">
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
                                <a class="carousel-item" href="#four!">
                                    <img class="responsive-img profile-large" src="<?php echo base_url('assets/document/img/aduan_gallery/'.$value->img_gallery_aduan);?>">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-action">
                        <a class="btn-floating waves-effect waves-light light-blue right modal-trigger" onclick="mapAduan('<?php echo $detail->lati;?>','<?php echo $detail->longi;?>')"><i class="material-icons activator">location_on</i></a>
                        <a class="btn-floating waves-effect waves-light pink lighten-1 right" style="margin-right:1%" href="javascript:avoid()"><i class="material-icons">comment</i></a>
                        <a href="#" style="margin-right:0px" class="black-text right"><?php echo $ttl_komen; ?></a>
                        <a class="btn-floating waves-effect waves-light green accent-4 right"  style="margin-right:1%"><i class="material-icons">thumb_up</i></a>
                        <a href="#" style="margin-right:0px" class="black-text right"><?php echo $ttl_like; ?></a>
                    </div>
                    <div class="card-content">
                        <p><?php echo $detail->isi_aduan; ?></p>
                    </div>
                    <div class="progress display_none" id="load-progress-komentar" style="margin: 0 0 0 0;">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="grey lighten-4">
                        <div id="view_komentar"></div>
                        <style media="screen">
                            textarea::-moz-placeholder {  /* Firefox 19+ */
                                color: #757575 !important;
                            }
                            .fileUpload {
                                position: relative;
                                overflow: hidden;
                                margin: 0px;
                                padding: 0px;
                            }
                            .fileUpload input.upload {
                                position: absolute;
                                top: 0px;
                                right: 0px;
                                margin: 0px;
                                padding: 0px;
                                font-size: 20px;
                                cursor: pointer;
                                opacity: 0;
                                filter: alpha(opacity=0);
                            }
                        </style>
                        <div class="card-action">
                            <form class="formValidate" id="formValidate">
                                <div class="row" >
                                    <div class="col s10 m10 l10" style="border:1px solid #000">
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <div class="input-field">
                                                    <div class="progress display_none" id="load-progress-send" style="margin: 0 0 0 0;">
                                                        <div class="indeterminate"></div>
                                                    </div>
                                                    <textarea id="isi_komentar" placeholder="komentar..." class="materialize-textarea validate margin emoji" type="text" style="border-bottom: none!important;box-shadow: none!important;" name="isi_komentar"></textarea>
                                                </div>
                                            </div>
                                            <div class="col s12 m12 l12">
                                                <div class="fileUpload">
                                                    <i class="material-icons black-text right">add_a_photo</i>
                                                    <input type="file" class="upload file_file" id="foto" onchange="PreviewImagesp1();" accept=".jpeg,.png,.jpg" name="foto">
                                                </div>
                                                <div class="col s4 m4 l4 display_none" id="card_img">
                                                    <div class="card">
                                                        <div class="card-image waves-effect waves-block waves-light">
                                                            <img class="activator" id="uploadPreviewsp1" alt="office">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s2 m2 l2 card-action-share">
                                        <button type="submit" class="waves-effect waves-light btn"><i class="material-icons">send</i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.carousel.carousel-slider').carousel({fullWidth: false});
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
        $(function() {
            $('#formValidate').validate({
                rules: { isi_komentar: "required" },
                messages: { isi_komentar: "Silahkan diisi..." },
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
                    var str="<?php echo $detail->id_tb_aduan;?>";
                    var komentar = document.getElementById("isi_komentar").value;
                    var file = $("#foto")[0].files;
                    var values = new FormData();
                    values.append("file", file[0]);
                    values.append("komentar",komentar);
                    values.append("id_aduan",str);
                    if (komentar==""){
                        setTimeout(function() {
                            Materialize.toast('<span>Silahkan diisi.</span>', 3000);
                        }, 100);
                    } else {
                        $("#load-progress-send").show();
                        $.ajax({
                            type: "POST",data:values,url : "<?php echo base_url('Admin/input_komentar_aduan'); ?>",
                            processData: false,
                            contentType: false,
                            success : function(data){
                                $('#load-progress-send').hide();
                                if (data==1) {
                                    var el = $("#isi_komentar").emojioneArea();
                                    el[0].emojioneArea.setText('');
                                    getKomentar(str);
                                } else {
                                    setTimeout(function() {
                                        Materialize.toast('<span>Gagal memberi komentar.</span>', 3000);
                                    }, 100);
                                }
                            },
                            error:function(data){
                                $('#load-progress-send').hide();
                                setTimeout(function() {
                                    Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                                }, 100);
                            }
                        });
                    }
                }
            });
        });
        var page=1;
        $(document).ready(function(){
            $("#load-progress-komentar").show();
            page=1;
            getKomentar("<?php echo $detail->id_tb_aduan;?>");
            $("#isi_komentar").emojioneArea();
        });
        function PreviewImagesp1() {
            $("#card_img").show();
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("foto").files[0]);
            oFReader.onload = function (oFREvent)
            {
                document.getElementById("uploadPreviewsp1").src = oFREvent.target.result;
            };
        };
        function getKomentar(str) {
            $.ajax(
                {
                    type: "GET",
                    data:{id:str,page:page},
                    url: "<?php echo base_url('Admin/komentar_aduan'); ?>",
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
                            type: "POST",data:{id:str},url: "<?php echo base_url('Admin/deleteAduan'); ?>",
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
                    url: "<?php echo base_url('Admin/modal'); ?>",
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
                    <div class="center-cropped-small">
                        <?php if (empty($komentar[$i]['img_'])): ?>
                            <img src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                        <?php else: ?>
                            <img src="<?php echo base_url($komentar[$i]['img_'])?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                        <?php endif; ?>
                    </div>
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
                                <img class="materialboxed" style="width:100%;height:auto;" src="<?php echo base_url('assets/document/img/komentar_gallery/'.$komentar[$i]['img_comment']);?>" alt="office">
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
