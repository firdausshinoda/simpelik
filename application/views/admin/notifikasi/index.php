<?php if ($page=="index"):?>
    <div class="col s12">
        <div id="profile-page-wall-posts"class="row">
            <div class="col s6 m6 l6 offset-s3 offset-m3 offset-l3" style="margin-top: 2rem">
                <?php $i=0; foreach ($data as $value): $i++; ?>
                    <div id="profile-page-wall-post" class="card" style="margin: 0 0 .2rem 0;">
                        <div class="card-profile-title" style="padding:10px">
                            <div class="row" style="margin-bottom:auto">
                                <div class="col s1">
                                    <img src="<?php echo $value['img_user']?>" alt="" class="circle responsive-img valign profile-post-uer-image">
                                </div>
                                <div class="col s10">
                                    <p class="grey-text text-darken-4 margin"><a href="<?php echo base_url('Aduan')."/".$value['id_tb_aduan'];?>"><?php echo $value['keterangan']; ?></a></p>
                                    <span class="grey-text text-darken-1 ultra-small"><?php echo $value['cdate']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif;?>
