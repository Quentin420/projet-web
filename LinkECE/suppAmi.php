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
    if(isset($_GET['id_user']))

    {
        //Id de l'utilisateur dont on regarde le profil
        $idviewed = $_GET['id_user'];
        
        //Infos sur l'utilisateur dont on regarde le profil
        $user = mysqli_query($con, "DELETE FROM relation WHERE (id_user1 = '$idviewed' AND id_user2='$id_session' )OR (id_user2 = '$idviewed' AND id_user1='$id_session' )");
        echo "<script type='text/javascript'> document.location = 'reseau.php?id_user=".id_session."'; </script>";    
    }
}
?>