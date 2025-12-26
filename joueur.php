<?php
require_once "console.php";
class Joueur
{
   public object $connection;
   public string $Userid;
   public function __construct($connect)
   {
      $this->connection = $connect;
   }
   public function create($name, $role, $jeu, $salaire, $equipe_id)
   { 
         $insertion = "INSERT INTO joueur(Pseudo,Rôle,jeu,salaire,equipe_id)VALUES('$name','$role','$jeu','$salaire','$equipe_id');";
         $this->connection->query($insertion);
      
   }
   public function search($name)
   {
      $operation = "SELECT * FROM joueur WHERE Pseudo = '$name'";
      $resault = $this->connection->query($operation);
      $stmt =  mysqli_fetch_assoc($resault);
      if ($stmt) {
         $this->Userid = $stmt['id'];
         return "\n\n____________ Voici Le joueur : $stmt[Pseudo] _____________ leur Rôle : $stmt[Rôle] _____________\n\n";
      } else {
         $this->Userid = false;
         return "\n\n _______ Le joueur pas trouvée !!!!! _____\n\n";
      }
   }
   public function update($name, $role, $jeu, $salaire, $equipe_id)
   {
      $operation = "UPDATE joueur  
         SET Pseudo = '$name' ,
          Rôle = '$role' ,
           Jeu = '$jeu' ,
           salaire ='$salaire',
           equipe_id = '$equipe_id' 
            WHERE id = $this->Userid";
      $this->connection->query($operation);
      return "\n\nL'operation bien fait\n\n";
   }
   public function read() {
       $operation = "SELECT * FROM joueur ";
         $resault = $this-> connection -> query($operation);
         $stmt = $resault -> fetch_all(MYSQLI_ASSOC);
            echo "\n id ______ name  ______ Role _____ game \n\n";
         foreach ($stmt as $joueur) {
            echo " $joueur[id] ______ $joueur[Pseudo] ______$joueur[Rôle] ______$joueur[Jeu]\n";
         }
   }
   public function delete() {
       if(($this -> Userid)==false){
        echo "\n\n _____ La suppression pas fait !!!!! _____\n\n";
        }
        else{
            $operation = "DELETE FROM joueur WHERE id = '$this->Userid'";
           $this-> connection -> query($operation);
            echo "\n\n _____ La suppression est bien fait ✅✅ _____\n\n";
        }
   }
}
$new_joueur = new Joueur($connection);
$test = true;
while ($test) {
   echo "\n==== GESTION DES JOUEURS ==== \n";
   echo "1. ADD A JOUEUR \n";
   echo "2. EDIT A JOUEUR \n";
   echo "3. REMOVE A JOUEUR \n";
   echo "4. READ ALL JOUEURS \n";
   echo "0. Exit \n";
   $choice = $console->input(" VOTRE CHOIX ");
   switch ($choice) {
      case '1':
         echo "1. WRITE THE NAME OF THE GAMER  ";
         $name = $console->input("  ");
         echo "2. WRITE THE ROLE OF THE GAMER  ";
         $role = $console->input("  ");
         echo "3. WRITE THE GAME OF THE GAMER  ";
         $jeu = $console->input("  ");
         echo "4. WRITE THE SALARY OF THE GAMER  ";
         $salaire = $console->input("  ");
         echo "5. WRITE THE ID OF THERE TEAM  ";
         $equipe_id = $console->input("  ");
         $new_joueur->create($name, $role, $jeu, $salaire, $equipe_id);
         echo "\n\n insertion avec succées\n\n";
         break;
      case '2':
         $name = $console->input("Entrer le nom de l'equipe que tu veux modifier ");
         echo $new_joueur->search($name);
         if (($new_joueur->Userid)) {
            $name = $console->input("Entrer le nouveaux nom ");
            $jeu = $console->input("Entrer le nouveaux jeu ");
            $role = $console->input("Entrer le nouveaux role ");
            $salaire = $console->input("Entrer le nouveaux salaire ");
            $equipe_id = $console->input("Entrer le nouveaux equipe_id ");
            echo $new_joueur->update($name, $role, $jeu, $salaire, $equipe_id);
         }
         break;
      case '3':
         $name = $console->input("Entrer le nom de de le joueur que tu veux supprimer ");
         echo $new_joueur->search($name);
         echo $new_joueur->delete();
         break;
      case '4':
         echo $new_joueur->read();
         break;
      case '0':
         $test = false;
      default:
         break;
   }
}
