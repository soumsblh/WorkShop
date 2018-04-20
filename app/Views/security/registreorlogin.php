<?php $this->layout('layout', ['title' => 'registreorlogin']) ?>

<?php $this->start('main_content') ?>
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">S'inscrire</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Se connecter</label>
        <div class="login-form">
            <form  class="sign-in-htm" action="" method="POST">
                <div class="group">
                    <label for="user" class="label">Nom</label>
                    <input id="username" name="username" class="form-control">
                </div>
                <div class="group">
                    <label for="pass" class="label">Mot de passe</label>
                    <input id="password" name="password" class="form-control" type="password" data-type="password">
                </div>
                <div class="group">
                    <button type="submit" class="button btn btn-submit">Se connecter</button>
                </div>
                <div class="hr"></div>
                <div class="foot-lnk">
                    <a href="<?php echo $this->url('security_forget'); ?>">Mot de passe oublié ?</a>
                </div>
            </form>
            <form class="sign-up-htm" method="POST">
                <div class="group">
                    <label for="user" class="label">Nom</label>
                    <input id="user" type="text" class="input" id="username" name="username" value="<?= $username  ?>">
                    <?= (isset($message['username'])) ? '<span class="help-block">'.$message['username'].' </span>'  : '' ?>>
                </div>
                <div class="group">
                    <label for="user" class="label">Siren</label>
                    <input id="user" type="text" class="input" id="Siren" name="Siren" value="<?= $Siren  ?>">
                    <?= (isset($message['Siren'])) ? '<span class="help-block">'.$message['Siren'].' </span>'  : '' ?>>
                </div>
                <div class="group">
                    <label for="pass" class="label">Mot de passe </label>
                    <input id="pass" type="password" class="input" data-type="password" id="password" name="password">
                    <?= (isset($message['password']) ) ? '<span class="help-block">'.$message['password'].' </span>'  : '' ?>>
                </div>
                <div class="group">
                    <label for="pass" class="label">Email</label>
                    <input id="pass" type="text" class="input" id="email" name="email" value="<?= $email ?>">
                    <?= (isset($message['email']) ) ? '<span class="help-block">'.$message['email'].' </span>'  : '' ?>>
                </div>
                <div class="group">
                    <button type="submit" class="button btn btn-default" name="button-register">S'enregistrer</button>
                </div>
                <div class="hr"></div>
                <div class="foot-lnk">
                    <label for="tab-1">Vous-etez déjà membre ? </label>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->stop('main_content') ?>
