<?php
/* Displays user information and some useful messages */
session_start();
include('connect.php');

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: login-system/error.php");    
}

else{


    if(isset($_GET['id_requete']))

    {
        //Id de la requete a supprimer
        $id_requete = $_GET['id_requete'];
        //Infos sur l'utilisateur dont on regarde le profil
        $user = mysqli_query($con, "DELETE FROM `requeteami` WHERE `requeteami`.`id_requete` = '$id_requete'");
        echo "<script type='text/javascript'> document.location = 'reseau.php'; </script>";    
    }
}
?>