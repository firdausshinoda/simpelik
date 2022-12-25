<?php if ($page=="index"):?>
    <html>
    <head>
        <?php $this->load->view('style/header'); ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnNpZ0vxJXqcMDTaclUEIxUTUB8Izb1V0&?sensor=true&libraries=places"></script>
    </head>
    <body style="position:relative;">
    <div id="modal_dialog" class="modal modal-fixed-footer"></div>
    <main>
        <div id="main">
            <div class="wrapper">
                <section id="content">
                    <div class="col s12">
                        <div class="row intro" style="margin-bottom:0px;">
                            <div id="maps" style="width:100%;height:100%;"></div>
                            <div class="fixed-action-btn vertical click-to-toggle" style="bottom:.5%;right:53px;" id="div_add_location">
                                <a class="btn-floating btn-large pink lighten-1 waves-effect waves-light" id="fab_target">
                                    <i class="large material-icons">add</i>
                                </a>
                                <ul>
                                    <li class="display_none"><a class="btn-floating cyan button-collapse" data-activates="slide-out"><i class="material-icons">add_location</i></a></li>
                                    <li><a class="btn-floating red" id="add_location" onclick="enableClick()"><i class="material-icons">add_location</i></a></li>
                                    <li><a class="btn-floating blue" onclick="modal('tambah_jenis_lokasi','','')"><i class="material-icons">map</i></a></li>
                                </ul>
                            </div>
                            <div class="fixed-action-btn display_none" style="bottom:30px;right:53px;" id="div_close_location">
                                <a onclick="disableClick()" class="btn-floating btn-large red accent-3 waves-effect waves-light"><i class="material-icons">close</i></a>
                            </div>
                            <div class="tap-target blue lighten-1" data-activates="fab_target">
                                <div class="tap-target-content">
                                    <h5>Tombol Tambah</h5>
                                    <p>Anda dapat menambahkan lokasi tempat umum atau menambahkan jenis lokasi tempat umum dengan menekan tombol ini.</p>
                                </div>
                            </div>
                            <style media="screen">
                                .content_body_maps{
                                    position: absolute;
                                    top: 10%;
                                    width: 100%;
                                }
                                .content_nav_maps{
                                    position: absolute;
                                    top: 0%;
                                    text-align: left;
                                }
                                .collapsible-body{
                                    padding: 2px 2px 2px 22px;
                                    text-align:left
                                }
                                .side-nav{
                                    width:30%
                                }
                            </style>
                            <div class="progress display_none" id="load-progress-pesan" style="margin: 0 0 0 0;position: absolute;top: 9.8%">
                                <div class="indeterminate" id="progressBar"></div>
                            </div>
                            <div class="content_nav_maps">
                                <div class="navbar-fixed z-depth-4">
                                    <nav class="blue">
                                        <div class="nav-wrapper" style="padding:0 5%">
                                            <link href="<?php echo base_url('assets/materialize/style_index/style.min.css');?>" type="text/css" rel="stylesheet" media="screen,projection">
                                            <div class="col s2 m2 l2">
                                                <a href="javascript:void(0);" class="brand-logo">
                                                    <img class="responsive-img" src="<?php echo base_url('assets/document/style/img/icon_1.png')?>" alt="Pelayanan Publik" style="width:60px;height:60px;">
                                                </a>
                                            </div>
                                            <div class="col s6 m6 l6 hide-on-med-and-down">
                                                <style media="screen">
                                                    input:focus {
                                                        border-bottom: none!important;
                                                        box-shadow: none!important;
                                                    }
                                                    #search::placeholder, #autocomplete::placeholder{
                                                        color:#607d8b;
                                                    }
                                                </style>
                                                <div class="row">
                                                    <div class="col s12 m12 l12 search" id="search_lokasi_tempat_umum" style="color:#000;padding: 10px;border-radius: 5px;background-color: #2196F3;margin-bottom: 10px;">
                                                        <div class="input-field white" style="height: 40px;margin:.4% .4% .4% .4%;border-radius: 7px;z-index: 2">
                                                            <input id="search" type="search" placeholder="Cari lokasi tempat umum..." required class="autocomplete">
                                                            <label class="label-icon" style="top: -55%">
                                                                <i class="material-icons" style="color:#000000">search</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m12 l12 search container_search_map" style="color:#000;padding: 0;border-radius: 5px;background-color: #9e9e9e;">
                                                        <div class="input-field white" style="height: 40px;margin:.4% .4% .4% .4%;border-radius: 7px;z-index: 1;">
                                                            <input id="autocomplete" type="search" placeholder="Cari jalan..." onFocus="geolocate()">
                                                            <label class="label-icon" style="top: -55%" for="autocomplete">
                                                                <i class="material-icons" style="color:#000000">search</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s4 m4 l4 hide-on-med-and-down">
                                                <ul class="right">
                                                    <li>
                                                        <a href="<?php echo base_url('Superadmin')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Beranda">
                                                            <i class="material-icons">home</i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url('Superadmin/lokasi_tempat_umum')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Lokasi">
                                                            <i class="material-icons">map</i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url('Superadmin/admin')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Instansi">
                                                            <i class="material-icons">location_city</i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url('Superadmin/user')?>" class="waves-effect waves-block waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Masyarakat">
                                                            <i class="material-icons">people</i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button dropdown-button" data-activates="menu-dropdown">
                                                            <span><i class="material-icons">arrow_drop_down</i></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <ul id="menu-dropdown" class="dropdown-content dropdown-content-nav">
                                                <li>
                                                    <a href="<?php echo base_url('Superadmin/profil')?>"><i class="material-icons left">perm_identity</i>Profil</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('Superadmin/laporan')?>"><i class="material-icons left">assessment</i>Laporan</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('Superadmin/log')?>"><i class="material-icons left">library_books</i>Log Aktivitas</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('Superadmin/logout')?>"><i class="material-icons left">exit_to_app</i>Log Out</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                                <ul id="slide-out" class="side-nav" style="overflow:auto">
                                    <li style="height:35%">
                                        <div class="user-view" style="height:100%;width:auto;">
                                            <div class="background">
                                                <img id="sideNav_background2" class="sideNav-map">
                                                <img id="sideNav_background" class="sideNav-map">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="white-text blue">
                                        <div class="progress display_none" id="load-progress-sidenav" style="margin: 0 0 0 0;">
                                            <div class="indeterminate yellow accent-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <h6><b id="sideNav_nm_tmpt"></b></h6>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <div class="col s1 m1 l1">
                                                            <i class="material-icons">subject</i>
                                                        </div>
                                                        <div class="col s11 m11 l11">
                                                            <p id="sideNav_dsk_tmpt"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m12 l12">
                                                        <div class="col s1 m1 l1">
                                                            <i class="material-icons">place</i>
                                                        </div>
                                                        <div class="col s11 m11 l11">
                                                            <p id="sideNav_lks_tmpt"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m12 l12" id="iconEditLokasi"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="black-text" style="padding-bottom:5%;">
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <p>Gallery</p>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <div id="sideNav_gallery"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="content_body_maps">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div class="col s3 m3 l3 right">
                                            <div class="input-field right">
                                                <a class="btn-floating btn-large waves-effect waves-light blue tooltipped" onclick="showMenu()" data-position="bottom" data-delay="50" data-tooltip="Daftar Menu Peta"><i class="material-icons">menu</i></a>
                                                <a class="btn-floating btn-large waves-effect waves-light red tooltipped" onclick="clearMarker()" data-position="bottom" data-delay="50" data-tooltip="Menghilangkan Semuar Marker"><i class="material-icons">check</i></a>
                                            </div>
                                        </div>
                                        <div class="col s12 m12 l12">
                                            <ul class="collapsible collapsible-accordion display_none" id="containerMenu" data-collapsible="accordion" style="position: absolute;width:20%;right:1%;">
                                                <li>
                                                    <div class="collapsible-header light-blue light-blue-text text-lighten-5">
                                                        <i class="material-icons">map</i>MENU
                                                    </div>
                                                </li>
                                                <script type="text/javascript">
                                                    var dt_lokasi=[];
                                                    $.each(<?php echo $dt_lokasi; ?>, function( key, value ) {
                                                        dt_lokasi.push([value.nama,value.lt,value.lg,value.id_jenis_lokasi,value.img_lokasi,value.id_lokasi,'lokasi']);
                                                    });
                                                </script>
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">receipt</i>Lokasi Aduan
                                                        <span class="white-text badge purple darken-1"><?php echo $jml_aduan;?></span>
                                                    </div>
                                                    <div class="collapsible-body purple lighten-5">
                                                        <input type="checkbox" class="checkbox" id="btn_map_lokasi0" onclick="setMapLokasi(this,'0')"><label for="btn_map_lokasi0">Aduan</label>
                                                    </div>
                                                </li>
                                                <script type="text/javascript">
                                                    <?php $j=0; foreach ($dt_aduan as $item) : $j++;?>
                                                    dt_lokasi.push(['<?php echo $item['nama'];?>','<?php echo $item['lt'];?>','<?php echo $item['lg'];?>','0','<?php echo $item['deskripsi']?>','<?php echo $item['id_aduan']?>','aduan']);
                                                    <?php endforeach; ?>
                                                </script>
                                                <?php $i=0; foreach ($dt_jenis_lokasi as $val): $i++;?>
                                                    <li>
                                                        <div class="collapsible-header">
                                                            <i class="material-icons"><?php echo $dt_jenis_lokasi[$i]['icon_materialize']; ?></i><?php echo $dt_jenis_lokasi[$i]['jenis_lokasi']; ?>
                                                            <span class="new badge purple darken-1"><?php echo $dt_jenis_lokasi[$i]['jml']; ?></span>
                                                        </div>
                                                        <div class="collapsible-body purple lighten-5">
                                                            <input type="checkbox" class="checkbox" id="<?php echo "btn_map_lokasi".$i;?>" onclick="setMapLokasi(this,'<?php echo $i;?>')"><label for="<?php echo "btn_map_lokasi".$i;?>"><?php echo $dt_jenis_lokasi[$i]['jenis_lokasi']; ?></label>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
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

    <script type="text/javascript">
        var stt_boolan_show_menu=false;
        var map;
        var all_marker=[];
        $(document).ready(function(){
            $('.tap-target').tapTarget('open');
            $('.modal').modal();
            $(".button-collapse").sideNav();
            $('.tooltipped').tooltip({delay: 50});
            $('.dropdown-button').dropdown({
                inDuration: 300,
                outDuration: 225,
                hover: true, // Activate on hover
                belowOrigin: true, // Displays dropdown below the button
                alignment: 'right' // Displays dropdown with edge aligned to the left of button
            });
        });
        $("#search").keyup(function () {
            $('#load-progress-sidenav').show();
            var cari= $("#search").val();
            var idLokasi=[];
            var nmLokasi=[];
            var ltLokasi=[];
            var lgLokasi=[];
            var imgLokasi=[];
            $.ajax({
                type: "POST",
                data: {cari: cari},
                url: "<?php echo base_url('Superadmin/cari_lokasi_tempat_umum'); ?>",
                dataType: "json",
                success: function (data) {
                    $('#load-progress-sidenav').hide();
                    var dataLokasi = {};
                    for (var i = 0; i < data.length; i++) {
                        dataLokasi[data[i].nama_lokasi] = "<?php echo base_url('assets/document/img/lokasi_tempat_umum_gallery')?>/"+data[i].img_lokasi;
                        idLokasi[i] = data[i].id_lokasi;
                        nmLokasi[i] = data[i].nama_lokasi;
                        ltLokasi[i] = data[i].lt;
                        lgLokasi[i] = data[i].lg;
                        imgLokasi[i] = data[i].img_lokasi;
                    }
                    $('input.autocomplete').autocomplete({
                        data: dataLokasi,
                        onAutocomplete: function(txt) {
                            for (var i = 0; i < nmLokasi.length; i++) {
                                if (nmLokasi[i] == txt) {
                                    var lat_lng = new google.maps.LatLng(ltLokasi[i],lgLokasi[i]);
                                    var marker = new google.maps.Marker({
                                        position: lat_lng,
                                        map: map,
                                        title:txt
                                    });
                                    all_marker.push(marker);
                                    var contentString = '<div id="content">'+
                                        '<p id="firstHeading"><h5><b>'+txt+'</b></h5></p>'+
                                        '<div class="col s12 m12 l12">'+
                                        '<img src="<?php echo base_url('assets/document/img/lokasi_tempat_umum_gallery');?>/'+imgLokasi[i]+'" class="responsive" style="width:150px;">'+
                                        '<button class="btn lime darken-4 waves-effect waves-light right col s12 m12 l12" onclick="openSideNav('+idLokasi[i]+',\'lokasi\')" type="button">Detail</button>'
                                    '</div>'
                                    '</div>';
                                    var infowindow = new google.maps.InfoWindow({
                                        content: contentString
                                    });
                                    marker.addListener('click', function() {
                                        infowindow.open(map, marker);
                                    });
                                }
                            }
                        },
                        limit: 15, // The max amount of results that can be shown at once. Default: Infinity.
                    });
                },
                error:function(data){
                    setTimeout(function() {
                        Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                    }, 100);
                    $('#load-progress-sidenav').hide();
                }
            });
        });
    </script>
    <?php $this->load->view('style/js'); ?>
    <script type="text/javascript">
        var autocomplete;
        function showMenu() {
            if (stt_boolan_show_menu==false) {
                $('#containerMenu').show(1000);
                stt_boolan_show_menu=true;
            } else {
                $('#containerMenu').hide(1000);
                stt_boolan_show_menu=false;
            }
        }

        function setMapLokasi(str,id) {
            if ($(str).prop('checked')){
                setMapMarker('true',dt_lokasi,id);
            } else {
                setMapMarker('false',dt_lokasi,id);
            }
        }

        function clearMarker() {
            for (var i = 0; i < all_marker.length; i++) {
                all_marker[i].setMap(null);
            }
            all_marker=[];
            $(".checkbox").prop('checked',false);
        }

        function setMapMarker(str,_marker,id) {
            for (var i = 0; i < _marker.length; i++) {
                var _m_ki = _marker[i];
                var lat_lng = new google.maps.LatLng(_m_ki[1],_m_ki[2]);
                if (str=='true') {
                    if (_m_ki[3]==id){
                        addMarker(_m_ki[0],lat_lng,_m_ki[3],_m_ki[4],_m_ki[5],_m_ki[6]);
                    }
                } else {
                    delMarker(id);
                }
            }
        }

        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
