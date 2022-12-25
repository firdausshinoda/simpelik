<?php if ($page=="index"): ?>
    <div class="demo-ribbon blue-grey lighten-2"></div>
    <div class="col s12 m12 l12 demo-main" style="height:100%">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s10 m10 offset-m1">
                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Pengguna</th>
                                    <th>Nama Pengguna</th>
                                    <th>Waktu</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; foreach($data as $val): $i++; ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $val['keterangan'];?></td>
                                        <td><?php echo $val['pengguna'];?></td>
                                        <td><?php echo $val['nama_pengguna'];?></td>
                                        <td><?php echo $val['waktu'];?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
