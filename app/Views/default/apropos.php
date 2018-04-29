<?php $this->layout('layout', ['title' => 'à propos']) ?>
<?php $this->start('main_content') ?>
    <section class="page-section about-heading">
      <div class="container">
        <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src=<?= $this->assetUrl('img/about.jpg') ?> alt="">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <span class="section-heading-upper">Devenez acteur de l'éco-responsabilité</span>
                  <span class="section-heading-lower">Green'Tech</span>
                </h2>
                <p style="text-align:center">
                   <b >   Green'Tech provient d'une problématique d'éco-responsabilité.</b>
                    <br />
                    <br />
                    <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="<?= $this->assetUrl('img/tree.jpg') ?>" alt="">
                    <br />
                    <br />
                    "Comment faire pour mettre en relation les particuliers et les professionnels liés au monde de l'écologie?"
                    <br />
                    <br />
                        Aujourd'hui, 98% de la population a envie d'être plus responsable pour sauver et garder notre planète la plus propre possible. Le problème qui se pose est: "Comment faire pour devenir éco-responsable?"
                    <br />
                    <br />
                    Nous pouvons chercher sur internet des tonnes et des tonnes d'informations, ce n'est pas pour cela que nous allons réaliser concrètement notre démarche. Qui peut nous aider? A qui acheter nos fruits et légumes bio et locales? A qui donner nos déchets pour améliorer le recyclage?
                    <br />
                    <br />
                    Pourquoi passer des heures à chercher sur Internet quand un seul site web nous permet de trouver et localiser ce que nous recherchons?
                    <br />
                    <br />
                    <b>L'idée de "Green'Tech" était née. Un seul site permettant de mettre en relation tous les acteurs de notre éco-responsabilité.</b>
                    <br />
                    <br />
                    <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="<?= $this->assetUrl('img/mountains.jpg') ?>" alt="">
                    <br />
                    <br />
                    Vous, utilisateur, découvriront que nous sommes TOUS les acteurs de l'écologie et que Green'Tech en est le lien.
                    <br />
                    <br />
                    Découvrez enfin les acteurs proches de chez vous qui vous aideront à améliorer notre planète, mais également votre vie et vos dépenses.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php $this->stop('main_content'); ?>
