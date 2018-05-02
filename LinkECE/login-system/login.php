<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "Cet utilisateur n'existe pas !";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['active'] = $user['active'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['promotion'] = $user['promotion'];
        $_SESSION['adresse'] = $user['adresse'];
        $_SESSION['avatar'] = $user['avatar'];
        $_SESSION['resume'] = $user['resume'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: ../accueil.php");
    }
    else {
        $_SESSION['message'] = "Mauvais mot de passe, reessayez !";
        header("location: error.php");
    }
}

