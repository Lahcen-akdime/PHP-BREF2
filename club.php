<?php
require_once "console.php" ;
class club{
public function create(){

}
public function update(){

}
public function read(){

}
public function delete(){

}
}
echo "\n==== GESTION DES CLUBS ==== \n";
    echo "1. ADD A CLUB \n" ;
    echo "2. EDIT A CLUB \n" ;
    echo "3. REMOVE A CLUB \n" ;
    echo "4. READ ALL CLUBS \n" ;
    echo "0. Exit \n";
    $console = new Console();
    $choix = $console->input("Entre votre choix");
    switch ($choix) {
            case '1':
            break;
            case '2':
            break;
            case '3':
            break;
            case '4':
            break ;
            case '0':
            include "acceuil.php";
        default:
            break;
    }