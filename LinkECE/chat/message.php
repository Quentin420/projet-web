<?php
/* Displays user information and some useful messages */
require_once("connect.php");
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
     $_SESSION['message'] = "You must log in before viewing your message page!";
     header("location: ../login-system/error.php");    
}
else {
    // Makes it easier to read
    $user_id = $_SESSION['id_user'];   
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <center>
        <strong>Bonjour <?php echo $_SESSION['prenom']; ?></strong>
    </center>
     
    <div class="message-body">
        <div class="message-left">
            <ul>
                <?php
                    //show all the users expect me
                    $q = mysqli_query($con, "SELECT * FROM `users` WHERE id_user!='$user_id'");
                    //display all the results
                    while($row = mysqli_fetch_assoc($q)){
                        echo "<a href='message.php?id_user={$row['id_user']}'><li><img src='../../{$row['avatar']}'> {$row['nom']} {$row['prenom']}</li></a>";
                    }
                ?>
            </ul>
        </div>
 
        <div class="message-right">
            <!-- display message -->
            <div class="display-message">
            <?php
                //check $_GET&#91;'id'&#93; is set
                if(isset($_GET['id_user'])){
                    $user_two = trim(mysqli_real_escape_string($con, $_GET['id_user']));
                    //check $user_two is valid
                    $q = mysqli_query($con, "SELECT `id_user` FROM `users` WHERE id_user='$user_two' AND id_user!='$user_id'");

                    //valid $user_two
                    if(mysqli_num_rows($q) == 1){
                        //check $user_id and $user_two has conversation or not if no start one
                        $conver = mysqli_query($con, "SELECT * FROM `conversation` WHERE (user_one='$user_id' AND user_two='$user_two') OR (user_one='$user_two' AND user_two='$user_id')");
 
                        //they have a conversation
                        if(mysqli_num_rows($conver) == 1){
                            //fetch the converstaion id
                            $fetch = mysqli_fetch_assoc($conver);
                            $conversation_id = $fetch['id'];
                        }else{ //they do not have a conversation
                            //start a new converstaion and fetch its id
                            $q = mysqli_query($con, "INSERT INTO `conversation` VALUES ('','$user_id',$user_two)");
                            $conversation_id = mysqli_insert_id($con);        
                        }
                    }
                    else
                    {
                        die("Invalid $_GET ID.");
                    }
                }else 
                {
                    die("Click On the Person to start Chating.");
                }
            ?>
            </div>
            <!-- /display message -->
 
            <!-- send message -->
            <div class="send-message">
                <!-- store conversation_id, user_from, user_to so that we can send send this values to post_message_ajax.php -->
                <input type="hidden" id="conversation_id" value="<?php echo base64_encode($conversation_id); ?>">
                <input type="hidden" id="user_form" value="<?php echo base64_encode($user_id); ?>">
                <input type="hidden" id="user_to" value="<?php echo base64_encode($user_two); ?>">
                <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Enter Your Message"></textarea>
                </div>
                <button class="btn btn-primary" id="reply">Reply</button> 
                <span id="error"></span>
            </div>
            <!-- / send message -->
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script> 
</body>
</html>