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
                                <img src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
                            </div>
                        </figure>
                        <div class="card-content">
                            <div class="row">
                                <div class="col s3 offset-s2">
                                    <h4 class="card-title grey-text text-darken-4">Simpelik</h4>
                                    <p class="medium-small grey-text">Kota Tegal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="profile-page-content" class="row">
                    <div id="profile-page-sidebar" class="col s12 m4">
                        <ul id="profile-page-about-details" class="collection z-depth-1">
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s5 grey-text darken-1"><i class="material-icons">home</i> Admin</div>
                                    <div class="col s7 grey-text text-darken-4 right-align"><?php echo $ttl_admin;?></div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s5 grey-text darken-1"><i class="material-icons">people</i> User</div>
                                    <div class="col s7 grey-text text-darken-4 right-align"><?php echo $ttl_user;?></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div id="profile-page-wall" class="col s12 m8">
                        <div id="profile-page-wall-posts"class="row">
                            <div class="col s12">
                                <div id="profile-page-wall-post" class="card">
                                    <div class="progress display_none" id="load-progress-profil" style="margin: 0 0 0 0;">
                                        <div class="indeterminate"></div>
                                    </div>
                                    <div class="card-profile-title">
                                        <div class="row">
                                            <div class="col s1">
                                                <div class="center-cropped-small">
                                                    <img src="<?php echo base_url('assets/document/style/img/logo_kota_tegal.png')?>" alt="profile image" class="circle responsive-img valign profile-post-uer-image">
                                                </div>
                                            </div>
                                            <div class="col s10">
                                                <p class="grey-text text-darken-4 margin"><?php echo $data->nama_superadmin; ?></p>
                                                <span class="grey-text text-darken-1 ultra-small">Diubah Pada <?php echo setTglIndo($data->mdate); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <form class="formValidate" id="formValidate">
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <i class="material-icons prefix">home</i>
                                                            <input name="nama" id="nama" type="text" value="<?php echo $data->nama_superadmin; ?>" placeholder="nama" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <i class="material-icons prefix">account_circle</i>
                                                            <input name="username" id="username" type="text" value="<?php echo $data->username; ?>" placeholder="username" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <i class="material-icons prefix">email</i>
                                                            <input name="email" id="email" type="email" value="<?php echo $data->email; ?>" placeholder="email" disabled>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn-floating btn-move-up waves-effect waves-light red right modal-trigger" onclick="modal('ubah_password_superadmin')"><i class="material-icons">lock</i></button>
                                                    <button type="button" id="btn_edit" onclick="enableBtn('true')" class="btn-floating btn-move-up waves-effect waves-light light-blue right"><i class="material-icons">edit</i></button>
                                                    <button type="submit" id="btn_send" class="btn-floating btn-move-up waves-effect waves-light purple accent-4 right display_none"><i class="material-icons">send</i></button>
                                                    <button type="button" id="btn_close" onclick="enableBtn('false')" class="btn-floating btn-move-up waves-effect waves-light yellow darken-2 right display_none"><i class="material-icons">close</i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('.carousel.carousel-slider').carousel({fullWidth: true});
  $(function() {
      $("#formValidate").validate({
          rules: {
              nama: {
                  required: true,
                  maxlength: 40
              },
              username: {
                  required: true,
                  maxlength: 15
              },
              email: {
                  required: true,
                  maxlength: 50
              },
          },
          messages: {
              nama: {
                  required: "Silahkan diisi...",
                  maxlength: "Maksimal 40 karakter."
              },
              username: {
                  required: "Silahkan diisi...",
                  maxlength: "Maksimal 15 karakter."
              },
              email: {
                  required: "Silahkan diisi...",
                  maxlength: "Maksimal 50 karakter."
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
                  type: "POST",data:values,url: "<?php echo base_url('Superadmin/ubah_profil_superadmin'); ?>",
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
  function enableBtn(str) {
      if (str=="true"){
          $("#nama").prop('disabled', false);
          $("#username").prop('disabled', false);
          $("#email").prop('disabled', false);
          $("#btn_close").show();
          $("#btn_send").show();
          $("#btn_edit").hide();
      } else {
          $("#nama").prop('disabled', true);
          $("#username").prop('disabled', true);
          $("#email").prop('disabled', true);
          $("#btn_close").hide();
          $("#btn_send").hide();
          $("#btn_edit").show();
      }
  }
  function modal(str) {
      $('#load-progress-profil').show();
      $.ajax(
          {
              type: "GET",
              data:{type:str},
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
  $(document).ready(function(){
      $('.modal').modal();
  });
</script>
