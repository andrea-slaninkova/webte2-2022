<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php

require_once "MyPdo.php";
require_once "Inventor.php";
require_once "Invention.php";

$myPdo = new MyPDO("mysql:host=localhost;dbname=zadanie_5", "xslaninkovaa", "hLYWRSk6EKRiSTs_");

$file = fopen("vynalezy.csv","r");
while (!feof($file)){
    $pole = fgetcsv($file, null, ";");
    if($pole[0]){
        $inventor = Inventor::searchByDescription($pole[7]);
        if(!$inventor)
        {
            $inventor = new Inventor();
            $inventor->setName($pole[0]);
            var_dump($pole[0]);
            $inventor->setSurname($pole[1]);
            var_dump($pole[1]);
            $inventor->setImage($pole[2]);
            $inventor->setBirthDate($pole[3]);
            $inventor->setBirthPlace($pole[4]);
            $inventor->setDeathDate($pole[5]);
            $inventor->setDeathPlace($pole[6]);
            $inventor->setDescription($pole[7]);
            $inventor->save();
            $inventor_id = $inventor->getId();
        }

        $invention = new Invention();
        $invention->setInventorId($inventor->getId());
        $invention->setInventionDate($pole[8]);
        $invention->setDescription($pole[9]);
        $invention->save();

    }


}