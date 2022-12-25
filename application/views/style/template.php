<!DOCTYPE html>
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
            <?php echo $navbar_web; ?>
        </div>
        <div class="progress display_none" id="load-progress-navbar" style="position: absolute;top: 90%">
            <div class="indeterminate white" id="progressBar"></div>
        </div>
    </nav>
</div>
<?php echo $navbar_mobile; ?>

<main>
    <div id="main">
        <div class="wrapper">
            <section id="content">
                <?php echo $content; ?>
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
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.dropdown-button').dropdown({
            inDuration: 300,
            outDuration: 225,
            hover: true, // Activate on hover
            belowOrigin: true, // Displays dropdown below the button
            alignment: 'right' // Displays dropdown with edge aligned to the left of button
        });
    });
</script>
</body>
</html>
