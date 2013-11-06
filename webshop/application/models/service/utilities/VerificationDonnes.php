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

    /*public static function  requetteArgumentNull($requette)
    {
        if ($requette->getParam('email') == null) return true;
        if ($requette->getParam('lastName') == null) return true;
        if ($requette->getParam('firstName') == null) return true;
        if ($requette->getParam('password') == null) return true;
        if ($requette->getParam('passwordConf') == null) return true;
        if ($requette->getParam('login') == null) return true;
        return false;
    }*/

    /**
     * verification du login et du password
     * @param $requette
     * @return bool
     */
    public static function  loginVerification($requette)
    {
        if ($requette->getParam('password') != null) {
            return true;
        }
        if ($requette->getParam('login') != null) {
            return true;
        }
        return false;
    }

    public
    static function verifCompte($compte)
    {
        $listErreur = array();
        if (!self::verifLogin($compte->getPost('login'))) {
            array_push($listErreur, 'login');
        }
        if (!self::verifPassword($compte->getPost('password'))) {
            if(strcmp($compte->getPost('passwordConf'), $compte->getPost('password'))!=0){
                array_push($listErreur, 'passwordConf');
            }
            array_push($listErreur, 'password');
        }
        if (!self::verifEmail($compte->getPost('email'))) {
            array_push($listErreur, 'email');
        }
        if (strlen($compte->getPost('lastName'))<=0) {
            array_push($listErreur, 'lastName');
        }
        if (strlen($compte->getPost('firstName'))<=0) {
            array_push($listErreur, 'firstName');
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
