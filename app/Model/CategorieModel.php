<?php
/**
 * Created by PhpStorm.
 * User: Mustapha
 * Date: 23/04/2018
 * Time: 13:33
 */

namespace Model;

use \W\Model\Model;

class CategorieModel extends Model
{
    public function getAllCategoriesByPro($id)
    {
        $sql = ('SELECT * FROM categorie WHERE id_user ='.$id);
        $sth = $this->dbh->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}