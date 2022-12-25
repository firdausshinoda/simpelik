<?php if ($page=="index") :?>
    <div class="demo-ribbon blue-grey lighten-2"></div>
    <div class="col s12 m12 l12 demo-main" style="height:100%">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s10 m10 l10 offset-s1 offset-m1 offset-l1">
                <div class="card" style="overflow: visible">
                    <div class="progress display_none" id="load-progress-pesan" style="margin: 0 0 0 0;">
                        <div class="indeterminate" id="progressBar"></div>
                    </div>
                    <div class="card-content">
                        <span class="card-title"><h6>Laporan Aduan</h6></span>
                        <form class="formValidate" id="formValidate">
                            <div class="row">
                                <div class="col s4 m4 l4">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select name="jenis" id="jenis" required="required" onchange="setJenis(this.value)">
                                                <option value="" selected>Pilih</option>
                                                <option value="grafik">Grafik</option>
                                                <option value="tabel">Tabel</option>
                                            </select>
                                            <label>Jenis</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s4 m4 l4">
                                    <div class="row display_none" id="v_tahun">
                                        <div class="input-field col s12">
                                            <select name="tahun" id="tahun" required="required">
                                                <option value="" selected>Pilih</option>
                                                <?php foreach ($tahun as $key):?>
                                                    <option value="<?php echo $key['tahun']?>"><?php echo $key['tahun']?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <label>Tahun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s4 m4 l4">
                                    <div class="row display_none" id="v_instansi">
                                        <div class="input-field col s12">
                                            <select name="instansi" id="instansi" required title="Silahkan dipilih.">
                                                <option value="" selected>Pilih</option>
                                                <option value="semua">Semua Instansi</option>
                                                <?php foreach ($instansi->result() as $value):?>
                                                    <option value="<?php echo $value->id_tb_admin;?>"><?php echo $value->nama_admin;?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <label>Instansi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn blue darken-3 waves-effect waves-light" type="submit">Tampilkan<i class="material-icons right">send</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="viewLaporan"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function setJenis(jns) {
            if (jns=="grafik"){
                $('#v_instansi').hide('2000');
                $('#v_tahun').hide('2000');
            } else {
                $('#v_instansi').show('2000');
                $('#v_tahun').show('2000');
            }
        }
        $(document).ready(function(){
            $('select').material_select();
            $("select[required]").css({position: "absolute", display: "inline", height: 0, padding: 0, width: 0});
        });
        $(function() {
            $('#formValidate').validate({
                rules: {
                    tahun: "required",jenis: "required"
                },
                messages: {
                    tahun: "Silahkan dipilih.",jenis: "Silahkan dipilih."
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
                        type: "POST",data:values,url: "<?php echo base_url('Superadmin/getDataLaporanMenu'); ?>",
                        success: function(data)
                        {
                            $('#load-progress-pesan').hide();
                            $('#viewLaporan').html(data);
                        },
                        error:function(data){
                            $('#load-progress-pesan').hide();
                            setTimeout(function() {
                                Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                            }, 100);
                        }
                    });
                }
            });
        });
    </script>
