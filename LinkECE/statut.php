
<?php
header('Location: accueil.php');
session_start();

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
    $lieu = isset($_POST["lieu"])?$_POST["lieu"]:"";
    $name = isset($_POST["statut"])?$_POST["statut"]:"";
    $humeur = isset($_POST["humeur"])?$_POST["humeur"]:"";
    $sql="INSERT INTO post (id_user, visibilite, lieu, descriptif, humeur) 
        VALUES('$id_user', 1, '$lieu','$name', '$humeur')";

    if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}?>