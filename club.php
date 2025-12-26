<?php
require_once "config.php";
class club implements gestion
{
    public object $connection ;
    public string $Userid ;
    public function __construct($connect)
    {
        $this -> connection = $connect ;
    }
    public function create($name, $ville)
    {
        $insertion = "INSERT INTO club(name,ville)VALUES('$name','$ville');";
        $this -> connection->query($insertion);
    }
    public function update($nouvellename,$nouvelleville) {
         $operation = "UPDATE club  
         SET name = '$nouvellename' , ville = '$nouvelleville' WHERE id = '$this->Userid'";
        $this-> connection -> query($operation);
         return "\n\nL'operation bien fait\n\n";
    }
    public function read() {
        $operation = "SELECT * FROM club ";
         $resault = $this-> connection -> query($operation);
         $stmt = $resault -> fetch_all(MYSQLI_ASSOC);
            echo "\n id ______ name  ______ ville \n";
         foreach ($stmt as $club) {
            echo " $club[id] ______ $club[name] ______$club[ville] \n";
         }
    }
    public function delete() {
        $operation = "DELETE FROM club WHERE id = '$this->Userid'";
           $this-> connection -> query($operation);
        if(($this -> Userid)==false){
        echo "\n\n _____ La suppression pas fait !!!!! _____\n\n";
        }
        else{
            echo "\n\n _____ La suppression est bien fait ✅✅ _____\n\n";
        }
    }
    public function search($nom){
        $operation = "SELECT * FROM club WHERE name = '$nom'";
         $resault = $this-> connection -> query($operation);
         $stmt =  mysqli_fetch_assoc($resault);
         if($stmt) {
            $this -> Userid = $stmt['id'] ;
             return "\n\n____________ Voici Le club : $stmt[name] _____________ leur ville : $stmt[ville] _____________\n\n";
         }
         else{
            $this -> Userid = false ;
            return "\n\n _______ Le club pas trouvée !!!!! _____\n\n";
         }
    }
    public function Allteams(){
        $operation = "SELECT club.name as cm , COUNT(equipe.id) as equipes
                        FROM club LEFT JOIN equipe 
                         ON  club.id = equipe.clubid
                         GROUP BY club.name";
                         $resault = $this-> connection -> query($operation);
             $stmt = $resault -> fetch_all(MYSQLI_ASSOC);
         foreach ($stmt as $element) {
            echo "\n\n $element[cm] ______ $element[equipes]\n";
         }
    }
}
$test = false;
    $new_club = new club($connection) ;
while (!$test) {
    echo "\n==== GESTION DES CLUBS ==== \n";
    echo "1. ADD A CLUB \n";
    echo "2. EDIT A CLUB \n";
    echo "3. REMOVE A CLUB \n";
    echo "4. READ ALL CLUBS \n";
    echo "5. THE NUMBER OF TEAMS IN ALL CLUBS \n";
    echo "0. Exit \n";
    $choix = $console->input("Entrer votre choix");
    switch ($choix) {
        case '1':
            echo "1. WRITE THE NAME OF CLUB  ";
            $name = $console->input("  ");
            echo "2. WRITE THE LOCATION OF CLUB  ";
            $ville = $console->input("  ");
            "opperation valide : name : $name , ville : $ville ;";
            $new_club->create($name, $ville);
            echo "\n\n insertion avec succées\n\n";
            break;
        case '2':
            $name = $console->input("Entrer le nom de de le club que tu veux modifier ");
            echo $new_club->search($name) ;
            if(($new_club -> Userid)){
            $nouvellename = $console->input("Entrer le nouveaux nom : ");
            $nouvelleville = $console->input("Entrer la nouvelle ville : ");
            echo $new_club->update($nouvellename,$nouvelleville) ;
            }
            break;
        case '3':
             $name = $console->input("Entrer le nom de de le club que tu veux supprimer ");
            echo $new_club->search($name) ;
            echo $new_club->delete() ;
            break;
        case '4':
            echo $new_club->read() ;
            break;
             case '5':
            echo $new_club->Allteams() ;
            break;
        case '0':
            $test = true;
        default:
            break;
    }
}
