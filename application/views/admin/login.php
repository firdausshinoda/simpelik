<style media="screen">
.bg-1{
  background: url(assets/document/style/img/bg101.png) no-repeat center center fixed;
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        background-size: 100% 100%;
}
</style>
<div class="row intro valign-wrapper shades-text text-black no-margin bg-1 cyan lighten-4">
  <div class="container">
    <div class="row">
        <div class="col s12 m4 offset-m8">
        <div class="card" style="margin: 0 .2rem 0 0;">
          <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
            <div class="indeterminate"></div>
          </div>
          <div class="card-content">
            <h4 class="header2">Sign-In Admin</h4>
            <div class="row">
              <form class="formValidate" id="formValidate">
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix ">account_circle</i>
                    <input type="text" name="username">
                    <label>Username</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password">
                    <label>Password</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s11">
                    <button class="btn blue darken-3 waves-effect waves-light right" type="submit">Masuk
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
  $('#formValidate').validate({
    rules: {
      username: "required",password: "required"
    },
    messages: {
      username: "Silahkan diisi.",password: "Silahkan diisi."
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
          type: "POST",data:values,url: "<?php echo base_url('Sistem/sign_in_admin'); ?>",
          success: function(data)
          {
            if (data == 0){
              setTimeout(function() {
                  Materialize.toast('<span>Username atau password salah.</span>', 3000);
              }, 100);
              $('#load-progress-pesan').hide();
            } else{window.location = data;}
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
</script>
