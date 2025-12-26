<?php
require_once "console.php" ;
class Joueur implements gestion{
    public object $connection ;
    public string $Userid ;
    public function __construct($connect)
    {
        $this -> connection = $connect ;
    }
public function create($a,$b){

}
public function update($a,$b){

}
public function read(){

}
public function delete(){

}
}
 echo "\n==== GESTION DES JOUEURS ==== \n";
    echo "1. ADD A JOUEUR \n" ;
    echo "2. EDIT A JOUEUR \n" ;
    echo "3. REMOVE A JOUEUR \n" ;
    echo "4. READ ALL JOUEURS \n" ;
    echo "0. Exit \n";