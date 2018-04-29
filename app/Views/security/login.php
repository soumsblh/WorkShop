<?php $this->layout('layout', ['title' => 'Se connecter']) ?>

<?php $this->start('main_content') ?>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-up" checked><label for="tab-1" class="tab">Se connecter</label>
            <div class="login-form">
                <form  class="sign-up-htm" action="" method="POST">
                    <div class="group">
                        <label for="user" class="label">Nom</label>
                        <input id="username" name="username" class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Mot de passe</label>
                        <input id="password" name="password" class="input" type="password" data-type="password">
                    </div>
                    <div class="group">
                        <button type="submit" class="button btn btn-submit" name="button-login">Se connecter</button>
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="<?php echo $this->url('security_forget'); ?>">Mot de passe oublié ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $this->stop('main_content') ?>