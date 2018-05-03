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

    //$id_user = $_SESSION['id_user'];
    $mysqli = new mysqli($host,$user,$pass,$db);
    
    
    
    
    // Escape all $_POST variables to protect against SQL injections
    $admin = $mysqli->real_escape_string($_POST['admin']);
    $nom = $mysqli->real_escape_string($_POST['nom']);
    $prenom = $mysqli->escape_string($_POST['prenom']);
    $email = $mysqli->escape_string($_POST['email']);
    $username = $mysqli->escape_string($_POST['username']);
    $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $hash = $mysqli->escape_string( md5( rand(0,1000) ) );
      
    // Check if user with that email already exists
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

    // We know user email exists if the rows returned are more than 0
    if ( $result->num_rows > 0 ) {
    
        $_SESSION['message'] = 'Cette adresse est déjà utilisée !';
        header("location: error.php");
    
    }
    else { // Email doesn't already exist in a database, proceed...

        // active is 0 by DEFAULT (no need to include it here)
        $sql = "INSERT INTO users (admin, email, username, prenom, nom, password, hash, active) VALUES ('$admin', '$email', '$username', '$prenom','$nom','$password', '$hash', 1)";

        // Add user to the database
        if ( $mysqli->query($sql) ){

            $_SESSION['message']="Utilisateur crée avec succès!";
 
            header("location: admin.php"); 

        }

        else {
            $_SESSION['message'] = 'Erreur pour ajouter un nouvel utilisateur!';
        }

    }   
    
}
?>


