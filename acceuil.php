<?php
require_once "console.php" ;
require_once "config.php";
while (true) {
    echo "\n";
    echo "==== USER CRUD GIGALE ==== \n";
    echo "1. Gestion des clubs \n" ;
    echo "2. Gestion des equipes \n" ;
    echo "3. Gestion des joueurs \n" ;
    echo "4. Gestion des matches \n" ;
    echo "5. Gestion de tournois \n" ;
    echo "6. Gestion des sponsors \n" ;
    echo "0. Exit \n";
    $console = new Console();

    $choix = $console->input("Entre votre choix");
    switch ($choix) {
        case '1':
    include "club.php";
            break;
            case '2':
    include "equipe.php";
            break;
            case '3':
    include "joueur.php";
            break;
            case '4':
    include "matches.php";
            break;
            case '5':
    include "tournoi.php";
            break;
            case '6':
    include "sponsors.php";
            break;
        default:
            break;
    }
}
