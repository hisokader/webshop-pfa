<?php
/**
 * Created by JetBrains PhpStorm.
 * User: terios
 * Date: 10/06/13
 * Time: 14:56
 * To change this template use File | Settings | File Templates.
 */


function uploadFichier($upload, $chemin, $sessionObjet)
{

    // Retourne toutes les informations connues sur le fichier
    $session = unserialize($sessionObjet);
    if (!file_exists($chemin . '/' . $session->login) and !is_dir($chemin . '/' . $session->login)) {
        $chemin = $chemin . '/' . $session->login;
        mkdir($chemin);
    }
    $upload->setDestination($chemin);
    $files = $upload->getFileInfo();
    foreach ($files as $file => $info) {
        // Fichier uploadé ?
        if (!$upload->isUploaded($file)) {
            print "Pourquoi n'avez-vous pas uploadé ce fichier ?";
            continue;
        }
        // Les validateurs sont-ils OK ?
        if (!$upload->isValid($file)) {
            print "Désolé mais $file ne correspond à ce que nous attendons";
            continue;
        }
    }
    $upload->receive();

    if ($upload->isReceived($file)) {
        print "uploade :) ";
        $names = $upload->getFileName();
        $size = $upload->getFileSize();
        echo "nom : " . $names . "-----" . $size;

    }
}