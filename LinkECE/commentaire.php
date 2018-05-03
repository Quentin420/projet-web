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
    if(isset($_GET['id_post']))
    {
         $n_post = $_GET['id_post'];
         //$n_post=$_SESSION['id_post'];
         $mysqli = new mysqli($host,$user,$pass,$db);
         $commentaire = $mysqli->escape_string($_POST["commentaire"]);
        
         $text = "Nouveau commentaire";
         $req= mysqli_query($con, "INSERT INTO notification (id_post, label, id_user) VALUES ('$n_post', '$text', '$id_session')");
         $sql="INSERT INTO commentaire (id_user, id_post, commenatire) VALUES ('$id_user', '$n_post', '$commentaire')"; 
         if ($mysqli->query($sql) === TRUE) {
            //$_SESSION['promotion']=$promotion;
            echo "<script type='text/javascript'> document.location = 'accueil.php'; </script>";
         } 
        else{
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } 
}
?>