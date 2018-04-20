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
	<link rel="stylesheet" href="<?= $this->assetUrl('css/business-casual.css') ?>">
    <link rel="stylesheet" href="<?= $this->assetUrl('fonts/font-awesome.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/loader.css') ?>">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= $this->assetUrl('vendor/bootstrap/css/bootstrap.min.css')?>">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">

	<!-- FAVICON -->
	<link rel="icon" type="img/png" href="<?= $this->assetUrl('img/fav.png') ?>" />

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
                <li class="nav-item active px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" <?php echo $this->url('default_frontPage'); ?>>Accueil
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" <?php echo $this->url('default_apropos'); ?>>à propos</a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" <?php echo $this->url('default_apropos'); ?>>Nos Produits</a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" <?php echo $this->url('security_register'); ?>>S'inscrire</a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" <?php echo $this->url('default_contact'); ?>>Nous Contacter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="page-section clearfix">
    <div class="container">
        <div class="intro">
            <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="<?= $this->assetUrl('img/intro.jpg') ?>" alt="">
            <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                <h2 class="section-heading mb-4">
                    <span class="section-heading-upper">Fresh Coffee</span>
                    <span class="section-heading-lower">Worth Drinking</span>
                </h2>
                <p class="mb-3">Every cup of our quality artisan coffee starts with locally sourced, hand picked ingredients. Once you try it, our coffee will be a blissful addition to your everyday morning routine - we guarantee it!
                </p>
                <div class="intro-button mx-auto">
                    <a class="btn btn-primary btn-xl" href="#">Visit Us Today!</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Our Promise</span>
                        <span class="section-heading-lower">To You</span>
                    </h2>
                    <p class="mb-0">When you walk into our shop to start your day, we are dedicated to providing you with friendly service, a welcoming atmosphere, and above all else, excellent products made with the highest quality ingredients. If you are not satisfied, please let us know and we will do whatever we can to make things right!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">Copyright &copy; Green'Tech 2018</p>
    </div>
</footer>
<?= $this->section('javascript') ?> <!--AIzaSyDw-gYmqJqQ-8RYU_8LZoTNFyQ51_yWYCY--> <!--AIzaSyDw-gYmqJqQ-8RYU_8LZoTNFyQ51_yWYCY  //  clef: mohammed si l'autre fonctionne pas:  AIzaSyCBLynodCrw0lB99t1SANF8PbXwANKcBK4 -->
<script src="<?= $this->assetUrl('vendor/jquery/jquery.min.js') ?>" charset="utf-8"></script>
<script src="<?= $this->assetUrl('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>" charset="utf-8"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw-gYmqJqQ-8RYU_8LZoTNFyQ51_yWYCY&callback=initMap" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDw-gYmqJqQ-8RYU_8LZoTNFyQ51_yWYCY" type="text/javascript"></script>
<?= $this->section('script') ?>

</body>
</html>
