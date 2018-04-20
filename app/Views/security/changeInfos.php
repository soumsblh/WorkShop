<?php $this->layout('layout', ['title' => 'Changer mes informations']) ?>

<?php $this->start('main_content') ?>
  <div id="changeInfos">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group profile_panel">
            <a href="<?= $this->url('default_profile'); ?>" class="list-group-item">Mes événements</a>
            <a href="<?= $this->url('security_changeInfos'); ?>" class="list-group-item">Changer mes informations</a>
            <a href="<?= $this->url('security_logout'); ?>" class="list-group-item">Déconnexion</a>
          </div>
        </div>

      <div class="col-md-3 col-md-push-1">
        <h3 class="text-center">Changer mon adresse email</h3>
        <div class="form-group">
          <label for="">Adresse email actuelle :</label>
          <input class="form-control" type="text" value="<?= $profil['email']; ?>" disabled="">
        </div>
        <form class="" action="" method="post">
          <div class="form-group <?= (isset($message['lastname'])) ? 'has-error' : ''?>">
            <label for="email">Nouvelle adresse email :</label>
            <input id="email" name="email" type="text" class="form-control" placeholder="Email">
            <?= (isset($message['email'])) ? '<span class="help-block">'.$message['email'].' .</span>'  : '' ?>
          </div>
          <button class="btn btn-success center-block" type="submit" name="button-email">Changer mon adresse email</button>
        </form>
        <br>
        <h3 class="text-center">Changer mon mot de passe</h3>
        <form class="" action="" method="post">
          <div class="form-group">
            <label for="password">Nouveau mot de passe :</label>
            <input id="password" name="password" type="password" class="form-control" placeholder="Mot de passe">
          </div>
          <div class="form-group">
            <label for="cfpassword">Confirmer le nouveau mot de passe :</label>
            <input id="cfpassword" name="cfpassword" type="password" class="form-control" placeholder="Mot de passe">
          </div>
          <button class="btn btn-success center-block" type="submit" name="button-password">Changer mon mot de passe</button>
        </form>
      </div>
    </div><!-- .row -->
  </div><!-- .container-fluid -->
</div><!-- #changeInfos -->

<?php $this->stop('main_content') ?>
