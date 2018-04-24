<?php $this->layout('layout', ['title' => 'Nos adhérents']) ?>

<?php $this->start('main_content') ?>
<div class="container">
    <div class="row" id="lastevent">
        <div class="col-md-12 center-block">
            <h2 class="text-center">Les derniers événements postés :</h2>
            <div class="container" style="border-top:2px solid #036e7f;">
                <?php foreach ($lastevent as $value) :?>
                    <div class="col-md-4 col-sm-6">
                        <br/>
                        <div class="well">
                            <div class="center">
                                <img src="<?= $value['image']; ?>" alt="Event img">
                            </div>
                            <h3>
                                <a href="<?= $this->url('event_view', ['id' => $value['id_event'] ] );?>" title=""><?= $value['title']; ?></a>
                            </h3>
                            <table class="table table-bordered table-condensed">
                                <tbody>
                                <tr>
                                    <td class="strong">Départ</td>
                                    <td><i class="icon-road"></i> <b><?= $value['depart']; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="strong">Arrivée</td>
                                    <td><i class="icon-road"></i> <b><?= $value['arrivee']; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="strong">Distance</td>
                                    <td><i class="icon-road"></i><b><?= $value['distance']; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="strong">Temps</td>
                                    <td><i class="icon-road"></i> <b><?= $value['temps_dist']; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="strong">Créé par</td>
                                    <td>
                                        <?= $value['username']; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!--well-->
                    </div>
                <?php endforeach; ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
</div><!-- /# -->
<?php $this->stop('main_content') ?>