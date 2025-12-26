<?php
require_once "console.php" ;
class Tournoi implements gestion{
    public object $connection ;
    public string $Userid ;
    public function __construct($connect)
    {
        $this -> connection = $connect ;
    }
public function create($name , $cash , $fomat ){
   $insertion = "INSERT INTO tournoi(Titre,Cashprize,Format)VALUES('$name','$cash','$fomat');";
   $this -> connection->query($insertion);
}
public function update($name, $cash, $format){
$operation = "UPDATE tournoi  
         SET Titre = '$name' ,
          Cashprize = '$cash' ,
           Format = '$format' 
            WHERE id = $this->Userid";
      $this->connection->query($operation);
      return "\n\nL'operation bien fait\n\n";
}
public function search($name){
$operation = "SELECT * FROM tournoi WHERE Titre = '$name'";
      $resault = $this->connection->query($operation);
      $stmt =  mysqli_fetch_assoc($resault);
      if ($stmt) {
         $this->Userid = $stmt['id'];
         return "\n\n____________ Voici Le tournoi : 🏅 $stmt[Titre] 🏅 _____________ leur Cashprize : $stmt[Cashprize] _____________\n\n";
      } else {
         $this->Userid = false;
         return "\n\n _______ Le tournoi pas trouvée !!!!! _____\n\n";
      }
}

public function read(){
 $operation = "SELECT * FROM tournoi ";
         $resault = $this-> connection -> query($operation);
         $stmt = $resault -> fetch_all(MYSQLI_ASSOC);
            echo "\n id ______ Titre  ______ Cashprize _____ date \n\n";
         foreach ($stmt as $tournoi) {
            echo " $tournoi[id] ______ 🏅 $tournoi[Titre] 🏅 ______$tournoi[Cashprize] ______$tournoi[date]\n";
         }
}
public function delete(){
 if(($this -> Userid)==false){
        echo "\n\n _____ La suppression pas fait !!!!! _____\n\n";
        }
        else{
            $operation = "DELETE FROM tournoi WHERE id = '$this->Userid'";
           $this-> connection -> query($operation);
            echo "\n\n _____ La suppression est bien fait ✅✅ _____\n\n";
        }
}
}
$new_tournoi = new Tournoi($connection);
$test = true;
while ($test) {
 echo "\n==== GESTION DES TOURNOIS ==== \n";
    echo "1. ADD A TOURNOI \n" ;
    echo "2. EDIT A TOURNOI \n" ;
    echo "3. REMOVE A TOURNOI \n" ;
    echo "4. READ ALL TOURNOIS \n" ;
    echo "0. Exit \n";
     $choice = $console->input(" VOTRE CHOIX ");
   switch ($choice) {
      case '1':
         echo "1. WRITE THE NAME OF THE Tournoi  ";
         $name = $console->input("  ");
         echo "2. WRITE THE CASH OF THE Tournoi  ";
         $cash = $console->input("  ");
         echo "3. WRITE THE FORMAT OF THE Tournoi  ";
         $format = $console->input("  ");
         $new_tournoi->create($name, $cash, $format);
         echo "\n\n insertion avec succées\n\n";
         break;
      case '2':
         $name = $console->input("Entrer le nom de l'equipe que tu veux modifier ");
         echo $new_tournoi->search($name);
         if (($new_tournoi->Userid)) {
            $name = $console->input("Entrer le nouveaux nom ");
            $cash = $console->input("Entrer le nouveaux cash ");
            $format = $console->input("Entrer le nouveaux format ");
            echo $new_tournoi->update($name, $cash, $format);
         }
         break;
      case '3':
         $name = $console->input("Entrer le nom de le tournoi que tu veux supprimer ");
         echo $new_tournoi->search($name);
         echo $new_tournoi->delete();
         break;
      case '4':
         echo $new_tournoi->read();
         break;
      case '0':
         $test = false;
      default:
         break;
   }
}
