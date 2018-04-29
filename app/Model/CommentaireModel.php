<?php
/**
 * Created by PhpStorm.
 * User: Mustapha
 * Date: 24/04/2018
 * Time: 11:19
 */

namespace Model;


use W\Model\Model;

class CommentaireModel extends Model
{
    public function getAllCommentairesByCom($id)
    {
        $sql = ('SELECT * FROM commentaire WHERE idComm ='.$id);
        $sth = $this->dbh->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}