<?php endif; ?>
<?php if ($page=="tabel"):?>
    <style type="text/css">
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
    <div class="card">
        <div class="card-content">
            <span class="card-title"><h6>Tabel Hasil Laporan</h6></span>
            <table id="data-table-simple">
                <thead>
                <tr>
                    <th><center>No</center></th>
                    <th><center>Isi Aduan</center></th>
                    <th><center>Nama Pengadu</center></th>
                    <th><center>Nama Instansi</center></th>
                    <th><center>Respon Masyarakat</center></th>
                    <th><center>Respon Instansi</center></th>
                    <th><center>Alamat</center></th>
                    <th><center>Waktu Pengaduan</center></th>
                    <th><center>Pilihan</center></th>
                </tr>
                </thead>
                <?php $i=0; foreach ($data as $key): $i++;?>
                    <tbody>
                    <tr class="grey lighten-4">
                        <td><?php echo $key['no'];?></td>
                        <td><a class="blue-text text-darken-3" href="<?php echo base_url('Superadmin/detail_post')."/".safe_encode($key['id_tb_aduan']);?>"><?php echo $key['isi_aduan'];?></a></td>
                        <td><a class="blue-text text-darken-3" href="<?php echo base_url('Superadmin/detail_user')."/".safe_encode($key['id_tb_user']);?>"><?php echo $key['nama_user'];?></a></td>
                        <td><a class="blue-text text-darken-3" href="<?php echo base_url('Superadmin/detail_admin')."/".safe_encode($key['id_tb_admin']);?>"><?php echo $key['nama_admin'];?></a></td>
                        <td><?php echo $key['ttl_respon_user'];?></td>
                        <td><?php echo $key['ttl_respon_admin'];?></td>
                        <td style="width: 15%"><?php echo $key['alamat'];?></td>
                        <td><?php echo $key['cdate'];?></td>
                        <td><a class="btn-floating waves-effect waves-light orange collaps" id="<?php echo "tb_".$i?>"><i class="material-icons">add</i></a></td>
                    </tr>
                    </tbody>
                    <tbody id="<?php echo "ttb_".$i?>" style="display:none">
                    <tr class="orange lighten-5">
                        <td></td>
                        <td><center>No</center></td>
                        <td colspan="4"><center>Isi Komentar</center></td>
                        <td><center>Pengirim</center></td>
                        <td colspan="2"><center>Waktu Pengiriman</center></td>
                    </tr>
                    <?php if (count($key['komentar']) > 0):?>
                        <?php foreach ($key['komentar'] as $key_2):?>
                            <tr>
                                <td></td>
                                <td><?php echo $key_2['no'];?></td>
                                <td colspan="4">
                                    <?php if (!empty($key_2['img_comment'])):?>
                                        <img src="<?php echo base_url('assets/document/img/komentar_gallery')."/".$key_2['img_comment'];?>" class="materialboxed" style="width: 30%">
                                    <?php endif;?>
                                    <?php echo json_decode('"'.$key_2['isi_komentar'].'"'); ?>
                                </td>
                                <td><?php echo $key_2['nama_pengirim'];?></td>
                                <td colspan="2"><?php echo $key_2['cdate'];?></td>
                            </tr>
                        <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="9"><center>Tidak ada komentar</center></td>
                            </tr>
                    <?php endif;?>
                    </tbody>
                <?php endforeach;?>
            </table>
        </div>
        <div class="card-action right">
            <button class="btn blue darken-3 waves-effect waves-light" type="button" onclick="redirect()">Cetak PDF<i class="material-icons right">picture_as_pdf</i></button>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/data-tables/data-tables-script.js');?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.materialboxed').materialbox();
            $(".collaps").on('click', function() {
                var id = $(this).attr('id');
                if ($('#t'+id).css("display") == "none"){
                    $('#t'+id).show('3000');
                } else {
                    $('#t'+id).hide('3000');
                }
            });
        });
        function redirect() {
            var instansi = $('#instansi').val();
            var thn = $('#tahun').val();
            window.open("<?php echo base_url('Cetak/laporan')?>/"+instansi+"/"+thn);
        }
    </script>
<?php endif; ?>
<?php if ($page=="grafik"):?>
    <div class="card" style="overflow: visible">
        <div class="progress display_none" id="load-progress-pesan" style="margin: 0 0 0 0;">
            <div class="indeterminate" id="progressBar"></div>
        </div>
        <div class="card-content">
            <span class="card-title"><h5>Laporan Grafik Aduan</h5></span>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div id="chartdiv"></div>
                </div>
            </div>
            <style>
                #chartdiv {
                    width: 100%;
                    height: 500px;
                }
            </style>

            <!-- Chart code -->
            <script>
                AmCharts.makeChart("chartdiv", {
                    "depth3D":20,
                    "angle":30,
                    "type": "serial",
                    "theme": "light",
                    "legend": {
                        "horizontalGap": 10,
                        "maxColumns": 1,
                        "position": "right",
                        "useGraphSettings": true,
                        "markerSize": 10
                    },
                    "dataProvider": <?php echo json_encode($data_grafik);?>,
                    "valueAxes": [{
                        "stackType": "regular",
                        "axisAlpha": 0.3,
                        "gridAlpha": 0
                    }],
                    "graphs": <?php echo json_encode($data_label)?>,
                    "categoryField": "year",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha": 0,
                        "gridAlpha": 0,
                        "position": "left"
                    },
                    "export": {
                        "enabled": true
                    }

                });
            </script>
        </div>
    </div>
<?php endif;?>
