<?php
    include('connect.php');
   
    if(isset($_GET['search_word']))
    {

        $search_word=$_GET['search_word'];
        $search_word_new=mysqli_real_escape_string($con, $search_word);
        $search_word_fix=str_replace(" ","%",$search_word_new);
        $sql=mysqli_query($con,"SELECT * FROM users WHERE nom LIKE '%$search_word_fix%' ORDER BY id_user DESC LIMIT 10");
        $count=mysqli_num_rows($sql);
        if($count > 0)
        {
            while($row=mysqli_fetch_array($sql))
            {
            
                $msg=$row['id_user'];
                $user = mysqli_query($con, "SELECT nom, prenom, avatar FROM `users` WHERE id_user='$msg'");
                $user_fetch = mysqli_fetch_assoc($user);
                $user_form_nom = $user_fetch['nom'];
                $user_form_prenom = $user_fetch['prenom'];
                $user_form_img = $user_fetch['avatar'];
 
                //display the message
                echo "
                            <div class='result'>
                                <div class='img-con'>
                                    <img src='../{$user_form_img}'>
                                </div>
                                <div class='text-con'>
                                    <p> {$user_form_nom} {$user_form_prenom}</p>
                                    <a href='#''>Voir profil</a>
                                </div>
                            </div>
                            <hr>";
            }
            }
            else
            {
                echo "<li>No Results</li>";
            }
    }
?>