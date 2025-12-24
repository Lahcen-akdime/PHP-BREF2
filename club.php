<?php
require_once "console.php" ;
require "config.php" ;
class club{
public function create($name,$ville,$connection){
$insertion = "INSERT INTO club(name,ville)VALUES('$name','$ville');";
 $connection -> query($insertion) ;
}
public function update(){

}
public function read(){

}
public function delete(){

}
}
while(true){
echo "\n==== GESTION DES CLUBS ==== \n";
    echo "1. ADD A CLUB \n" ;
    echo "2. EDIT A CLUB \n" ;
    echo "3. REMOVE A CLUB \n" ;
    echo "4. READ ALL CLUBS \n" ;
    echo "0. Exit \n";
    $new_club = new club();
    $choix = $console->input("Entrer votre choix");
    switch ($choix) {
            case '1':
    echo "1. WRITE THE NAME OF CLUB  " ;
    $name = $console->input("  ");
     echo "2. WRITE THE LOCATION OF CLUB  " ;
    $ville = $console->input("  ");
    "opperation valide : name : $name , ville : $ville ;" ;
   $new_club -> create($name,$ville,$connection);
   echo "\n\n insertion avec succées\n\n";
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
}