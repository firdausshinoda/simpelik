<?php if ($page=="index") : ?>
    <div class="demo-ribbon blue-grey lighten-2"></div>
    <div class="col s12 demo-main">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s10 m10 offset-m1">
                <div class="row">
                    <?php foreach ($result->result() as $val): ?>
                        <div class="col s3">
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light" style="height: 200px">
                                    <?php if (empty($val->img_user)): ?>
                                        <img src="<?php echo base_url('assets/document/style/img/profile.jpg');?>">
                                    <?php else: ?>
                                        <img src="<?php echo base_url('assets/document/img/user/'.$val->img_user);?>">
                                    <?php endif;?>
                                </div>
                                <div class="card-content">
                                    <p><a href="<?php echo base_url('Superadmin/detail_user')."/".safe_encode($val->id_tb_user);?>"><?php echo $val->nama_user;?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
        <a href="<?php echo base_url('Superadmin/add_user');?>" id="add_user" class="waves-effect waves-light btn-floating btn-large pink lighten-1">
            <i class="material-icons">person_add</i>
        </a>
    </div>
    <div class="tap-target blue lighten-1" data-activates="add_user">
        <div class="tap-target-content">
            <h5>Tambah Pengguna Masyarakat</h5>
            <p>Anda dapat menambahkan pengguna masyarakat dengan menekan tombol ini.</p>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tap-target').tapTarget('open');
        });
    </script>
