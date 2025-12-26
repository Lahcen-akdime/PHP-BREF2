<?php
require_once "console.php" ;
class Club implements gestion{
    public object $connection ;
    public string $Userid ;
    public function __construct($connect)
    {
        $this -> connection = $connect ;
    }
public function create($a , $b){

}
public function update($a , $b){

}
public function read(){

}
public function delete(){

}
}
 echo "\n==== GESTION DES TOURNOIS ==== \n";
    echo "1. ADD A TOURNOI \n" ;
    echo "2. EDIT A TOURNOI \n" ;
    echo "3. REMOVE A TOURNOI \n" ;
    echo "4. READ ALL TOURNOIS \n" ;
    echo "0. Exit \n";