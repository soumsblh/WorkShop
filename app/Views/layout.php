<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<!-- CSS FILES  -->
	<link rel="stylesheet" href="<?= $this->assetUrl('bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('bootstrap/css/bootstrap.css.map') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/form.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/business-casual.css') ?>">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">

	<!-- FAVICON -->
	<link rel="icon" type="img/png" href="<?= $this->assetUrl('img/bg.jpg') ?>" />

</head>
<body>
<h1 class="site-heading text-center text-white d-none d-lg-block">
    <span class="site-heading-upper text-primary mb-3">Bienvenue sur Green'Tech une application qui vous connecte à l'eco responsabilité</span>
    <span class="site-heading-lower">Green'Tech</span>
</h1>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Green tech</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item <?php if($w_current_route == 'default_home'):?>active<?php endif; ?> px-lg-4">
                    <a class="nav-link text-uppercase text-expanded"  href="<?php echo $this->url('default_home'); ?>">Accueil
                    </a>
                </li>
                <li class="nav-item <?php if($w_current_route == 'default_apropos'):?>active<?php endif; ?> px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="<?php echo $this->url('default_apropos'); ?>">à propos</a>
                </li>
                <li class="nav-item <?php if($w_current_route == 'default_adherents'):?>active<?php endif; ?> px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="<?php echo $this->url('default_adherents'); ?>">Nos adhérents</a>
                </li>
                <li class="nav-item <?php if($w_current_route == 'default_contact'):?>active<?php endif; ?> px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="<?php echo $this->url('default_contact'); ?>">Nous Contacter</a>
                </li>
                <?php if($w_user['role'] != 'pros' && $w_user['role'] != 'admin' ) : ?>
                <li class="nav-item <?php if($w_current_route == 'security_registre'):?>active<?php endif; ?> px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="<?php echo $this->url('security_register'); ?>">Inscription Pro</a>
                </li>
                <li class="nav-item <?php if($w_current_route == 'security_login'):?>active<?php endif; ?> px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="<?php echo $this->url('security_login'); ?>">Connexion Pro</a>
                </li>
                <?php elseif($w_user['role'] === 'admin' || $w_user['role'] === 'pros' ): ?>
                    <li class="nav-item <?php if($w_current_route == 'security_login'):?>active<?php endif; ?> px-lg-4">
                        <a class="nav-link text-uppercase text-expanded"  href="<?php echo $this->url('panel_profile_profilePro'); ?>" title="Afficher mon profil"><i class="fa fa-user-secret fa-2x"></i>Mon compte </a>
                    </li>
                <?php  endif; ?> <!-- $w_user['role'] -->
            </ul>
        </div>
    </div>
</nav>
<section>
    <?= $this->section('main_content') ?>
</section>
<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">Copyright &copy; Green'Tech 2018</p>
    </div>
</footer>
<?= $this->section('javascript') ?>
<script src="<?= $this->assetUrl('jquery/jquery.slim.js') ?>" charset="utf-8"></script>
<script src="<?= $this->assetUrl('bootstrap/js/bootstrap.bundle.js') ?>" charset="utf-8"></script>
<script src="<?= $this->assetUrl('bootstrap/js/bootstrap.js') ?>" charset="utf-8"></script>
<?php if ($w_current_route == 'default_home'): ?>
    <script src="<?= $this->assetUrl('js/googleMap.js') ?>" charset="utf-8"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4ox_EnhWi5VVVA62vdp5TqLTxMIx9Yts&callback=initMap" type="text/javascript"></script>
<?php endif; ?><!-- $w_current_route != 'default_home' -->
<?= $this->section('script') ?>
</body>
</html>
