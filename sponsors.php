<?php
require_once "console.php" ;
class sponsors implements gestion{
    public object $connection ;
    public string $Userid ;
    public function __construct($connect)
    {
        $this -> connection = $connect ;
    }
public function create($nom , $Contribution , $tournoiid){
 $insertion = "INSERT INTO sponsors(nom,Contribution,tournoi_id)VALUES('$nom','$Contribution','$tournoiid');";
   $this -> connection->query($insertion);
}
public function search($nom){
$operation = "SELECT * FROM sponsors WHERE nom = '$nom'";
      $resault = $this->connection->query($operation);
      $stmt =  mysqli_fetch_assoc($resault);
      if ($stmt) {
         $this->Userid = $stmt['id'];
         return "\n\n____________ Voici Le sponsor :  $stmt[nom]  _____________ leur Contribution : $stmt[Contribution] _____________\n\n";
      } else {
         $this->Userid = false;
         return "\n\n _______ Le tournoi pas trouvée !!!!! _____\n\n";
      }
}

public function update($nom , $Contribution ,$tournoi_id ){
$operation = "UPDATE sponsors  
         SET nom = '$nom' ,
          Contribution = '$Contribution' ,
           tournoi_id = '$tournoi_id' 
            WHERE id = $this->Userid";
      $this->connection->query($operation);
      return "\n\nL'operation bien fait\n\n";
}
public function read(){
 $operation = "SELECT * FROM sponsors ";
         $resault = $this-> connection -> query($operation);
         $stmt = $resault -> fetch_all(MYSQLI_ASSOC);
            echo "\n id ______ Titre  ______ Contribution _____ date \n\n";
         foreach ($stmt as $sponsors) {
            echo " $sponsors[id] ______  $sponsors[nom]  ______$sponsors[Contribution] ______$sponsors[date]\n";
         }
}
public function delete(){
 if(($this -> Userid)==false){
        echo "\n\n _____ La suppression pas fait !!!!! _____\n\n";
        }
        else{
            $operation = "DELETE FROM sponsors WHERE id = '$this->Userid'";
           $this-> connection -> query($operation);
            echo "\n\n _____ La suppression est bien fait ✅✅ _____\n\n";
        }
}
}
$new_sponsor = new sponsors($connection);
$test = true;
while ($test) {
 echo "\n==== GESTION DES SPONSORS ==== \n";
    echo "1. ADD A SPONSOR \n" ;
    echo "2. EDIT A SPONSOR \n" ;
    echo "3. REMOVE A SPONSOR \n" ;
    echo "4. READ ALL SPONSORS \n" ;
    echo "0. Exit \n";
     $choice = $console->input(" VOTRE CHOIX ");
   switch ($choice) {
      case '1':
         echo "1. WRITE THE NAME OF THE sponsor  ";
         $nom = $console->input("  ");
         echo "2. WRITE THE Contribution OF THE sponsor  ";
         $Contribution = $console->input("  ");
         echo "3. WRITE THE ID OF THE TOURNOI  ";
         $tournoiid = $console->input("  ");
         $new_sponsor->create($nom , $Contribution , $tournoiid);
         echo "\n\n insertion avec succées\n\n";
         break;
      case '2':
         $nom = $console->input("Entrer le nom de l'equipe que tu veux modifier ");
         echo $new_sponsor->search($nom);
         if (($new_sponsor->Userid)) {
            $nom = $console->input("Entrer le nouveaux nom ");
            $cash = $console->input("Entrer le nouveaux cash ");
            $format = $console->input("Entrer le nouveaux tournoi id ");
            echo $new_sponsor->update($nom, $cash, $format);
         }
         break;
      case '3':
         $nom = $console->input("Entrer le nom de le sponsor que tu veux supprimer ");
         echo $new_sponsor->search($nom);
         echo $new_sponsor->delete();
         break;
      case '4':
         echo $new_sponsor->read();
         break;
      case '0':
         $test = false;
      default:
         break;
   }
}