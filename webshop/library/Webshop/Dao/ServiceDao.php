<?php
/**
 * Created by JetBrains PhpStorm.
 * User: terios
 * Date: 08/06/13
 * Time: 16:23
 * To change this template use File | Settings | File Templates.
 */

class Webshop_Dao_ServiceDao
{
    /**
     * fonction de recherche de nimporte quelle objet dans la classe avec un seul critere
     * @param $_em
     * @param $type
     * @param $critere
     * @param $valeur
     * @return mixed
     */
    public static function findMultiCritere($_em, $type, $critere, $valeur)
    {
        $qb = $_em->createQueryBuilder();
        $type = ' Application_Model_' . $type;

        $critere = 'u.' . $critere . '=?1';
        $dql = $qb->getDql();
        $qb->select('u')
            ->from($type, 'u')
            ->where($critere)
            ->setParameter(1, $valeur);
        $q = $qb->getQuery();
        $array = $q->getArrayResult();
        return $array;
    }

    /**
     * fonction d'ajout dans la base de donne
     * @param $_em
     * @param $type
     * @param $requette
     * @return null
     */
    public static function ajoutObjet($_em, $type, $requette)
    {
        $listErreur = Webshop_Dao_Utilities_DataValidation::compteCheck($requette);
        if (sizeof($listErreur) == 0) {
            $compte=self::findMultiArgument($_em, "Compte", array('login = \'' . $requette->getPost('login') . '\''));
            if(sizeof($compte)<=0){
                $compte=self::findMultiArgument($_em, "Compte", array('email = \'' . $requette->getPost('email') . '\''));
                if(sizeof($compte)<=0)
                    self::persistObjetByNameRequest($_em, "Compte", $requette);
                else
                    array_push($listErreur, 'emailExiste');
            }else
                array_push($listErreur, 'loginExiste');
        }
        return $listErreur;
    }

    /**
     * jai besoin dans la requette de l'id du compte obligatoire
     */

    public static function persistObjetByNameRequest($_em, $nom, $requette)
    {
        switch ($nom) {
            case "Compte":
                $tmp = new  Application_Model_Compte();
                $tmp->email = $requette->getPost('email'); //$requette->email;
                $tmp->nom = $requette->getPost('lastName'); //$requette->nom;
                $tmp->prenom = $requette->getPost('firstName'); //$requette->prenom;
                $tmp->password = Webshop_Utilities_PasswordHashe::passwordHashing($requette->getPost('password'), 5);
                $tmp->login = $requette->getPost('login'); //$requette->login;
                $tmp->isActivated = false; //$requette->getPost('isActivated'); //$requette->isActivated;
                $_em->persist($tmp);
                $_em->flush();
                return $tmp;
                break;
            case "Rubrique":
                $tmp = new  Application_Model_Rubrique();
                $tmp->nom = $requette->getPost('nom');
                $tmp->lien = $requette->getPost('lien');
                $compte_id = $requette->getPost('id_compte');
                $_em->persist($tmp);
                $_em->flush();
                $compte = self::findMultiArgument($_em, 'Compte', array(' id = ' . $compte_id));
                $rubrique = self::findMultiArgument($_em, 'Rubrique', array(' nom = \'' . $tmp->nom . '\' '));
                $rubrique[0]->compte = $compte[0];
                $_em->persist($rubrique[0]);
                $_em->flush();
                return $rubrique;
                break;
            case "Conception":
                return new  Application_Model_Conception();
                break;
            case "Contact":
                return new  Application_Model_Contact();
                break;
            case "Cours":
                return new  Application_Model_Cours();
                break;
            case "Ecole":
                return new  Application_Model_Ecole();
                break;
            case "Enseignant":
                $tmp = new  Application_Model_Enseignant();
                $nomRubrique = $requette->getPost('nom');
                $lienRubrique = $requette->getPost('lien');
                $tmp->prenom = $requette->getPost('prenom');
                $tmp->specialite = $requette->getPost('specialite');
                $tmp->apropos = $requette->getPost('apropos');
                $tmp->formation = $requette->getPost('formation');
                $tmp->experianceProfessionnel = $requette->getPost('experianceProfessionnel');
                $tmp->competences = $requette->getPost('competences');
                $tmp->ecole = $requette->getPost('ecole');
                $tmp->setParentNom('nom', $nomRubrique);
                $tmp->setParentLien('lien', $lienRubrique);
                $compte_id = $requette->getPost('id_compte');
                ;
                $compte = findMultiArgument($_em, 'Compte', array(' id = ' . $compte_id));
                $tmp->setParentCompte('compte', $compte[0]);
                $_em->persist($tmp);
                $_em->flush();
                return $tmp;
                break;
            case "Entreprise":
                return new  Application_Model_Entreprise();
                break;
            case "Evenement":
                return new  Application_Model_Evenement();
                break;
            case "Fichier":
                return new  Application_Model_Fichier();
                break;
            case "FichierEcole":
                return new  Application_Model_FichierEcole();
                break;
            case "FichierEnseignant":
                return new  Application_Model_FichierEnseignant();
                break;
            case "FichierEntreprise":
                return new  Application_Model_FichierEntreprise();
                break;
            case "FichierProjet":
                return new  Application_Model_FichierProjet();
                break;
            case "Filliere":
                return new  Application_Model_Filliere();
                break;
            case "Message":
                return new  Application_Model_Message();
                break;
            case "Offre":
                return new  Application_Model_Offre();
                break;
            case "Partenaire":
                return new  Application_Model_Partenaire();
                break;
            case "Projet":
                return new  Application_Model_Projet();
                break;
            case "Realisation":
                return new  Application_Model_Realisation();
                break;
            case "Telechargement":
                return new  Application_Model_Telechargement();
                break;
            case "Traveaux":
                return new  Application_Model_Traveaux();
                break;
            case "Type":
                return new  Application_Model_Type();
                break;
        }
    }

