<?php $this->layout('layout', ['title' => 'Mot de passe oublié']); ?>

<?php $this->start('main_content'); ?>
<div class="container">
    <?php if(isset($_GET['token'])) : ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="password">Nouveau mot de passe : </label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="cfpassword">Confirmer nouveau mot de passe : </label>
                <input type="password" name="cfpassword" id="cfpassword" class="form-control">
            </div>
            <button name="forgetPassword" class="btn btn-primary">Changer le mot de passe</button>
        </form>
    <?php else: ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email : </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <button name="forgetSend" class="btn btn-primary">M'envoyer un lien pour redéfinir mon mot de passe</button>
        </form>
    <?php endif; ?>
    <?php if (isset($message)): ?>
      <br>
      <div class="well">
        <?= $message; ?>
      </div>
    <?php endif; ?>
</div>

<?php $this->stop('main_content'); ?>
