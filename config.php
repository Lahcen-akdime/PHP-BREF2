<?php
class Connect{
     public $dbname = "gigaleague";
     public $password = "";
     public $host = "localhost";
     public $username = "root";
     public function connect(){
       return  mysqli_connect($this ->host,$this ->username,$this ->password,$this ->dbname,3307);
     }
}
$myobject = new Connect ;
$connection = $myobject ->  connect() ;
