<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");    
}
else {
    // Makes it easier to read
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Bienvenue sur LinkECE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">

           $(function()
           {
            $(".search_button").click(function()
            {
                var search_word = $("#search_box").val();
                var dataString = 'search_word='+search_word;

                if (search_word=='')
                {

                }

                else
                {
                    $.ajax({
                        type: "GET",
                        url: "searchingdata.php",
                        data: dataString,
                        cache: false,
                        beforeSend: function(html)
                        {

                            document.getElementById("insert_search").innerHTML='';
                            $("#flash").show();
                            $("#searchword").show();
                            $("#flash").html('> Loading Results');

                        },

                        error: function(html){
                         alert('error');
                         },   

                        success: function(html){
                            $("#insert_search").show();
                            $("#insert_search").append(html);
                            $("#flash").hide();
                            
                        }
                    });

                }
                return false;
            });
            });


        
        </script>


        <style>    
            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }
            
            #l{color: #4286f2}
            #i{color: #e94333}
            #n{color: #fdbe07}
            #k{color: #31aa52}
            #e1{color: #4086f2}
            #c{color: #e94434}
            #e2{color: #4286f2}
        </style>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <style>.navbar-brand {font-weight: bold;}</style>
                    <a class="navbar-brand" href="accueil.php">LinkECE</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="accueil.php"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                        <li><a href="reseau.php"><span class="glyphicon glyphicon-globe"></span> Réseau</a></li>
                        <li><a href="messagerie.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                        <li><a href="emplois.php"><span class="glyphicon glyphicon-search"></span> Emplois</a></li>
                        <li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                    </ul>


                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span> Mon profil</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center">   
        
        <div style="width:500px; margin:0 auto; margin-top:100px; background:#FFFFFF; padding:20px;">
            <h1><span id="l">L</span><span id="i">i</span><span id="n">n</span><span id="k">k</span><span id="e1">E</span><span id="c">C</span><span id="e2">E</span></h1>
            <form method="get" action="">
               <input type="text" autocomplete=off name="search" id="search_box" class='search_box'/>
               <input type="submit" value="Search" class="search_button" />
            </form>
            <br  />
            <div id="searchword">
            Search results for <b><span class="searchword"></span></b></div>
            <div id="flash"></div>
            <ol id="insert_search" class="update" style="color:#990000;">
            
            </ol>
        </div>

            
        </div>
    </body>
</html>

