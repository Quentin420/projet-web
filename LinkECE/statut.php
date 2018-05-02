
<?php
session_start();
header("location: accueil.php");

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
    $lieu = $mysqli->escape_string($_POST["lieu"]);
    $name = $mysqli->escape_string($_POST["statut"]);
    $humeur = isset($_POST["humeur"])?$_POST["humeur"]:"";
    $document = isset($_POST["monFichier"])?$_POST["monFichier"]:"";
    $sql="INSERT INTO post (id_user, document, visibilite, lieu, descriptif, humeur) 
        VALUES('$id_user', '$document', 1, '$lieu','$name', '$humeur')";

    if ($mysqli->query($sql) === TRUE) {
        echo "<script type='text/javascript'> document.location = 'accueil.php'; </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
?>