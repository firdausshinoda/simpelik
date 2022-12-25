<script type="text/javascript" src="<?php echo base_url('assets/custom-script.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation-1.15.0/dist/jquery.validate.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/data-tables/js/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/data-tables/data-tables-script.js');?>"></script>
<script type="text/javascript">
  (function($){
    $(function(){
      $('.button-collapse').sideNav();
    });
  })(jQuery);
  function errorr() {
    setTimeout(function() {
        Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
    }, 100);
  }
</script>
