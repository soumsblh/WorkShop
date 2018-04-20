<?php $this->layout('layout', ['title' => 'Inscription']) ?>

<?php $this->start('main_content') ?>
<div id="register">
  <div class="container-fluid">
    <div class="row">
    
      <form class="col-md-9 col-md-push-2" method="POST">
        <h2>Inscription :</h2>
        <div class="form-group <?= (isset($message['lastname'])) ? 'has-error' : ''?>">
          <label class="control-label" for="lastname">Nom :</label>
          <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $lastname  ?>">
          <?= (isset($message['lastname'])) ? '<span class="help-block">'.$message['lastname'].' </span>'  : '' ?>
        </div>

        <div class="form-group <?= (isset($message['firstname'])) ? 'has-error' : ''?>">
          <label class="control-label" for="firstname">Prenom :</label>
          <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname  ?>">
          <?= (isset($message['firstname'])) ? '<span class="help-block">'.$message['firstname'].' </span>'  : '' ?>
        </div>

        <div class="form-group <?= (isset($message['username'])) ? 'has-error' : ''?>">
          <label class="control-label" for="username">Pseudo :</label>
          <input type="text" class="form-control" id="username" name="username" value="<?= $username  ?>">
          <?= (isset($message['username'])) ? '<span class="help-block">'.$message['username'].' </span>'  : '' ?>
        </div>

        <div class="form-group <?= (isset($message['email'])) ? 'has-error' : ''?>">
          <label class="control-label" for="email">Email :</label>
          <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>">
          <?= (isset($message['email']) ) ? '<span class="help-block">'.$message['email'].' </span>'  : '' ?>
        </div>

      <div class="form-group <?= (isset($message['password'])) ? 'has-error' : ''?>">
          <label for="password">Mot de passe  :</label>
          <input type="password" class="form-control" id="password" name="password">
          <?= (isset($message['password']) ) ? '<span class="help-block">'.$message['password'].' </span>'  : '' ?>
        </div>

        <div class="form-group <?= (isset($message['cfpassword'])) ? 'has-error' : ''?>">
          <label for="cfpassword">Confirmation du Mot de passe  :</label>
          <input type="password" class="form-control" id="cfpassword" name="cfpassword">
          <?= (isset($message['cfpassword']) ) ? '<span class="help-block">'.$message['cfpassword'].' </span>'  : '' ?>
        </div>

        <button type="submit" class="btn btn-default" name="button-register">S'enregistrer</button>


      </form>
    </div> <!-- .row -->
  </div> <!-- .container -->
</div><!-- #register --> 

<?php $this->stop('main_content') ?>
