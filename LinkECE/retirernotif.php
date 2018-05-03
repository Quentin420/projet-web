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
    if(isset($_GET['id_notification']))
    {
        //Id de l'utilisateur dont on regarde le profil
        $idnotif = $_GET['id_notification'];
        
        //Infos sur l'utilisateur dont on regarde le profil
        $req = mysqli_query($con,"DELETE FROM notification WHERE id_notification = '$idnotif'");
        echo "<script type='text/javascript'> document.location = 'notifications.php'; </script>";
    }
}
?>