<?php endif; ?>
<?php if ($page=="detail") : ?>
    <div class="container">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s10 m10 l10 offset-s1 offset-m1 offset-l1">
                    <div id="profile-page" class="section">
                        <div id="profile-page-header" class="card">
                            <div class="card-image waves-effect waves-block waves-light" style="height:350px;">
                                <img class="activator" src="<?php echo base_url('assets/document/style/img/bg_slide_2.jpg')?>" alt="user background">
                            </div>
                            <figure class="card-profile-image" style="top:290px;">
                                <div class="center-cropped-large">
                                    <?php if (empty($data_user->img_user)): ?>
                                        <img src="<?php echo base_url('assets/document/style/img/profile.jpg');?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
                                    <?php else: ?>
                                        <img src="<?php echo base_url('assets/document/img/user')."/".$data_user->img_user;?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
                                    <?php endif; ?>
                                </div>
                            </figure>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s3 offset-s2">
                                        <h4 class="card-title grey-text text-darken-4">Firdaus</h4>
                                        <p class="medium-small grey-text">Kota Tegal</p>
                                    </div>
                                    <div class="col s6 center-align">
                                        <h4 class="card-title grey-text text-darken-4">10</h4>
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
                                        <div class="progress display_none" id="load-progress-profil" style="margin: 0 0 0 0;">
                                            <div class="indeterminate"></div>
                                        </div>
                                        <div class="card-profile-title">
                                            <div class="row">
                                                <div class="col s2">
                                                    <div class="center-cropped-small">
                                                        <?php if (empty($data_user->img_user)): ?>
                                                            <img src="<?php echo base_url('assets/document/style/img/profile.jpg');?>" alt="profile image" class="circle responsive-img valign profile-post-uer-image">
                                                        <?php else: ?>
                                                            <img src="<?php echo base_url('assets/document/img/user')."/".$data_user->img_user;?>" alt="profile image" class="circle responsive-img valign profile-post-uer-image">
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col s10">
                                                    <p class="grey-text text-darken-4 margin"><?php echo $data_user->nama_user;?></p>
                                                    <span class="grey-text text-darken-1 ultra-small">Ditambahkan Pada <?php echo waktu_lalu($data_user->cdate);?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col s12">
                                                    <form class="formValidate" id="formValidate">
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <i class="material-icons prefix">assignment_ind</i>
                                                                <input name="id_tb_user" type="hidden" value="<?php echo $data_user->id_tb_user;?>">
                                                                <input name="no_nik" type="text" value="<?php echo $data_user->no_nik;?>" placeholder="No NIK" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <i class="material-icons prefix">assignment_ind</i>
                                                                <input name="no_kk" type="text" value="<?php echo $data_user->no_kk;?>" placeholder="No KK" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <i class="material-icons prefix">assignment_ind</i>
                                                                <?php if ($data_user->sex == "L"):?>
                                                                    <input type="text" value="Laki - Laki" placeholder="Jenis Kelamin" disabled>
                                                                <?php else:?>
                                                                    <input type="text" value="Perempuan" placeholder="Jenis Kelamin" disabled>
                                                                <?php endif;?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <i class="material-icons prefix">account_box</i>
                                                                <input name="nama" id="nama" type="text" value="<?php echo $data_user->nama_user;?>" placeholder="nama" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <i class="material-icons prefix">account_circle</i>
                                                                <input name="username" id="username" type="text" value="<?php echo $data_user->username;?>" placeholder="username" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12 m12 l12">
                                                                <?php if (!empty($data_user->mdate)): ?>
                                                                    <span class="grey-text text-darken-1 ultra-small">Diubah pada <?php echo waktu_lalu($data_user->mdate); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn-floating waves-effect waves-light red right modal-trigger" onclick="modal('ubah_password_user','<?php echo $data_user->id_tb_user;?>')"><i class="material-icons">lock</i></button>
                                                        <button type="button" onclick="enableBtn('true')" id="btn_edit" class="btn-floating waves-effect waves-light light-blue right" style="margin-right: 1%"><i class="material-icons">edit</i></button>
                                                        <button type="submit" id="btn_send" class="btn-floating waves-effect waves-light purple accent-4 right display_none" style="margin-right: 1%"><i class="material-icons">send</i></button>
                                                        <button type="button" onclick="enableBtn('false')" id="btn_close" class="btn-floating waves-effect waves-light yellow darken-2 right display_none" style="margin-right: 1%"><i class="material-icons">close</i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="profile-page-wall" class="col s7 m7">
                            <div id="profile-page-wall-posts"class="row">
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
                    },
                },
                errorElement : 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    var values = $('#formValidate').serialize();
                    $('#load-progress-profil').show();
                    $.ajax({
                        type: "POST",data:values,url: "<?php echo base_url('Superadmin/ubah_profil_user'); ?>",
                        success: function(data)
                        {
                            $('#load-progress-profil').hide();
                            if (data==1) {
                                window.location.reload();
                            } else if (data==0) {
                                setTimeout(function() {
                                    Materialize.toast('<span>Gagal menyimpan.</span>', 3000);
                                }, 100);
                            } else { alert(data); }
                        },
                        error:function(data){
                            errorr();
                            $('#load-progress-profil').hide();
                        }
                    });
                }
            });
        });
        function enableBtn(str) {
            if (str=="true"){
                $("#btn_edit").hide();
                $("#btn_send").show();
                $("#btn_close").show();
                $("#nama").prop('disabled', false);
                $("#username").prop('disabled', false);
            } else {
                $("#btn_edit").show();
                $("#btn_send").hide();
                $("#btn_close").hide();
                $("#nama").prop('disabled', true);
                $("#username").prop('disabled', true);
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
<?php if ($page=="add"): ?>
    <div class="demo-ribbon blue-grey lighten-3"></div>
    <div class="col s12 demo-main">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s8 m8 offset-m2 offset-m2">
                <div class="card" id="profile-page-header">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="<?php echo base_url('assets/document/style/img/bg2.jpg')?>" alt="Img">
                    </div>
                    <div class="progress display_none" id="load-progress-pesan" style="margin: 0 0 0 0;">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col s8 offset-s2" style="margin-top:5%">
                                <form class="formValidate" id="formValidate">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">assignment_ind</i>
                                            <input name="no_nik" type="text">
                                            <label>No NIK</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">assignment_ind</i>
                                            <input name="no_kk" type="text">
                                            <label>No KK</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input name="username" type="text">
                                            <label>Username</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input name="password" type="text">
                                            <label>Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 center">
                                            <a href="<?php echo base_url('Superadmin/user');?>" class="btn waves-effect waves-light" type="button" name="action">Batal
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
                    no_nik: {
                        required: true,minlength: 15,maxlength: 16,
                    },
                    no_kk: {
                        required: true,minlength: 15,maxlength: 16,
                    },
                    password:{
                        required: true,minlength: 6,maxlength: 40,
                    },
                    username:{
                        required: true,minlength: 6,maxlength: 15,
                    }
                },
                messages: {
                    no_nik: {
                        required: "Silahkan diisi...", minlength: "Minimal 15 karakter.", maxlength: "Maksimal 16 karakter.",
                    },
                    no_kk: {
                        required: "Silahkan diisi...", minlength: "Minimal 15 karakter.", maxlength: "Maksimal 16 karakter.",
                    },
                    password:{
                        required: "Silahkan diisi", minlength: "Minimal 6 karakter", maxlength: "Maksimal 40 karakter.",
                    },
                    username:{
                        required: "Silahkan diisi", minlength: "Minimal 6 karakter", maxlength: "Maksimal 15 karakter.",
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
                    $('#load-progress-pesan').show();
                    $.ajax({
                        type: "POST",data:values,url: "<?php echo base_url('Superadmin/add_akun_user'); ?>",
                        success: function(data)
                        {
                            $('#load-progress-profil').hide();
                            if (data==1) {
                                setTimeout(function() {
                                    Materialize.toast('<span>Akun Masyarakat berhasil ditambahkan.</span>', 3000);
                                }, 100);
                                reset_form()
                            } else if (data==0) {
                                setTimeout(function() {
                                    Materialize.toast('<span>Gagal menambahkan data. Silahkan coba lagi.</span>', 3000);
                                }, 100);
                            } else if (data==2) {
                                setTimeout(function() {
                                    Materialize.toast('<span>No NIK atau KK tidak terdaftar.</span>', 5000);
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

        function reset_form() {
            $('#formValidate').trigger("reset");
            $('.prefix').removeClass('active');
        }
    </script>
<?php endif;?>
