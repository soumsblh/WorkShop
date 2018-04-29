<?php $this->layout('layout', ['title' => 'Inscription']) ?>

<?php $this->start('main_content') ?>
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-up" checked><label for="tab-1" class="tab">S'inscrire</label>
        <div class="login-form">
            <form class="sign-up-htm" method="POST">
                <div class="group">
                    <label for="user" class="label">Nom</label>
                    <input id="username" type="text" class="input" id="username" name="username" value="<?= $username  ?>">
                </div>
                <div class="group">
                    <label for="user" class="label">Siren</label>
                    <input id="siren" type="text" class="input" id="Siren" name="siren" value="<?= $siren  ?>">
                </div>
                <div class="group">
                    <label for="pass" class="label">Mot de passe </label>
                    <input id="pass" type="password" class="input" data-type="password" id="password" name="password">
                </div>
                <div class="group">
                    <label for="pass" class="label">Email</label>
                    <input id="pass" type="text" class="input" id="email" name="email" value="<?= $email ?>">
                </div>
                <div class="group">
                    <button type="submit" class="button btn btn-default" name="button-register">S'enregistrer</button>
                </div>
                <div class="hr"></div>
                <div class="foot-lnk">
                    <label for="tab-1" ><a href="<?php echo $this->url('security_login'); ?>"> Vous-etez déjà membre ? </a></label>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->stop('main_content') ?>
