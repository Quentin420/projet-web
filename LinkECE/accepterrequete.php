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

    //ID de l'utilisateur
    $id_session = $_SESSION['id_user'];
    if(isset($_GET['id_demandeur']))

    {
        //Id de l'utilisateur dont on regarde le profil
        $id_demandeur = $_GET['id_demandeur'];
        $id_requete = $_GET['id_requete'];
        //Infos sur l'utilisateur dont on regarde le profil
        $user = mysqli_query($con, "INSERT INTO relation (id_user1, id_user2) VALUES ('$id_session', '$id_demandeur');");
        $user2 = mysqli_query($con, "DELETE FROM `requeteami` WHERE `requeteami`.`id_requete` = '$id_requete'");
        echo "<script type='text/javascript'> document.location = 'reseau.php'; </script>";    
    }
}
?>