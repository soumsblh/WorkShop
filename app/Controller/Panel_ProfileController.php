<?php
namespace Controller;

use Model\CommentaireModel;
use Model\UserModel;
use Model\CategorieModel;
use \W\Controller\Controller;

class Panel_ProfileController extends Controller
{
    public function profilePro()
    {
        //redirection a une page d'erreur si on on n'est pas admin
        $this->allowTo('pros');

        $user_manager		= new UserModel();
        $categorie_manager = new CategorieModel();
        $user = $user_manager->find($this->getUser()['id']);
        $comments = $user_manager->getAllComments($this->getUser()['id']);
        $categorie = $categorie_manager->getAllCategoriesByPro($this->getUser()['id']);

        $this->show('panel_profile/profilePro',['user' => $user,'categorie' => $categorie,'comments'=>$comments]);
    }

    public function profileadherent($id)
    {
        $Note = null;
        $comment = null;

        $Commentaire_manager = new CommentaireModel();
        $user_manager		= new UserModel();
        $categorie_manager = new CategorieModel();
        $Pros = $user_manager->find($id);
        $comments = $user_manager->getAllComments($Pros['id']);
        $categorie = $categorie_manager->getAllCategoriesByPro($Pros['id']);

        if (isset($_POST['comment-save'])) {
            $Note = $_POST['Note'];
            $comment = $_POST['comment'];

            $Commentaire_manager->insert([
                'Note' => $Note,
                'Commentaires' => $comment,
            ]);
        }

        $this->show('panel_profile/profileadherent', ['Pros' => $Pros, 'categorie' => $categorie, 'comments' => $comments]);
    }

}