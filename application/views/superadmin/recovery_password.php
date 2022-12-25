<html>
<head>
    <?php $this->load->view('style/header'); ?>
</head>
<body class="blue-grey lighten-5">
<style type="text/css">
    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }
    main {
        flex: 1 0 auto;
    }
</style>
<div id="modal_dialog" class="modal modal-fixed-footer"></div>
<div class="navbar-fixed z-depth-4">
    <nav class="blue">
        <div class="nav-wrapper" style="padding:0 5%">
            <?php $this->load->view('style/navbar_login_superadmin_web'); ?>
        </div>
    </nav>
</div>
<?php $this->load->view('style/navbar_admin_mobile'); ?>

<main>
    <div id="main">
        <div class="wrapper">
            <section id="content">
                <div class="demo-ribbon blue-grey lighten-2"></div>
                <div class="col s12 m12 l12 demo-main">
                    <div id="profile-page-wall-posts"class="row">
                        <div class="col s4 m4 offset-m4">
                            <div class="card">
                                <div class="progress display_none" id="load-progress-pesan" style="margin: 0 0 0 0;">
                                    <div class="indeterminate"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="header2">Lupa Password</h4>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix ">email</i>
                                            <input id="email" name="email" type="email" disabled value="<?php echo substr($data->email, 0, 3).'****'.substr($data->email, strpos($data->email, "@"));?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 grey-text">
                                            <p>*Silahkan cek email jika anda menyetujui untuk mengirim tautan pemulihan password superadmin.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button onclick="send_email('<?php echo $data->email;?>')" class="btn blue darken-3 waves-effect waves-light col s12" type="button">Kirim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
<footer class="page-footer blue">
    <div class="footer-copyright">
        <div class="container">
            Copyright © 2017 <a class="grey-text text-lighten-4" href="http://firdaus.slice-pro.com" target="_blank">Firdaus Nur Sugiarto</a> All rights reserved.
            <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://firdaus.slice-pro.com">Firdaus Nur Sugiarto</a></span>
        </div>
    </div>
</footer>
<?php $this->load->view('style/js'); ?>
<script type="text/javascript">
    function send_email(email) {
        $('#load-progress-pesan').show();
        $.ajax(
            {
                type: "POST",
                data:{email:email},
                url: "<?php echo base_url('Sistem/recovery_password_exe'); ?>",
                success: function(data)
                {
                    if (data==1){
                        $('#load-progress-pesan').hide();
                        setTimeout(function() {
                            Materialize.toast('<span>Silahkan cek email pada kotak ataupun spam untuk mendapatkan tautan pemulihan akun.</span>', 3000);
                        }, 100);
                    } else {
                        $('#load-progress-pesan').hide();
                        setTimeout(function() {
                            Materialize.toast('<span>Gagal mengirim tautan pemulihan akun ke email.</span>', 3000);
                        }, 100);
                    }
                },
                error:function(data){
                    $('#load-progress-pesan').hide();
                    setTimeout(function() {
                        Materialize.toast('<span>Gagal mengirim tautan pemulihan akun ke email!!!.</span>', 3000);
                    }, 100);
                }
            });
    }
</script>
</body>
</html>