    public static function getObjetByName($nom)
    {
        switch ($nom) {
            case "Compte":
                return new Application_Model_Compte();
                break;
            case "Rubique":
                return new Application_Model_Rubrique();
                break;
            case "Conception":
                return new Application_Model_Conception();
                break;
            case "Contact":
                return new Application_Model_Contact();
                break;
            case "Cours":
                return new Application_Model_Cours();
                break;
            case "Ecole":
                return new Application_Model_Ecole();
                break;
            case "Enseignant":
                return new Application_Model_Enseignant();
                break;
            case "Entreprise":
                return new Application_Model_Entreprise();
                break;
            case "Evenement":
                return new Application_Model_Evenement();
                break;
            case "Fichier":
                return new Application_Model_Fichier();
                break;
            case "FichierEcole":
                return new Application_Model_FichierEcole();
                break;
            case "FichierEnseignant":
                return new Application_Model_FichierEnseignant();
                break;
            case "FichierEntreprise":
                return new Application_Model_FichierEntreprise();
                break;
            case "FichierProjet":
                return new Application_Model_FichierProjet();
                break;
            case "Filliere":
                return new Application_Model_Filliere();
                break;
            case "Message":
                return new Application_Model_Message();
                break;
            case "Offre":
                return new Application_Model_Offre();
                break;
            case "Partenaire":
                return new Application_Model_Partenaire();
                break;
            case "Projet":
                return new Application_Model_Projet();
                break;
            case "Realisation":
                return new Application_Model_Realisation();
                break;
            case "Telechargement":
                return new Application_Model_Telechargement();
                break;
            case "Traveaux":
                return new Application_Model_Traveaux();
                break;
            case "Type":
                return new Application_Model_Type();
                break;
        }
    }

    public static function updateCompte($_em, $request)
    {
        $password="";
        $updateString="";
        if(strcmp($request->getPost('lastName'),'')!=0)$updateString.=" cmp.nom = '".$request->getPost('lastName')."'";
        if(strcmp($request->getPost('firstName'),'')!=0)$updateString.=", cmp.prenom = '".$request->getPost('firstName')."'";
        if(strcmp($request->getPost('password'),'')!=0){
            $password=Webshop_Utilities_PasswordHashe::passwordHashing($request->getPost('password'));
            $updateString.=", cmp.password = '".$password."'";
        }

            //if(strcmp($request->getPost('passwordConf'),$request->getPost('password'))==0)$updateString.=" and cmp.password = '".$request->getPost('password')."'";
        $q = $_em->createQuery("update Application_Model_Compte cmp set ".$updateString." where cmp.id='".$request->getPost('id')."'");
        return $q->execute();
    }
    public static function passwordUpdate($_em, $email,$password)
    {
        $password=Webshop_Utilities_PasswordHashe::passwordHashing($password);
        $q = $_em->createQuery("update Application_Model_Compte cmp set cmp.password = '".$password."' where cmp.email='".$email."'");
        return $q->execute();
    }

    public static function getAccountActivationCode($_em,$email)
    {
        $account=self::findMultiArgument($_em,'Compte',array("email='".$email."'"));
        if(sizeof($account)==1){
            $string=$account[0]->prenom.'78a1'.$account[0]->password;
            return substr($string, (strlen($string) - 1)/2,(strlen($string) - 1) );
        }else
            return $email;
         
    }

    public static function activatingAccount($_em,$email)
    {
        $q = $_em->createQuery("update Application_Model_Compte cmp set cmp.isActivated = 1 where cmp.email='".$email."'");
        return $q->execute();
    }
    public static function findMultiArgument($_em, $type, $arraycritere)
    {
        /**
         * la forme de arracritre
         * $arraycritere = array(' id = '.$compte_id , ' prenom = \''.$compte_prenom.'\' ');
         */
        $qb = $_em->createQueryBuilder();
        $type = 'Application_Model_' . $type;

        $counter = 0;
        $criterQuery = '';
        foreach ($arraycritere as $critere) {
            if ($counter == 0) {
                $criterQuery = 'u.' . $critere;

            } else {
                $criterQuery = $criterQuery . ' AND u.' . $critere;
            }
            $counter++;
        }
        $query = $_em->createQuery('SELECT u FROM ' . $type . ' u WHERE ' . $criterQuery);
        $array = $query->getResult();
        $counter = 0;
        return $array;
    }
}