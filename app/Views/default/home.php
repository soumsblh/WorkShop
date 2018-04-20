<?php $this->layout('layout', ['title' => 'home']) ?>
<?php $this->start('main_content') ?>
<section class="page-section clearfix">
    <div class="container">
        <div class="intro">
            <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="<?= $this->assetUrl('img/intro.jpg') ?>" alt="">
            <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                <h2 class="section-heading mb-4">
                    <span class="section-heading-upper">Eco Responsabilité</span>
                    <span class="section-heading-lower">Green'Tech</span>
                </h2>
                <p class="mb-3">
                    Green'Tech est une application web qui vous connecte à l'éco-responsabilité
                    <br />
                    -
                    <br />
                    Ne restez pas spectateur, mais devenez acteur de la consommation responsable
                </p>
                <div class="intro-button mx-auto">
                    <a class="btn btn-primary btn-xl" href=""<?php echo $this->url('default_apropos'); ?>">En savoir plus!</a>
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
                        <span class="section-heading-upper">Les pros </span>
                        <span class="section-heading-lower">Prés de chez-vous </span>
                    </h2>
                    <div id="map" style="width:100%;height:300px"></div>
                    <div id="Company"></div>
                </div>
            </div>
        </div>
    </div>
</section>

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false"></script>
<?php $this->stop('main_content'); ?>