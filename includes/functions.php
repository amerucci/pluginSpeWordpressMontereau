<?php

function redir($url) {
    echo '<script language="JavaScript">
          setTimeout("window.location=\''.$url.'\'"); 
          </script>';
  }


//On crée la connexion à la base de données
function connect() //fonction de connextion à la base
 {
     try
     {
     
        global $wpdb;
        $servername = $wpdb->dbhost;
        $username = $wpdb->dbuser;
        $password = $wpdb->dbpassword;
        $dbname = $wpdb->dbname;

         $bdd = new PDO('mysql:host='.$servername.';dbname='.$dbname.';port=3306;charset=utf8', $username, $password);
        return $bdd; 
     }
     catch(Exception $e)
     {
         die('Erreur : '.$e->getMessage());
     }
 }

 function delete(){
    $supprimer = connect()->prepare('DELETE From interventions WHERE id_int=:id');
    $supprimer->bindParam(':id', $_GET['id']);
    $supprimer->execute();
 }

 function update(){
    $modifier = connect()->prepare('UPDATE interventions SET date_int = :date, step_int=:etage, name_int=:intervention WHERE id_int = :id');
    $modifier->bindParam(':date', $_GET['date']);
    $modifier->bindParam(':etage', $_GET['etage']);
    $modifier->bindParam(':intervention', $_GET['intervention']);
    $modifier->bindParam(':id', $_GET['id']);
    $modifier->execute();
 }

 function add(){
      //On prépare notre requete d'insertion
    $ajouter = connect()->prepare('INSERT INTO footscore ( day, tdom, text, sdom, sext) VALUES (:day, :tdom, :text, :sdom, :sext )'); //ON prépare la requete
    $ajouter->bindParam(':day', $_GET['journee']); //On associe nos paramètre aux champs envoyés par le formulaire
    $ajouter->bindParam(':tdom', $_GET['tdom']);//On associe nos paramètre aux champs envoyés par le formulaire
    $ajouter->bindParam(':text', $_GET['text']);//On associe nos paramètre aux champs envoyés par le formulaire
    $ajouter->bindParam(':sdom', $_GET['sdom']);//On associe nos paramètre aux champs envoyés par le formulaire
    $ajouter->bindParam(':sext', $_GET['sext']);//On associe nos paramètre aux champs envoyés par le formulaire
    $ajouter->execute(); //On exécute la requête
    redir('admin.php?page=footscore%2Fincludes%2Fplugin_page.php&addmatch&journee='.$_GET['journee']);
 }

function all(){
    $resultat = connect()->prepare('SELECT * FROM footscore WHERE day = :day');
    $resultat->bindParam(':day', $_GET['journee']);
    $resultat->execute();
    $resultats = $resultat->fetchAll(); //On lui demande de nous retourner dans la variable $int le résultat de notre 
 
    return $resultats;
}

function pointByTeam($team){
    $point = connect()->prepare('SELECT * FROM footscore WHERE tdom = "'.$team.'" OR text = "'.$team.'"');
    // $point->debugDumpParams();
    $point->execute();
    $point = $point->fetchAll(); //On lui demande de nous retourner dans la variable $int le résultat de notre 
    return $point;
}