//                    var geolocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
//                    autocomplete.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
                    var ne = new google.maps.LatLng(-6.872160200000001,109.1408528);
                    var se = new google.maps.LatLng(-6.872861899999999,109.1363404);
                    autocomplete.setBounds(new google.maps.LatLngBounds(ne, se));
                    autocomplete.bindTo("bounds", map);
                });
            }
        }

        function fillInAddress() {
            var place = autocomplete.getPlace();
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        function addMarker(title,location,idJns_Lokasi,img,idLokasi,jns) {
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title:title,
                id: idJns_Lokasi
            });
            all_marker.push(marker);
            if (jns=="lokasi"){
                var contentString = '<div id="content">'+
                    '<p id="firstHeading"><b>'+title+'</b></p>'+
                    '<div class="col s12 m12 l12">'+
                    '<div style="display: block;width: 150px;position: relative;height: 0;padding: 56.25% 0 0 0;overflow: hidden;"><img src="<?php echo base_url('assets/document/img/lokasi_tempat_umum_gallery');?>/'+img+'" class="responsive" style="width:150px;position: absolute;display: block;margin: auto;left: 0;right: 0;top: 0;bottom: 0;"></div>'+
                    '<button class="btn grey darken-3 waves-effect waves-light right col s12 m12 l12" onclick="openSideNav(\''+idLokasi+'\',\''+jns+'\')" type="button">Detail</button></div></div>';
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            } else {
                var contentString = '<div id="content">'+
                    '<p><b>'+title+'</b></p><p>'+img+'</p>'+
                    '<div class="col s12 m12 l12">'+
                    '<button class="btn grey darken-3 waves-effect waves-light right col s12 m12 l12" onclick="redirectOpen(\''+idLokasi+'\')" type="button">Detail</button></div></div>';
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            }

        }

        function redirectOpen(str) {
            window.open("<?php echo base_url('Superadmin/detail_post')."/"?>"+str);
        }

        function delMarker(id) {
            for (var i = 0; i < all_marker.length; i++) {
                if (all_marker[i].id == id) {
                    all_marker[i].setMap(null);
                }
            }
        }

        function initMap() {
            var uluru = {lat: -6.872020764416118, lng: 109.11872149999999};
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
                center: uluru,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.LEFT_BOTTOM
                },
                gestureHandling: 'greedy',
                fullscreenControl: false,
                styles: style_map
            });

            autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'));
            autocomplete.bindTo("bounds", map);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                fillInAddress();
            });

            var wilayah_kotategal = [

                {
                    lat: -6.84749984741205,
                    lng: 109.152236938477
                },
                {
                    lat: -6.84863996505726,
                    lng: 109.152122497559
                },
                {
                    lat: -6.84936904907227,
                    lng: 109.152008056641
                },
                {
                    lat: -6.85067892074579,
                    lng: 109.151809692383
                },
                {
                    lat: -6.85340118408197,
                    lng: 109.151329040527
                },
                {
                    lat: -6.85630893707275,
                    lng: 109.150405883789
                },
                {
                    lat: -6.86114978790278,
                    lng: 109.149368286133
                },
                {
                    lat: -6.86566019058222,
                    lng: 109.149261474609
                },
                {
                    lat: -6.86996078491211,
                    lng: 109.148582458496
                },
                {
                    lat: -6.87205982208252,
                    lng: 109.148307800293
                },
                {
                    lat: -6.87383079528809,
                    lng: 109.147537231445
                },
                {
                    lat: -6.87608003616333,
                    lng: 109.14720916748
                },
                {
                    lat: -6.87756919860834,
                    lng: 109.146713256836
                },
                {
                    lat: -6.87823915481567,
                    lng: 109.146392822266
                },
                {
                    lat: -6.8787989616394,
                    lng: 109.145797729492
                },
                {
                    lat: -6.87921905517578,
                    lng: 109.145156860352
                },
                {
                    lat: -6.87945985794062,
                    lng: 109.144546508789
                },
                {
                    lat: -6.87951993942255,
                    lng: 109.143867492676
                },
                {
                    lat: -6.87962913513184,
                    lng: 109.143348693848
                },
                {
                    lat: -6.88016891479492,
                    lng: 109.142906188965
                },
                {
                    lat: -6.88095998764038,
                    lng: 109.142807006836
                },
                {
                    lat: -6.88201999664301,
                    lng: 109.143119812012
                },
                {
                    lat: -6.8836989402771,
                    lng: 109.144065856934
                },
                {
                    lat: -6.88552093505859,
                    lng: 109.145050048828
                },
                {
                    lat: -6.88664913177485,
                    lng: 109.145156860352
                },
                {
                    lat: -6.88856077194214,
                    lng: 109.14501953125
                },
                {
                    lat: -6.89004898071289,
                    lng: 109.144508361816
                },
                {
                    lat: -6.89148998260498,
                    lng: 109.144256591797
                },
                {
                    lat: -6.89417886734003,
                    lng: 109.143798828125
                },
                {
                    lat: -6.89375019073481,
                    lng: 109.142967224121
                },
                {
                    lat: -6.89391899108887,
                    lng: 109.141532897949
                },
                {
                    lat: -6.89474010467529,
                    lng: 109.140083312988
                },
                {
                    lat: -6.8950400352478,
                    lng: 109.138870239258
                },
                {
                    lat: -6.89496088027948,
                    lng: 109.138038635254
                },
                {
                    lat: -6.89448022842402,
                    lng: 109.137001037598
                },
                {
                    lat: -6.89402914047241,
                    lng: 109.135238647461
                },
                {
                    lat: -6.89340877532959,
                    lng: 109.133598327637
                },
                {
                    lat: -6.89334011077875,
                    lng: 109.133087158203
                },
                {
                    lat: -6.89323997497559,
                    lng: 109.132347106934
                },
                {
                    lat: -6.89405822753906,
                    lng: 109.130867004395
                },
                {
                    lat: -6.89587879180903,
                    lng: 109.130447387695
                },
                {
                    lat: -6.89710998535156,
                    lng: 109.129936218262
                },
                {
                    lat: -6.89785099029535,
                    lng: 109.129508972168
                },
                {
                    lat: -6.89816999435425,
                    lng: 109.129318237305
                },
                {
                    lat: -6.89964914321899,
                    lng: 109.128166198731
                },
                {
                    lat: -6.90000915527344,
                    lng: 109.126388549805
                },
                {
                    lat: -6.90012979507446,
                    lng: 109.125389099121
                },
                {
                    lat: -6.90023899078363,
                    lng: 109.124328613281
                },
                {
                    lat: -6.90059900283813,
                    lng: 109.122673034668
                },
                {
                    lat: -6.90095901489258,
                    lng: 109.121955871582
                },
                {
                    lat: -6.90130996704102,
                    lng: 109.12126159668
                },
                {
                    lat: -6.90197992324829,
                    lng: 109.12068939209
                },
                {
                    lat: -6.90388822555542,
                    lng: 109.120040893555
                },
                {
                    lat: -6.90482902526855,
                    lng: 109.119316101074
                },
                {
                    lat: -6.90548992156982,
                    lng: 109.117919921875
                },
                {
                    lat: -6.90553998947138,
                    lng: 109.115966796875
                },
                {
                    lat: -6.90534877777094,
                    lng: 109.114776611328
                },
                {
                    lat: -6.90426921844482,
                    lng: 109.112976074219
                },
                {
                    lat: -6.90290117263788,
                    lng: 109.111526489258
                },
                {
                    lat: -6.90190076828003,
                    lng: 109.110359191895
                },
                {
                    lat: -6.90124893188477,
                    lng: 109.109573364258
                },
                {
                    lat: -6.9001088142395,
                    lng: 109.108001708984
                },
                {
                    lat: -6.89964008331299,
                    lng: 109.106163024902
                },
                {
                    lat: -6.89914083480835,
                    lng: 109.103538513184
                },
                {
                    lat: -6.89906978607172,
                    lng: 109.101249694824
                },
                {
                    lat: -6.89910888671875,
                    lng: 109.098968505859
                },
                {
                    lat: -6.8993182182312,
                    lng: 109.097427368164
                },
                {
                    lat: -6.89978981018061,
                    lng: 109.094833374024
                },
                {
                    lat: -6.90020990371693,
                    lng: 109.091667175293
                },
                {
                    lat: -6.90034914016718,
                    lng: 109.090118408203
                },
                {
                    lat: -6.90069007873535,
                    lng: 109.088119506836
                },
                {
                    lat: -6.90080881118774,
                    lng: 109.086486816406
                },
                {
                    lat: -6.90056085586542,
                    lng: 109.084053039551
                },
                {
                    lat: -6.90037822723383,
                    lng: 109.082000732422
                },
                {
                    lat: -6.90036010742188,
                    lng: 109.080558776856
                },
                {
                    lat: -6.90036010742188,
                    lng: 109.079956054688
                },
                {
                    lat: -6.90049886703491,
                    lng: 109.078086853027
                },
                {
                    lat: -6.90075016021729,
                    lng: 109.07666015625
                },
                {
                    lat: -6.90098905563349,
                    lng: 109.07544708252
                },
                {
                    lat: -6.9013791084289,
                    lng: 109.074188232422
                },
                {
                    lat: -6.90217018127436,
                    lng: 109.072067260742
                },
                {
                    lat: -6.90223979949951,
                    lng: 109.070152282715
                },
                {
                    lat: -6.90212917327869,
                    lng: 109.068458557129
                },
                {
                    lat: -6.90161991119385,
                    lng: 109.065742492676
                },
                {
                    lat: -6.90018892288208,
                    lng: 109.065483093262
                },
                {
                    lat: -6.89840888977051,
                    lng: 109.065299987793
                },
                {
                    lat: -6.8970890045166,
                    lng: 109.064781188965
                },
                {
                    lat: -6.89657020568842,
                    lng: 109.064720153809
                },
                {
                    lat: -6.89514112472534,
                    lng: 109.06453704834
                },
                {
                    lat: -6.89370012283325,
                    lng: 109.064651489258
                },
                {
                    lat: -6.89220094680786,
                    lng: 109.064987182617
                },
                {
                    lat: -6.8905301094054,
                    lng: 109.066078186035
                },
                {
                    lat: -6.889898777008,
                    lng: 109.067001342774
                },
                {
                    lat: -6.88983917236322,
                    lng: 109.068031311035
                },
                {
                    lat: -6.88978004455561,
                    lng: 109.069068908691
                },
                {
                    lat: -6.88971900939941,
                    lng: 109.070281982422
                },
                {
                    lat: -6.88908100128168,
                    lng: 109.071083068848
                },
                {
                    lat: -6.88828086853027,
                    lng: 109.07137298584
                },
                {
                    lat: -6.88741016387939,
                    lng: 109.071479797363
                },
                {
                    lat: -6.88671922683716,
                    lng: 109.071586608887
                },
                {
                    lat: -6.88619995117182,
                    lng: 109.071708679199
                },
                {
                    lat: -6.88550901412964,
                    lng: 109.071990966797
                },
                {
                    lat: -6.88395881652826,
                    lng: 109.073539733887
                },
                {
                    lat: -6.88204908370972,
                    lng: 109.07543182373
                },
                {
                    lat: -6.88015079498291,
                    lng: 109.076232910156
                },
                {
                    lat: -6.87876987457275,
                    lng: 109.076568603516
                },
                {
                    lat: -6.87756919860834,
                    lng: 109.076797485352
                },
                {
                    lat: -6.87652921676636,
                    lng: 109.076972961426
                },
                {
                    lat: -6.87531900405872,
                    lng: 109.077308654785
                },
                {
                    lat: -6.87485885620112,
                    lng: 109.077606201172
                },
                {
                    lat: -6.87416982650757,
                    lng: 109.078048706055
                },
                {
                    lat: -6.87335920333862,
                    lng: 109.078742980957
                },
                {
                    lat: -6.87244081497192,
                    lng: 109.079658508301
                },
                {
                    lat: -6.871169090271,
                    lng: 109.080627441406
                },
                {
                    lat: -6.86984920501709,
                    lng: 109.08130645752
                },
                {
                    lat: -6.86823987960815,
                    lng: 109.081771850586
                },
                {
                    lat: -6.866858959198,
                    lng: 109.08171081543
                },
                {
                    lat: -6.86547994613647,
                    lng: 109.081703186035
                },
                {
                    lat: -6.86420822143555,
                    lng: 109.081703186035
                },
                {
                    lat: -6.86285018920893,
                    lng: 109.081878662109
                },
                {
                    lat: -6.86253976821888,
                    lng: 109.081916809082
                },
                {
                    lat: -6.86092901229858,
                    lng: 109.082443237305
                },
                {
                    lat: -6.85965919494623,
                    lng: 109.0849609375
                },
                {
                    lat: -6.85988903045654,
                    lng: 109.086112976074
                },
                {
                    lat: -6.86016988754272,
                    lng: 109.087036132813
                },
                {
                    lat: -6.86091995239252,
                    lng: 109.088356018067
                },
                {
                    lat: -6.86177921295166,
                    lng: 109.089752197266
                },
                {
                    lat: -6.8621301651001,
                    lng: 109.090377807617
                },
                {
                    lat: -6.86275005340576,
                    lng: 109.09147644043
                },
                {
                    lat: -6.86331892013544,
                    lng: 109.092796325684
                },
                {
                    lat: -6.86388921737671,
                    lng: 109.094482421875
                },
                {
                    lat: -6.86429023742676,
                    lng: 109.095687866211
                },
                {
                    lat: -6.86431121826172,
                    lng: 109.096122741699
                },
                {
                    lat: -6.86434984207153,
                    lng: 109.096786499023
                },
                {
                    lat: -6.86376810073847,
                    lng: 109.097991943359
                },
                {
                    lat: -6.86319017410278,
                    lng: 109.098526000977
                },
                {
                    lat: -6.86279106140131,
                    lng: 109.098907470703
                },
                {
                    lat: -6.85991001129145,
                    lng: 109.099937438965
                },
                {
                    lat: -6.85715007781982,
                    lng: 109.100326538086
                },
                {
                    lat: -6.85551977157587,
                    lng: 109.100440979004
                },
                {
                    lat: -6.85403919219971,
                    lng: 109.100547790527
                },
                {
                    lat: -6.85270977020258,
                    lng: 109.100486755371
                },
                {
                    lat: -6.85225915908813,
                    lng: 109.100479125977
                },
                {
                    lat: -6.85059022903442,
                    lng: 109.1005859375
                },
                {
                    lat: -6.84886980056763,
                    lng: 109.100639343262
                },
                {
                    lat: -6.84466886520386,
                    lng: 109.101028442383
                },
                {
                    lat: -6.84335899353016,
                    lng: 109.10099029541
                },
                {
                    lat: -6.84201002120972,
                    lng: 109.101051330566
                },
                {
                    lat: -6.83968019485468,
                    lng: 109.101119995117
                },
                {
                    lat: -6.8388991355896,
                    lng: 109.100959777832
                },
                {
                    lat: -6.83861112594599,
                    lng: 109.100830078125
                },
                {
                    lat: -6.83916997909546,
                    lng: 109.101387023926
                },
                {
                    lat: -6.83916711807245,
                    lng: 109.101669311523
                },
                {
                    lat: -6.83930587768543,
                    lng: 109.101943969727
                },
                {
                    lat: -6.83923578262323,
                    lng: 109.102989196777
                },
                {
                    lat: -6.83916521072388,
                    lng: 109.103469848633
                },
                {
                    lat: -6.83944320678711,
                    lng: 109.103614807129
                },
                {
                    lat: -6.8395800590514,
                    lng: 109.104095458984
                },
                {
                    lat: -6.83999919891357,
                    lng: 109.104721069336
                },
                {
                    lat: -6.84014987945557,
                    lng: 109.105209350586
                },
                {
                    lat: -6.84032487869263,
                    lng: 109.105735778809
                },
                {
                    lat: -6.84056520462036,
                    lng: 109.106269836426
                },
                {
                    lat: -6.84083318710321,
                    lng: 109.106941223145
                },
                {
                    lat: -6.84111213684082,
                    lng: 109.107223510742
                },
                {
                    lat: -6.84110879898071,
                    lng: 109.108062744141
                },
                {
                    lat: -6.84139013290405,
                    lng: 109.108329772949
                },
                {
                    lat: -6.84166812896729,
                    lng: 109.109169006348
                },
                {
                    lat: -6.84166812896729,
                    lng: 109.109443664551
                },
                {
                    lat: -6.84194278717041,
                    lng: 109.109725952149
                },
                {
                    lat: -6.84193897247314,
                    lng: 109.110282897949
                },
                {
                    lat: -6.84221887588495,
                    lng: 109.110557556152
                },
                {
                    lat: -6.84221887588495,
                    lng: 109.110832214356
                },
                {
                    lat: -6.84250020980835,
                    lng: 109.111106872559
                },
                {
                    lat: -6.84278011322016,
                    lng: 109.111808776856
                },
                {
                    lat: -6.84305620193481,
                    lng: 109.112503051758
                },
                {
                    lat: -6.84389019012451,
                    lng: 109.113334655762
                },
                {
                    lat: -6.84402704238886,
                    lng: 109.114028930664
                },
                {
                    lat: -6.84416818618774,
                    lng: 109.114723205566
                },
                {
                    lat: -6.84444379806507,
                    lng: 109.115280151367
                },
                {
                    lat: -6.84499979019165,
                    lng: 109.116386413574
                },
                {
                    lat: -6.84499979019165,
                    lng: 109.116668701172
                },
                {
                    lat: -6.84527778625488,
                    lng: 109.116943359375
                },
                {
                    lat: -6.84527778625488,
                    lng: 109.117225646973
                },
                {
                    lat: -6.84555578231812,
                    lng: 109.117500305176
                },
                {
                    lat: -6.84555578231812,
                    lng: 109.117774963379
                },
                {
                    lat: -6.84583377838135,
                    lng: 109.118057250977
                },
                {
                    lat: -6.84582901000977,
                    lng: 109.118606567383
                },
                {
                    lat: -6.84610986709589,
                    lng: 109.118888854981
                },
                {
                    lat: -6.84610986709589,
                    lng: 109.119125366211
                },
                {
                    lat: -6.84638500213623,
                    lng: 109.11971282959
                },
                {
                    lat: -6.84667682647705,
                    lng: 109.120277404785
                },
                {
                    lat: -6.84666585922236,
                    lng: 109.120552062988
                },
                {
                    lat: -6.84722185134882,
                    lng: 109.121109008789
                },
                {
                    lat: -6.84721994400024,
                    lng: 109.12166595459
                },
                {
                    lat: -6.84749984741205,
                    lng: 109.121948242188
                },
                {
                    lat: -6.84749984741205,
                    lng: 109.123611450195
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.123886108398
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.124305725098
                },
                {
                    lat: -6.84791707992548,
                    lng: 109.124725341797
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.125274658203
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.125556945801
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.125831604004
                },
                {
                    lat: -6.84833383560181,
                    lng: 109.126113891602
                },
                {
                    lat: -6.84833002090443,
                    lng: 109.126953125
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.127220153809
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.128608703613
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.128890991211
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.129173278809
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.129447937012
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.129722595215
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.129997253418
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.131385803223
                },
                {
                    lat: -6.84888982772827,
                    lng: 109.13166809082
                },
                {
                    lat: -6.84888982772827,
                    lng: 109.132499694824
                },
                {
                    lat: -6.8487491607666,
                    lng: 109.132766723633
                },
                {
                    lat: -6.8487491607666,
                    lng: 109.133186340332
                },
                {
                    lat: -6.84860992431641,
                    lng: 109.133605957031
                },
                {
                    lat: -6.84860086441034,
                    lng: 109.134216308594
                },
                {
                    lat: -6.84861183166504,
                    lng: 109.134910583496
                },
                {
                    lat: -6.84854221343994,
                    lng: 109.135559082031
                },
                {
                    lat: -6.84824800491327,
                    lng: 109.136047363281
                },
                {
                    lat: -6.84786891937256,
                    lng: 109.13648223877
                },
                {
                    lat: -6.84749794006348,
                    lng: 109.136978149414
                },
                {
                    lat: -6.84713983535767,
                    lng: 109.137466430664
                },
                {
                    lat: -6.84680891036982,
                    lng: 109.13794708252
                },
                {
                    lat: -6.84670877456654,
                    lng: 109.138397216797
                },
                {
                    lat: -6.84684991836548,
                    lng: 109.138786315918
                },
                {
                    lat: -6.84704923629761,
                    lng: 109.139183044434
                },
                {
                    lat: -6.84724187850946,
                    lng: 109.13956451416
                },
                {
                    lat: -6.8474588394165,
                    lng: 109.139938354492
                },
                {
                    lat: -6.84755516052235,
                    lng: 109.140380859375
                },
                {
                    lat: -6.84770107269287,
                    lng: 109.140808105469
                },
                {
                    lat: -6.84749984741205,
                    lng: 109.14111328125
                },
                {
                    lat: -6.84749984741205,
                    lng: 109.142219543457
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.142501831055
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.143333435059
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.143608093262
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.14444732666
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.144721984863
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.144996643067
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.145278930664
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.148056030274
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.148330688477
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.148612976074
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.148887634277
                },
                {
                    lat: -6.84805583953846,
                    lng: 109.149719238281
                },
                {
                    lat: -6.84777784347528,
                    lng: 109.150001525879
                },
                {
                    lat: -6.8477258682251,
                    lng: 109.151390075684
                },
                {
                    lat: -6.84749984741205,
                    lng: 109.151657104492
                },
                {
                    lat: -6.84749984741205,
                    lng: 109.152236938477
                }
            ];

            var poly_kota_tegal=[];
            for (var i=0; i<wilayah_kotategal.length; i++) {
                poly_kota_tegal[i] = {lat: wilayah_kotategal[i].lat,lng: wilayah_kotategal[i].lng};
            }

            var flightPath = new google.maps.Polyline({
                path: poly_kota_tegal,
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

        function openSideNav(str,jns) {
            var geocoder = new google.maps.Geocoder;
            $('#load-progress-sidenav').show();
            $('.button-collapse').sideNav('show');
            $.ajax({
                type: "GET",data:{id:str},url: "<?php echo base_url('Superadmin/detail_lokasi_tempat_umum'); ?>",
                dataType: "JSON",
                success: function(data){
                    var src_bg,nama_peta,deskripsi_peta,lati_peta,longi_peta;
                    var	gal = '';
                    $('#load-progress-sidenav').hide();
                    if (jns=="lokasi"){
                        nama_peta=data.detail.nama_lokasi;
                        deskripsi_peta=data.detail.deskripsi_lokasi;
                        lati_peta=data.detail.lati;
                        longi_peta=data.detail.longi;
                        src_bg = data.gallery[0].img_gallery_lokasi_tempat_umum;
                        if (src_bg==null||src_bg=="") {
                            src_bg = "<?php echo base_url('assets/document/style/img/bg_slide_2.jpg')?>";
                        } else {
                            src_bg = "<?php echo base_url('assets/document/img/lokasi_tempat_umum_gallery')?>/"+src_bg;
                        }

                        if(data.gallery == 0){
                            gal = '<a href="javascript:avoid" onclick="addPhotoGallery('+str+')" class="waves-effect waves-light"><i class="material-icons blue-text">add_a_photo</i></a>';
                        } else {
                            $.each( data.gallery, function( key, value ) {
                                gal = gal + '<div class="col s6 m6 l6"><div style="display: block;width: 100%;position: relative;height: 0;padding: 56.25% 0 0 0;overflow: hidden;">';
                                gal = gal + '<img class="activator" src="<?php echo base_url('assets/document/img/lokasi_tempat_umum_gallery')?>/'+value.img_gallery_lokasi_tempat_umum+'" style="width:100%;height:auto;position: absolute;display: block;margin: auto;left: 0;right: 0;top: 0;bottom: 0;">';
                                gal = gal + '</div></div>';
                            });
                            gal = gal+'<a href="javascript:avoid" onclick="addPhotoGallery('+str+')" class="waves-effect waves-light"><i class="material-icons blue-text">add_a_photo</i></a>';
                        }
                        var html_icon_edit = '<a href="javascript:avoid" onclick="editLokasi('+str+')" class="waves-effect waves-light right"><i class="material-icons white-text">edit</i></a>';
                        $("#iconEditLokasi").html(html_icon_edit);
                    }

                    $("#sideNav_nm_tmpt").text(nama_peta);
                    $("#sideNav_dsk_tmpt").text(deskripsi_peta);
                    $("#sideNav_gallery").html(gal);
                    $('.materialboxed').materialbox();
                    var latlng = {lat: parseFloat(lati_peta), lng: parseFloat(longi_peta)};
                    geocoder.geocode({'location': latlng}, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                $("#sideNav_lks_tmpt").text(results[0].formatted_address);
                            } else {
                                $("#sideNav_lks_tmpt").text("Lokasi tidak terdeteksi");
                            }
                        }
                    });
                    $("#sideNav_background").attr("src", src_bg);
                    $('#sideNav_background').css({'filter':'blur(.5px)','box-shadow':'80px 80px 80px #aaa;'});
                    $('#sideNav_background2').css({'background-image':'url("' + src_bg + '")','filter':'blur(2px)'});
                },
                error:function(data){
                    setTimeout(function() {
                        Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                    }, 100);
                    $('#load-progress-sidenav').hide();
                }
            });
            //$(".drag-target").unbind('click');
            //$("#sidenav-overlay").unbind('click');
        }

        function closeSideNav() {
            $('.button-collapse').sideNav('hide');
            $("#sideNav_nm_tmpt").text('');
            $("#sideNav_dsk_tmpt").text('');
            $("#sideNav_lks_tmpt").text('');
        }

        function addPhotoGallery(str) {
            modal_detail('tambah_foto_lokasi',str);
        }

        function editLokasi(str) {
            modal_detail('edit_lokasi',str);
        }

        function modal_detail(str,str2) {
            $('#load-progress-sidenav').show();
            $.ajax(
                {
                    type: "GET",
                    data:{type:str,id:str2},
                    url: "<?php echo base_url('Superadmin/modal'); ?>",
                    success: function(data)
                    {
                        $('#load-progress-sidenav').hide();
                        $('#modal_dialog').html(data);
                        $('#modal_dialog').modal('open');
                    },
                    error:function(data){
                        $('#load-progress-sidenav').hide();
                        setTimeout(function() {
                            Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                        }, 100);
                    }
                });
        }

        function enableClick(){
            setTimeout(function() {
                Materialize.toast('<span>Klik pada peta telah diaktifkan. Silahkan memilih lokasi.</span>', 10000);
            }, 100);
            google.maps.event.addListener(map, 'click', function(event){
                modal('tambah_lokasi',event.latLng.lat(),event.latLng.lng());
            });
            $("#div_add_location").hide();
            $("#div_close_location").show();
            $('#div_add_location').closeFAB();
            $(".content_body_maps").hide('1000');
            $("#search_lokasi_tempat_umum").hide('1000');
            $(".slide-out").hide('1000');
            $(".container_search_map").css({"padding":"10","background-color":"#2196F3"});
        }

        function disableClick(){
            setTimeout(function() {
                Materialize.toast('<span>Klik pada peta dimatikan.</span>', 3000);
            }, 100);
            google.maps.event.clearListeners(map, 'click');
            $("#div_add_location").show();
            $("#div_close_location").hide();
            $(".content_body_maps").show('1000');
            $("#search_lokasi_tempat_umum").show('1000');
            $(".slide-out").show('1000');
            $(".container_search_map").css({"padding":"0","background-color":"#9e9e9e"});
        }

        function modal(str,str2,str3) {
            $('#load-progress-pesan').show();
            $.ajax(
                {
                    type: "GET",
                    data:{type:str,lati:str2,longi:str3},
                    url: "<?php echo base_url('Superadmin/modal'); ?>",
                    success: function(data)
                    {
                        $('#load-progress-pesan').hide();
                        $('#modal_dialog').html(data);
                        $('#modal_dialog').modal('open');
                    },
                    error:function(data){
                        $('#load-progress-pesan').hide();
                        setTimeout(function() {
                            Materialize.toast('<span>Terjadi Kesalahan. Silahkan coba lagi.</span>', 3000);
                        }, 100);
                    }
                });
        }
    </script>
    </body>
    </html>
<?php endif;?>
