<?php $this->layout('layout', ['title' => 'Nos adhérents']) ?>
<?php $this->start('main_content'); ?>
<div class="container">
    <!-- Page Heading -->
    <h1 class="text-center">Toutes Nos Adherents</h1>
    <div class="card-columns">
<?php foreach( $allPros as $count => $pros) : ?>
    <div class="card" style="max-width: 19rem;">
        <img class="card-img-top" src="<?= $pros['image']; ?>" style="max-width: 19rem; width: 100%;height: 100%;" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><a href="<?= $this->url('panel_profile_profileadherent', ['id' => $pros['id'] ] )?>"><?= $pros['RaisonSocial']; ?></a></h5>
            <p class="card-text"><?= $pros['Description']; ?></p>
        </div>
    </div>
<?php endforeach; ?>
    </div>
</div>
<?php $this->stop('main_content'); ?>