<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['nom'] = $_POST['nom'];
$_SESSION['prenom'] = $_POST['prenom'];
$_SESSION['username'] = $_POST['username'];



// Escape all $_POST variables to protect against SQL injections
$nom = $mysqli->escape_string($_POST['nom']);
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
    $sql = "INSERT INTO users (email, username, prenom, nom, password, hash, active) VALUES ('$email', '$username', '$prenom','$nom','$password', '$hash', 1)";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                
                 "Un e-mail de confirmation a été envoyé à $email, merci de vérifier votre compte en cliquant sur le lien contenu dans le mail!";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Vérification du compte ( linkece.com )';
        $message_body = '
        Bonjour '.$prenom.',

        Votre inscription est presque terminée !

        Veuillez cliquer sur le lien suivant pour vérifier votre compte:

        http://localhost/login-system/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );

        header("location: profile.php"); 

    }

    else {
        $_SESSION['message'] = 'Erreur lors de votre inscription!';
        header("location: error.php");
    }

}