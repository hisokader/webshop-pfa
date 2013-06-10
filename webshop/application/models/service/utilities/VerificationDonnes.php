<?php
/**
 * Created by JetBrains PhpStorm.
 * User: terios
 * Date: 09/06/13
 * Time: 16:12
 * To change this template use File | Settings | File Templates.
 */

/**
 * function de varification de l'adresse email
 * @param $email
 * @return bool
 */
class Application_Model_Service_Utilities_VerificationDonnes
{
    public static function verifTelephone($telephone)
    {
    }

    /**
     * fonction de verification d'adresse URL
     * @param $url
     * @return bool
     */
    public static function verifUrl($url)
    {
        if (preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $url)) {
            return true;
        } else {
            return false;
        }
    }

    public static function  requetteToCompte($requette)
    {
        if ($requette->getParam('email') == null) {
            return true;
        }
        if ($requette->getParam('lastName') == null) {
            return true;
        }
        if ($requette->getParam('firstName') == null) {
            return true;
        }
        if ($requette->getParam('password') == null) {
            return true;
        }
        if ($requette->getParam('login') == null) {
            return true;
        }
        return false;
    }

    /**
     * verification du login et du password
     * @param $requette
     * @return bool
     */
    public static function  requetteToauthentification($requette)
    {
        if ($requette->getParam('password') == null) {
            return true;
        }
        if ($requette->getParam('login') == null) {
            return true;
        }
        return false;
    }

    public
    static function verifCompte($compte)
    {
        $listErreur = array();
        if (!self::verifLogin($compte->login)) {
            array_push($listErreur, ' Login non accepter (ex : anas_terios )');
        }
        if (!self::verifPassword($compte->password)) {
            array_push($listErreur, ' password non accepter (ex : myPas00rd )');
        }
        if (!self::verifEmail($compte->getParam('email'))) {
            array_push($listErreur, ' Email non accepter (ex : anas_terios@gmail.fr )');
        }
        if ($compte->nom == '') {
            array_push($listErreur, ' Nom non null');
        }
        if ($compte->prenom == '') {
            array_push($listErreur, ' Prenom non null');
        }
        return $listErreur;
    }

    /**
     * fonction de verification de login
     * @param $login
     * @return bool
     */
    public static function verifLogin($login)
    {
        if (preg_match('/^[a-z\d_]{5,20}$/i', $login)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * functioon de verification de mot de passe
     * @param $password
     * @return bool
     */
    public static function verifPassword($password)
    {
        if (preg_match('/^[a-z0-9_-]{6,18}$/', $password)) {

            return true;
        } else {
            return false;
        }
    }

    public static function verifEmail($email)
    {
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (preg_match($regex, $email)) {
            return true;
        } else {
            return false;
        }
    }


}
