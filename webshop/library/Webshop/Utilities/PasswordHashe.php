﻿<?php
class Webshop_Utilities_PasswordHashe{


    public static function randomString($length = 32, $chars = '1234567890abcdef') {
        // length of character list
        $charsLength = (strlen($chars) - 1);
        // start our string
        $string = $chars{rand(0, $charsLength)};
        // generate random string
        for ($i = 1; $i < $length; $i = strlen($string)) {
            // grab a random character from our list
            $r = $chars{rand(0, $charsLength)};
            // make sure the same two characters don't appear next to each other
            if ($r != $string{$i - 1}) {
                $string .=  $r;
            } else {
                $i–;
            }
        }
        // return the string
        return $string;
    }

    public static function passwordHashing($password,$saltLenght=5){
    	if (isset($password)) {
    		$randomString=self::randomString($saltLenght);
    		return $randomString.sha1($randomString.$password);
    	}
		else
			return null;
    }
    public static function isPasswordsMatch($passwordInserted,$loginPasswordHashed,$saltLenght=5){
    	if (isset($passwordInserted) && isset($loginPasswordHashed)) {
    		$passwordHashed=substr($loginPasswordHashed, 0, $saltLenght). sha1(substr($loginPasswordHashed, 0, $saltLenght).$passwordInserted) ;
            if(strcmp($passwordHashed,$loginPasswordHashed)==0)
    			return true;
    		else
    			return false;
    	}
		else
			return false;
    }


}