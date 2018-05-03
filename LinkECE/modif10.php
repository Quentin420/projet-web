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
    //$id_session = $_SESSION['id_user'];

    $host = 'localhost';
    $user = 'root';
    $pass = 'root'; 
    $db = 'linkece';

    $id_user = $_SESSION['id_user'];
    $mysqli = new mysqli($host,$user,$pass,$db);
    $visibilite = $mysqli->escape_string($_POST["visibilite"]);

    $sql="UPDATE users SET active='$visibilite' WHERE id_user='$id_user'"; 
    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['active']=$visibilite;
        echo "<script type='text/javascript'> document.location = 'profil.php'; </script>";
    } 
    else{
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
?>



