<?php if ($modal=="ubah_foto_admin"): ?>
    <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
        <div class="indeterminate" id="progressBar"></div>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="col s12 m12 l12">
                <center><h5><b>Merubah Foto</b></h5></center>
                <div class="input-field col s5 m5 l5">
                    <center><img src="<?php echo base_url('assets/document/style/img/gallery.png')?>" alt="Img" class="responsive thumb-image" id="uploadPreviewsp1"></center>
                </div>
                <div class="input-field col s6 m6 l6">
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
    </div>
    <div class="modal-footer amber lighten-4">
        <button class="btn blue darken-3 waves-effect waves-light" type="button" onclick="simpan()">Simpan
            <i class="material-icons right">send</i>
        </button>
        <button class="btn red darken-3 modal-action modal-close waves-effect waves-green " type="button">Tutup
            <i class="material-icons right">close</i>
        </button>
    </div>
    <script type="text/javascript">
        function PreviewImagesp1() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("foto").files[0]);
            oFReader.onload = function (oFREvent)
            {
                document.getElementById("uploadPreviewsp1").src = oFREvent.target.result;
            };
        };
        function simpan() {
            var file = $("#foto")[0].files;
            if (file.length == 0) {
                setTimeout(function() {
                    Materialize.toast('<span>File gambar kosong.</span>', 3000);
                }, 100);
            } else {
                $("#load-progress-pesan").show();
                var data = new FormData();
                data.append("file", file[0]);
                $.ajax({
                    xhr : function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            if(e.lengthComputable){
                                console.log('Bytes Loaded : ' + e.loaded);
                                console.log('Total Size : ' + e.total);
                                console.log('Persen : ' + (e.loaded / e.total));
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                            }
                        });
                        return xhr;
                    },
                    type : "POST",
                    url : "<?php echo base_url('Admin/update_foto_admin'); ?>",
                    data : data,
                    processData: false,
                    contentType: false,
                    success : function(data){
                        $('#load-progress-pesan').hide();
                        if (data==1) {
                            $('#modal_dialog').modal('close');
                            window.location.reload();
                        } else {
                            setTimeout(function() {
                                Materialize.toast('<span>Gagal menyimpan gambar.</span>', 3000);
                            }, 100);
                        }
                    },
                    error:function(data){
                        $('#load-progress-pesan').hide();
                        setTimeout(function() {
                            Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                        }, 100);
                    }
                });
            }
        }
    </script>
