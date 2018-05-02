<?php
session_start();
include('connect.php');

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");    
}
else {
    // Makes it easier to read
    $host = 'localhost';
    $user = 'root';
    $pass = 'root'; 
    $db = 'linkece';

    $id_user = $_SESSION['id_user'];
    $mysqli = new mysqli($host,$user,$pass,$db);
    $resume = $mysqli->escape_string($_POST["resume"]);
    
    $sql="UPDATE users SET resume='$resume' WHERE id_user='$id_user'"; 
    if ($mysqli->query($sql) === TRUE) {
        echo "<script type='text/javascript'> document.location = 'profil.php'; </script>";
    } 
    else{
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }    
}
?>