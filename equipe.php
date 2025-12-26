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
$operation = "UPDATE equipe SET nom = '$name' , Jeu = '$game'";
$this-> connection -> query($operation);
        return "\n\n _______ La modification a bien fait _____\n\n";
}
public function read(){
 $operation = "SELECT * FROM equipe ORDER BY clubid";
         $resault = $this-> connection -> query($operation);
         $stmt = $resault -> fetch_all(MYSQLI_ASSOC);
        //  __________________________________________________________
        echo "\n id ______ name  ______ Jou \n";
        foreach ($stmt as $equipe) {
             $operation2 = "SELECT * FROM club WHERE id = '$equipe[clubid]'";
             $resault2 = $this-> connection -> query($operation2);
             $theclub =  mysqli_fetch_assoc($resault2);
            echo " $equipe[id] ______ $equipe[nom] ______ $equipe[Jeu] __________ leur club : $theclub[name]\n\n";
         }
}
public function delete(){
        if(($this -> Userid)==false){
        echo "\n\n _____ La suppression pas fait !!!!! _____\n\n";
        }
        else{
            $operation = "DELETE FROM equipe WHERE id = '$this->Userid'";
           $this-> connection -> query($operation);
            echo "\n\n _____ La suppression est bien fait ✅✅ _____\n\n";
        }
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
        case '3':
            $name = $console->input("Entrer le nom de de l'equipe que tu veux supprimer ");
            echo $new_equipe->search($name) ;
            echo $new_equipe->delete() ;
            break;
        case '4':
            echo $new_equipe->read() ;
            break;
        case '0':
            $test = true;
        default:
            break;
    }
}



