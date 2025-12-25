<?php
require_once "console.php" ;
class Equipe{
    public object $connection ;
    public string $Userid ;
    public function __construct($connect)
    {
        $this -> connection = $connect ;
    }
 public function create($name, $jou , $clubid)
    {
        $insertion = "INSERT INTO equipe(nom,jeu,clubid)VALUES('$name','$jou','$clubid');";
        $this -> connection->query($insertion);
    }
public function search($name){
    $operation = "SELECT * FROM equipe WHERE nom = '$name'";
         $resault = $this-> connection -> query($operation);
         $stmt =  mysqli_fetch_assoc($resault);
         // If the team exist 
         if($stmt) {
            // Search his club 
        $operation2 = "SELECT * FROM club WHERE id = '$stmt[clubid]'";
         $resault2 = $this-> connection -> query($operation2);
         $theclub =  mysqli_fetch_assoc($resault2);
            $this -> Userid = $stmt['id'] ;
             return "\n\n____________ Voici L'equipe : $stmt[nom] _____________ leur game : $stmt[Jeu] _____________ leur club : $theclub[name]\n\n";
         }
         else{
            $this -> Userid = false ;
            return "\n\n _______ L'equipe pas trouvée !!!!! _____\n\n";
         }
}
public function update($name,$game){
$operation = "UPDATE equipe SET nom = $name , Jou = $game";
}
public function read(){

}
public function delete(){

}
}
$test = false;
    $new_equipe = new Equipe($connection) ;
while (!$test) {
echo "\n==== GESTION DES EQUIPES ==== \n";
    echo "1. ADD A EQUIPE \n" ;
    echo "2. EDIT A EQUIPE \n" ;
    echo "3. REMOVE A EQUIPE \n" ;
    echo "4. READ ALL EQUIPES \n" ;
    echo "0. Exit \n";
    $choix = $console->input("Entrer votre choix");
    switch ($choix) {
        case '1':
            echo "1. WRITE THE NAME OF THE TEAM  ";
            $name = $console->input("  ");
            echo "2. WRITE THE GAME OF THE TEAM  ";
            $game = $console->input("  ");
            echo "3. WRITE THE ID OF THERE CLUB  ";
            $clubid = $console->input("  ");
            $new_equipe->create($name, $game , $clubid);
            echo "\n\n insertion avec succées\n\n";
            break;
        case '2':
            echo "1. WRITE THE NAME OF THE TEAM  ";
            $name = $console->input("  ");
            echo $new_equipe->search($name) ;
            break;
        case '3':
            echo $new_equipe->search($name) ;
            if($new_equipe -> Userid != false){
             $choise = $console->input("Si tu veux changer les infos tapez 1 \nSi tu veux changer le club tapez 2 \n\n");
                if($choise == 1){
                    $name = $console->input("Tapez le neveau nom  ");
                    $game = $console->input("Tapez le neveau jeu  ");
                echo $new_equipe->update($name,$game) ;
                }
                elseif($choise == 2){
                    $name = $console->input("Tapez le id de neuveau club ");
                }
            }
            break;
        case '4':
            break;
        case '0':
            $test = true;
        default:
            break;
    }
}



