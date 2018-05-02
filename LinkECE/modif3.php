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

    $id_user = $_SESSION['id_user'];
    
    $cv_path= mysqli_real_escape_string($con,'img/'.$_FILES['cv']['name']);
    
    if(preg_match("!application/pdf!",$_FILES['cv']['type']))
    {
        if(copy($_FILES['cv']['tmp_name'],$cv_path)){

            $_SESSION['cv']=$cv_path;
            
            $sql="UPDATE users SET cv='$cv_path' WHERE id_user='$id_user'"; 
            if (mysqli_query($con,$sql) === TRUE) {
                echo "New record created successfully";
                header("location: profil.php");
            } else {
                echo "Error: ";
            } 
        }
        else{
            $_SESSION['message']="File upload failed!";
        }
    }
    else{
        $_SESSION['message']="Please only upload PNG, SVG images!";
    }

    
}?>