<?php endif; ?>
<?php if ($modal=="ubah_deskripsi_admin"): ?>
    <form class="formValidate" id="formValidate">
        <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
            <div class="indeterminate" id="progressBar"></div>
        </div>
        <div class="modal-content">
            <center><h5><b>Merubah Deskripsi</b></h5></center>
            <div class="row">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea id="deskripsi" class="materialize-textarea" name="deskripsi"><?php echo $deskripsi; ?></textarea>
                        <label for="deskripsi">Deskripsi</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer amber lighten-4">
            <button class="btn blue darken-3 waves-effect waves-light" type="submit">Simpan<i class="material-icons right">send</i></button>
            <button class="btn red darken-3 modal-action modal-close waves-effect waves-green " type="button">Tutup<i class="material-icons right">close</i></button>
        </div>
    </form>
    <script type="text/javascript">
        $("#formValidate").validate({
            rules: { deskripsi: "required" },
            messages: { deskripsi: "Silahkan diisi..." },
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
                    type: "POST",data:values,url: "<?php echo base_url('Admin/ubah_deskripsi_admin'); ?>",
                    success: function(data)
                    {
                        $('#load-progress-pesan').hide();
                        if (data==1) {
                            $('#modal_dialog').modal('close');
                            window.location.reload();
                        } else {
                            setTimeout(function() {
                                Materialize.toast('<span>Gagal menyimpan.</span>', 3000);
                            }, 100);
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
    </script>
<?php endif; ?>
<?php if ($modal=="tambah_gallery_admin"): ?>
    <form class="formValidate" id="formValidate">
        <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
            <div class="indeterminate" id="progressBar"></div>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12 l12">
                    <center><h5><b>Tambah Gallery</b></h5></center>
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <div class="file-field input-field">
                                <div class="btn blue">
                                    <span>File</span>
                                    <input class="btn left" type="file" value="Cari" id="foto" name="foto[]" accept=".jpeg,.png,.jpg" multiple="" onchange="preview_img()" required/>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <div class="row" id="preview" style="display:none;">
                                <div class="col s12 m12 l12">
                                    <div id="img_preview"></div>
                                </div>
                                <button id="btn_hps_img" type="button" onclick="hapus()" class="btn red waves-effect waves-block waves-light">Hapus Semua</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer amber lighten-4">
            <button class="btn blue darken-3 waves-effect waves-light" type="submit">Simpan
                <i class="material-icons right">send</i>
            </button>
            <button class="btn red darken-3 modal-action modal-close waves-effect waves-green " type="button">Tutup
                <i class="material-icons right">close</i>
            </button>
        </div>
    </form>
    <script type="text/javascript">
        var array_imgName = [];
        var n = 0;
        var array_file = 0;
        function preview_img()
        {
            $("#preview").show();
            $("#btn_hps_img").fadeIn('slow');
            var input = document.getElementById("foto");
            var files = input.files;
            var len = files.length;
            for (var i = 0; i < len; i++)
            {
                var file = input.files[i];
                array_imgName[n] = file;
                var oFReader = new FileReader();
                var k = 1;
                var nBytes = input.files[i].size;
                var sOutput = nBytes + " bytes";
                for (var aMultiples = ["K", "M", "G", "T", "P", "E", "Z", "Y"], nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
                    sOutput = nApprox.toFixed(3) +" "+ aMultiples[nMultiple];
                }
                oFReader.fileName = file.name.substring(0, 18)+"...";
                oFReader.fileSize = sOutput;
                oFReader.fileKe = n;
                oFReader.fileArray = array_imgName;
                oFReader.onload = function (e){
                    $("#img_preview").append("<div class='col s3 m3 l3 fp' data-id='"+e.target.fileKe+"'><div class='card'><div class='card-image waves-effect waves-block waves-light' style='display: block;width: 100%;position: relative;height: 0;padding: 56.25% 0 0 0;overflow: hidden;'><img class='activator' src='"+e.target.result+"' alt='gallery' style='position: absolute;display: block;margin: auto;left: 0;right: 0;top: 0;bottom: 0;'></div><div class='card-content' style='padding:5px;'><p>Ukuran : "+e.target.fileSize+"</p><a href='javascript:avoid()' class='btn-floating btn-move-up waves-effect waves-light red remove right' style='margin-right: 15px !important;;top:-55px;'><i class='material-icons'>delete</i></a></div></div></div>");
                    $(".remove").click(function(){
                        $(this).parents(".fp").remove();
                        var q = $(this).parents(".fp").data("id");
                        e.target.fileArray.splice(q, 1);
                        if (array_imgName.length == 0) {
                            $("#btn_hps_img").fadeOut('slow');
                            array_imgName = [];
                            n = 0;
                        }
                    });
                };
                oFReader.readAsDataURL(file);
                n = n+1;
            }
        }
        function hapus()
        {
            $("#foto").val('');
            $("#img_preview").html('');
            $("#btn_hps_img").fadeOut('slow');
            array_imgName = [];
            n = 0;
            $('#formValidate').trigger("reset");
            $('.prefix').removeClass('active');
        }
        $("#formValidate").validate({
            rules: { foto: "required" },
            messages: { foto: "Silahkan pilih file..." },
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
                var values = new FormData();
                for (var x = 0; x < array_imgName.length; x++)
                {values.append("userFiles[]", array_imgName[x]);}
                $('#load-progress-pesan').show();
                $.ajax({
                    type: "POST",
                    data:values,
                    url: "<?php echo base_url('Admin/tambah_gallery_admin'); ?>",
                    processData : false,
                    contentType : false,
                    success: function(data)
                    {
                        $('#load-progress-pesan').hide();
                        if (data==1) {
                            $('#modal_dialog').modal('close');
                            window.location.reload();
                        } else {
                            setTimeout(function() {
                                Materialize.toast('<span>Gagal menyimpan.</span>', 3000);
                            }, 100);
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
    </script>
<?php endif; ?>
<?php if ($modal=="ubah_password_admin"): ?>
    <form class="formValidate" id="formValidate">
        <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
            <div class="indeterminate" id="progressBar"></div>
        </div>
        <div class="modal-content">
            <center><h5><b>Merubah Password</b></h5></center>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password_baru" id="password_baru">
                    <label>Password Baru</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password_lama" id="password_lama">
                    <label>Password Lama</label>
                </div>
            </div>
        </div>
        <div class="modal-footer amber lighten-4">
            <button class="btn blue darken-3 waves-effect waves-light" type="submit">Simpan<i class="material-icons right">send</i></button>
            <button class="btn red darken-3 modal-action modal-close waves-effect waves-green " type="button">Tutup<i class="material-icons right">close</i></button>
        </div>
    </form>
    <script type="text/javascript">
        $("#formValidate").validate({
            rules: {
                password_baru:  {
                    required: true,
                    minlength: 6
                }, password_lama: "required" },
            messages: {
                password_baru: {
                    required: "Silahkan diisi...",
                    minlength: "Minimal 6 karakter."
                }, password_lama: "Silahkan diisi..." },
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
                    type: "POST",data:values,url: "<?php echo base_url('Admin/ubah_password_admin'); ?>",
                    success: function(data)
                    {
                        $('#load-progress-pesan').hide();
                        if (data==1) {
                            $('#modal_dialog').modal('close');
                            window.location.reload();
                        } else {
                            setTimeout(function() {
                                Materialize.toast(data, 3000);
                            }, 100);
                        }
                    },
                    error:function(data){
                        errorr();
                        $('#load-progress-pesan').hide();
                    }
                });
            }
        });
    </script>
<?php endif; ?>
<?php if ($modal=="tambah_lokasi"): ?>
    <form class="formValidate" id="formValidate">
        <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
            <div class="determinate" id="progressBar"></div>
        </div>
        <div class="modal-content">
            <center><h5><b>Menambahkan Lokasi Tempat Umum</b></h5></center>
            <div class="row">
                <div class="col s6 m6 l6">
                    <div class="input-field col s12 m12 l12">
                        <div class="file-field input-field">
                            <div class="btn blue">
                                <span>File</span>
                                <input class="btn left" type="file" value="Cari" id="foto" name="foto[]" accept=".jpeg,.png,.jpg" multiple="" onchange="preview_img()"/>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Gambar tidak wajib">
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <div class="row" id="preview" style="display:none;">
                            <div class="col s12 m12 l12">
                                <div id="img_preview"></div>
                            </div>
                            <button id="btn_hps_img" type="button" onclick="hapus()" class="btn red waves-effect waves-block waves-light">Hapus Semua</button>
                        </div>
                    </div>
                </div>
                <div class="col s6 m6 l6">
                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                            <i class="material-icons prefix ">place</i>
                            <input type="text" name="lati" id="lati" value="<?php echo $lati;?>" disabled>
                        </div>
                        <div class="input-field col s6 m6 l6">
                            <i class="material-icons prefix">place</i>
                            <input type="text" name="longi" id="longi" value="<?php echo $longi;?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="jenis_lokasi" id="jenis_lokasi" required="required">
                                <option value="" disabled selected>Pilih</option>
                                <?php foreach ($dt_jenis_lokasi->result() as $val): ?>
                                    <option value="<?php echo $val->id_tb_jenis_lokasi_tempat_umum;?>"><?php echo $val->nama_jenis_lokasi; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label>Jenis Lokasi</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix ">store_mall_directory</i>
                            <input type="text" name="nama" id="nama" data-length="25">
                            <label>Nama Lokasi</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">subject</i>
                            <textarea id="deskripsi" class="materialize-textarea" name="deskripsi"></textarea>
                            <label for="deskripsi">Deskripsi</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer amber lighten-4">
            <button class="btn blue darken-3 waves-effect waves-light" type="submit">Simpan<i class="material-icons right">send</i></button>
            <button class="btn red darken-3 modal-action modal-close waves-effect waves-green " type="button">Tutup<i class="material-icons right">close</i></button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $('select').material_select();
            $("select[required]").css({position: "absolute", display: "inline", height: 0, padding: 0, width: 0});
        });
        $("#formValidate").validate({
            rules: {
                nama: {
                    required: true,
                    maxlength: 25
                },
                deskripsi:"required",
                jenis_lokasi:"required",
            },
            messages: {
                nnama: {
                    required: "Silahkan diisi...",
                    maxlength: "Maksimal 25 karakter."
                },
                deskripsi: "Silahkan diisi...",
                jenis_lokasi: "Silahkan dipilih...",
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
                var values = new FormData();
                for (var x = 0; x < array_imgName.length; x++)
                {values.append("userFiles[]", array_imgName[x]);}
                values.append("lati", $("#lati").val());
                values.append("longi", $("#longi").val());
                values.append("nama", $("#nama").val());
                values.append("deskripsi", $("#deskripsi").val());
                values.append("jenis_lokasi", $("#jenis_lokasi").val());
                $('#load-progress-pesan').show();
                $.ajax({
                    xhr : function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            if(e.lengthComputable){
                                console.log('Bytes Loaded : ' + e.loaded);
                                console.log('Total Size : ' + e.total);
                                console.log('Persen : ' + (e.loaded / e.total));
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                            }
                        });
                        return xhr;
                    },
                    type: "POST",
                    data:values,
                    url: "<?php echo base_url('Admin/tambah_lokasi_tempat_umum'); ?>",
                    processData : false,
                    contentType : false,
                    success: function(data)
                    {
                        $('#load-progress-pesan').hide();
                        if (data==1) {
                            $("#div_add_location").show();
                            $("#div_close_location").hide();
                            $('#modal_dialog').modal('close');
                        } else {
                            setTimeout(function() {
                                Materialize.toast('<span>Gagal menyimpan.</span>', 3000);
                            }, 100);
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
        var array_imgName = [];
        var n = 0;
        var array_file = 0;
        function preview_img()
        {
            $("#preview").show();
            $("#btn_hps_img").fadeIn('slow');
            var input = document.getElementById("foto");
            var files = input.files;
            var len = files.length;
            for (var i = 0; i < len; i++)
            {
                var file = input.files[i];
                array_imgName[n] = file;
                var oFReader = new FileReader();
                var k = 1;
                var nBytes = input.files[i].size;
                var sOutput = nBytes + " bytes";
                for (var aMultiples = ["K", "M", "G", "T", "P", "E", "Z", "Y"], nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
                    sOutput = nApprox.toFixed(3) +" "+ aMultiples[nMultiple];
                }
                oFReader.fileName = file.name.substring(0, 18)+"...";
                oFReader.fileSize = sOutput;
                oFReader.fileKe = n;
                oFReader.fileArray = array_imgName;
                oFReader.onload = function (e){
                    $("#img_preview").append("<div class='col s6 m6 l6 fp' data-id='"+e.target.fileKe+"'><div class='card'><div class='card-image waves-effect waves-block waves-light' style='display: block;width: 100%;position: relative;height: 0;padding: 56.25% 0 0 0;overflow: hidden;'><img class='activator' src='"+e.target.result+"' alt='gallery' style='position: absolute;display: block;margin: auto;left: 0;right: 0;top: 0;bottom: 0;'></div><div class='card-content' style='padding:5px;'><p>Ukuran : "+e.target.fileSize+"</p><a href='javascript:avoid()' class='btn-floating btn-move-up waves-effect waves-light red remove right' style='margin-right: 15px !important;;top:-55px;'><i class='material-icons'>delete</i></a></div></div></div>");
                    $(".remove").click(function(){
                        $(this).parents(".fp").remove();
                        var q = $(this).parents(".fp").data("id");
                        e.target.fileArray.splice(q, 1);
                        if (array_imgName.length == 0) {
                            $("#btn_hps_img").fadeOut('slow');
                            array_imgName = [];
                            n = 0;
                        }
                    });
                };
                oFReader.readAsDataURL(file);
                n = n+1;
            }
        }
        function hapus()
        {
            $("#foto").val('');
            $("#img_preview").html('');
            $("#btn_hps_img").fadeOut('slow');
            array_imgName = [];
            n = 0;
            $('#formValidate').trigger("reset");
            $('.prefix').removeClass('active');
        }
    </script>
<?php endif; ?>
<?php if ($modal=="edit_lokasi"): ?>
    <form class="formValidate" id="formValidate">
        <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
            <div class="determinate" id="progressBar"></div>
        </div>
        <div class="modal-content">
            <center><h5><b>Mengubah Lokasi Tempat Umum</b></h5></center>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                            <i class="material-icons prefix ">place</i>
                            <input type="hidden" name="id_tb_lokasi_tempat_umum" value="<?php echo $dt->id_tb_lokasi_tempat_umum;?>">
                            <input type="text" name="lati" id="lati" value="<?php echo $dt->lati;?>" disabled>
                        </div>
                        <div class="input-field col s6 m6 l6">
                            <i class="material-icons prefix">place</i>
                            <input type="text" name="longi" id="longi" value="<?php echo $dt->longi;?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="jenis_lokasi" id="jenis_lokasi" required="required">
                                <option value="<?php echo $dt->id_tb_jenis_lokasi_tempat_umum;?>"><?php echo getValueWhere("nama_jenis_lokasi","tb_jenis_lokasi_tempat_umum","id_tb_jenis_lokasi_tempat_umum",$dt->id_tb_jenis_lokasi_tempat_umum)->row()->nama_jenis_lokasi; ?></option>
                                <?php foreach ($dt_jenis_lokasi->result() as $val): ?>
                                    <option value="<?php echo $val->id_tb_jenis_lokasi_tempat_umum;?>"><?php echo $val->nama_jenis_lokasi; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label>Jenis Lokasi</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix ">store_mall_directory</i>
                            <input type="text" name="nama" id="nama" data-length="25" value="<?php echo $dt->nama_lokasi;?>">
                            <label>Nama Lokasi</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">subject</i>
                            <textarea id="deskripsi" class="materialize-textarea" name="deskripsi"><?php echo $dt->deskripsi_lokasi ?></textarea>
                            <label for="deskripsi">Deskripsi</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer amber lighten-4">
            <button class="btn blue darken-3 waves-effect waves-light" type="submit">Simpan<i class="material-icons right">send</i></button>
            <button class="btn red darken-3 modal-action modal-close waves-effect waves-green " type="button">Tutup<i class="material-icons right">close</i></button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $('select').material_select();
            $("select[required]").css({position: "absolute", display: "inline", height: 0, padding: 0, width: 0});
        });
        $("#formValidate").validate({
            rules: {
                nama: {
                    required: true,
                    maxlength: 25
                },
                deskripsi:"required",
                jenis_lokasi:"required",
            },
            messages: {
                nnama: {
                    required: "Silahkan diisi...",
                    maxlength: "Maksimal 25 karakter."
                },
                deskripsi: "Silahkan diisi...",
                jenis_lokasi: "Silahkan dipilih...",
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
                    xhr : function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            if(e.lengthComputable){
                                console.log('Bytes Loaded : ' + e.loaded);
                                console.log('Total Size : ' + e.total);
                                console.log('Persen : ' + (e.loaded / e.total));
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                            }
                        });
                        return xhr;
                    },
                    type: "POST",
                    data:values,
                    url: "<?php echo base_url('Admin/edit_lokasi_tempat_umum'); ?>",
                    success: function(data) {
                        $('#load-progress-pesan').hide();
                        if (data==1) {
                            $('#modal_dialog').modal('close');
                            closeSideNav();
                            openSideNav("<?php echo $dt->id_tb_lokasi_tempat_umum;?>");
                            setTimeout(function() {
                                Materialize.toast('<span>Data berhasil diubah.</span>', 3000);
                            }, 100);
                        } else {
                            setTimeout(function() {
                                Materialize.toast('<span>Gagal menyimpan.</span>', 3000);
                            }, 100);
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
    </script>
<?php endif; ?>
<?php if ($modal=="tambah_foto_lokasi"): ?>
    <form class="formValidate" id="formValidate">
        <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
            <div class="determinate" id="progressBar"></div>
        </div>
        <div class="modal-content">
            <center><h5><b>Menambahkan Foto Lokasi Tempat Umum</b></h5></center>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="input-field col s12 m12 l12">
                        <div class="file-field input-field">
                            <div class="btn blue">
                                <span>File</span>
                                <input class="btn left" type="file" value="Cari" id="foto" name="foto[]" accept=".jpeg,.png,.jpg" multiple="" onchange="preview_img()"/>
                                <input type="hidden" id="id_tb_lokasi_tempat_umum" value="<?php echo $id; ?>">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Gambar tidak wajib">
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <div class="row" id="preview" style="display:none;">
                            <div class="col s12 m12 l12">
                                <div id="img_preview"></div>
                            </div>
                            <button id="btn_hps_img" type="button" onclick="hapus()" class="btn red waves-effect waves-block waves-light">Hapus Semua</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer amber lighten-4">
            <button class="btn blue darken-3 waves-effect waves-light" type="submit">Simpan<i class="material-icons right">send</i></button>
            <button class="btn red darken-3 modal-action modal-close waves-effect waves-green " type="button">Tutup<i class="material-icons right">close</i></button>
        </div>
    </form>
    <script type="text/javascript">
        $("#formValidate").validate({
            rules: {
                foto:"required"
            },
            messages: {
                foto: "Silahkan dipilih...",
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
                if (array_imgName.length == 0) {
                    setTimeout(function() {
                        Materialize.toast('<span>Silahkan pilih foto.</span>', 3000);
                    }, 100);
                } else {
                    var id_tb_lokasi_tempat_umum = $("#id_tb_lokasi_tempat_umum").val();
                    var values = new FormData();
                    for (var x = 0; x < array_imgName.length; x++)
                    {values.append("userFiles[]", array_imgName[x]);}
                    values.append("id_tb_lokasi_tempat_umum", id_tb_lokasi_tempat_umum);
                    $('#load-progress-pesan').show();
                    $.ajax({
                        xhr : function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(e){
                                if(e.lengthComputable){
                                    console.log('Bytes Loaded : ' + e.loaded);
                                    console.log('Total Size : ' + e.total);
                                    console.log('Persen : ' + (e.loaded / e.total));
                                    var percent = Math.round((e.loaded / e.total) * 100);
                                    $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                                }
                            });
                            return xhr;
                        },
                        type: "POST",
                        data:values,
                        url: "<?php echo base_url('Admin/tambah_foto_lokasi_tempat_umum'); ?>",
                        processData : false,
                        contentType : false,
                        success: function(data)
                        {
                            $('#load-progress-pesan').hide();
                            if (data==1) {
                                $('#modal_dialog').modal('close');
                                closeSideNav();
                                openSideNav(id_tb_lokasi_tempat_umum);
                                setTimeout(function() {
                                    Materialize.toast('<span>Data berhasil diubah.</span>', 3000);
                                }, 100);
                            } else {
                                setTimeout(function() {
                                    Materialize.toast('<span>Gagal menyimpan.</span>', 3000);
                                }, 100);
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
            }
        });
        var array_imgName = [];
        var n = 0;
        var array_file = 0;
        function preview_img()
        {
            $("#preview").show();
            $("#btn_hps_img").fadeIn('slow');
            var input = document.getElementById("foto");
            var files = input.files;
            var len = files.length;
            for (var i = 0; i < len; i++)
            {
                var file = input.files[i];
                array_imgName[n] = file;
                var oFReader = new FileReader();
                var k = 1;
                var nBytes = input.files[i].size;
                var sOutput = nBytes + " bytes";
                for (var aMultiples = ["K", "M", "G", "T", "P", "E", "Z", "Y"], nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
                    sOutput = nApprox.toFixed(3) +" "+ aMultiples[nMultiple];
                }
                oFReader.fileName = file.name.substring(0, 18)+"...";
                oFReader.fileSize = sOutput;
                oFReader.fileKe = n;
                oFReader.fileArray = array_imgName;
                oFReader.onload = function (e){
                    $("#img_preview").append("<div class='col s4 m4 l4 fp' data-id='"+e.target.fileKe+"'><div class='card'><div class='card-image waves-effect waves-block waves-light' style='display: block;width: 100%;position: relative;height: 0;padding: 56.25% 0 0 0;overflow: hidden;'><img class='activator' src='"+e.target.result+"' alt='gallery' style='position: absolute;display: block;margin: auto;left: 0;right: 0;top: 0;bottom: 0;'></div><div class='card-content' style='padding:5px;'><p>Ukuran : "+e.target.fileSize+"</p><a href='javascript:avoid()' class='btn-floating btn-move-up waves-effect waves-light red remove right' style='margin-right: 15px !important;;top:-55px;'><i class='material-icons'>delete</i></a></div></div></div>");
                    $(".remove").click(function(){
                        $(this).parents(".fp").remove();
                        var q = $(this).parents(".fp").data("id");
                        e.target.fileArray.splice(q, 1);
                        if (array_imgName.length == 0) {
                            $("#btn_hps_img").fadeOut('slow');
                            array_imgName = [];
                            n = 0;
                        }
                    });
                };
                oFReader.readAsDataURL(file);
                n = n+1;
            }
        }
        function hapus()
        {
            $("#foto").val('');
            $("#img_preview").html('');
            $("#btn_hps_img").fadeOut('slow');
            array_imgName = [];
            n = 0;
            $('#formValidate').trigger("reset");
            $('.prefix').removeClass('active');
        }
    </script>
<?php endif; ?>
<?php if ($modal=="map_aduan"): ?>
    <div class="modal-content">
        <center><h5><b>Peta Aduan</b></h5></center>
        <div id="maps" class="blue" style="width: 100%;height: 90%"></div>
    </div>
    <div class="modal-footer amber lighten-4">
        <button class="btn red darken-3 modal-action modal-close waves-effect waves-green " type="button">Tutup<i class="material-icons right">close</i></button>
    </div>
    <script type="text/javascript">
        var map;
        function initMap() {
            var position = {lat: <?php echo $lati;?>, lng: <?php echo $longi;?>};

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

            map = new google.maps.Map(document.getElementById('maps'), {
                zoom: 14,
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnNpZ0vxJXqcMDTaclUEIxUTUB8Izb1V0&?sensor=true"></script>
<?php endif; ?>
<?php if ($modal=="map_profil"): ?>
    <div class="progress" id="load-progress-pesan" style="margin: 0 0 0 0;display:none">
        <div class="determinate" id="progressBar"></div>
    </div>
    <div class="modal-content">
        <center><h5><b>Peta Profil</b></h5></center>
        <div id="maps" class="blue" style="width: 100%;height: 80%"></div>
        <p>Silahkan tekan pada peta untuk mengubah lokasi.</p>
    </div>
    <div class="modal-footer amber lighten-4">
        <button class="btn red darken-3 modal-action modal-close waves-effect waves-green right" type="button">Tutup<i class="material-icons right">close</i></button>
        <button class="btn blue darken-3 modal-action waves-effect waves-light display_none right" type="button" onclick="ubah_peta()" id="btn_simpan" style="margin-right: 1%">Simpan<i class="material-icons right">send</i></button>
    </div>
    <script type="text/javascript">
        var map;
        var lati;
        var longi;
        var markers = [];

        function ubah_peta() {
            var values = new FormData();
            values.append("id", <?php echo $id;?>);
            values.append("lati", lati);
            values.append("longi", longi);
            $('#load-progress-pesan').show();
            $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                            console.log('Bytes Loaded : ' + e.loaded);
                            console.log('Total Size : ' + e.total);
                            console.log('Persen : ' + (e.loaded / e.total));
                            var percent = Math.round((e.loaded / e.total) * 100);
                            $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                        }
                    });
                    return xhr;
                },
                type: "POST",
                data:values,
                url: "<?php echo base_url('Admin/ubah_map_profil'); ?>",
                processData : false,
                contentType : false,
                success: function(data)
                {
                    $('#load-progress-pesan').hide();
                    if (data==1) {
                        $('#modal_dialog').modal('close');
                        window.location.reload();
                        setTimeout(function() {
                            Materialize.toast('<span>Data berhasil diubah.</span>', 3000);
                        }, 100);
                    } else {
                        setTimeout(function() {
                            Materialize.toast('<span>Gagal menyimpan.</span>', 3000);
                        }, 100);
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
        function initMap() {
            var position = new google.maps.LatLng(<?php echo $lati;?>,<?php echo $longi;?>);

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

            map = new google.maps.Map(document.getElementById('maps'), {
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

            var lat_lng =  {lat: <?php echo $lati;?>, lng: <?php echo $longi;?>};

            markers=[];
            var marker = new google.maps.Marker({
                position: lat_lng,
                map: map
            });
            markers.push(marker);

            map.addListener('click', function(event) {
                markers[0].setMap(null);
                markers=[];
                $('#btn_simpan').show();
                var marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });
                markers.push(marker);
                lati=event.latLng.lat();
                longi=event.latLng.lng();
            });
        }
        initMap();

        function checkTime(i) {
            if (i < 10) {i = "0" + i};
            return i;
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnNpZ0vxJXqcMDTaclUEIxUTUB8Izb1V0&callback=initMap"></script>
<?php endif; ?>
