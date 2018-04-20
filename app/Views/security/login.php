<?php $this->layout('layout', ['title' => 'Connexion']); ?>

<?php $this->start('main_content'); ?>

    <form action="" method="POST">

        <div class="form-group">
            <label>Votre pseudo ou votre email :</label>
            <input id="username" name="username" class="form-control" type="text">
        </div>

        <div class="form-group">
            <label>Votre mot de passe :</label>
            <input id="password" name="password" class="form-control" type="password">
        </div>

        <button class="btn btn-submit">Se connecter</button><p><a href="<?php echo $this->url('security_forget'); ?>">mot de passe oublié?</a></p>
    </form>

<?php $this->stop('main_content'); ?>
