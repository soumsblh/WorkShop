<?php $this->layout('layout', ['title' => 'login']) ?>

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
<?php $this->stop('main_content') ?>