<?php $this->layout('layout', ['title' => 'Compte Pro']) ?>
<?php $this->start('main_content') ?>
<div id="profileAdmin">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-3 panel-admin">
                <h3 class="text-center">Bonjour <?= $user['username']; ?></h3 >
                <div class="list-group">
                    <ul class="list-unstyled" id="admin">
                        <li>
                            <a href="<?= $this->url('panel_profile_profilePro'); ?> " class="list-group-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>...</a>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="list-group">
                    <a href="<?= $this->url('security_logout'); ?>" class="list-group-item">Deconnexion</a>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Mes Catégories</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categorie as $catego) : ?><!--ici on a recuperer $articles grace a $this->show('article/index' , ['articles' => $articles]); -->
                    <tr>
                        <td><?php echo $catego['Title'];    ?></td>
                        <td><?php echo $catego['Description'];?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h2>Mes Commentaires </h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id Commentateur</th>
                        <th>Note</th>
                        <th>Commentaires</th>
                        <th>Date du commentaires</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($comments as $comment) : ?><!--ici on a recuperer $articles grace a $this->show('article/index' , ['articles' => $articles]); -->
                    <tr>
                        <td><?php echo $comment['IdComm'];    ?></td>
                        <td><?php echo $comment['Note'];    ?></td>
                        <td><?php echo $comment['Commentaires'];?></td>
                        <td><?php echo $comment['dateComment'];?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>  <!-- .row -->
    </div> <!-- .container-fluid -->
</div>  <!-- #profileAdmin -->
<?php $this->stop('main_content'); ?>
