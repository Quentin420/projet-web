<?php
    include('connect.php');

   
    if(isset($_GET['search_word']))
    {

        $search_word=$_GET['search_word'];
        $search_word_new=mysqli_real_escape_string($con, $search_word);
        $search_word_fix=str_replace(" ","%",$search_word_new);
        $sql=mysqli_query($con,"SELECT * FROM emploi WHERE (entreprise LIKE '%$search_word_fix%') OR (type_offre LIKE '%$search_word_fix%')ORDER BY id_emploi DESC LIMIT 10");
        $count=mysqli_num_rows($sql);
        if($count > 0)
        {
            while($row=mysqli_fetch_array($sql))
            {
            
                $msg=$row['id_emploi'];
                $emploi = mysqli_query($con, "SELECT * FROM `emploi` WHERE id_emploi='$msg'");
                $emploi_fetch = mysqli_fetch_assoc($emploi);
                $emploi_entreprise = $emploi_fetch['entreprise'];
                $emploi_type_offre = $emploi_fetch['type_offre'];
                $emploi_date = $emploi_fetch['date_emploi'];
                $emploi_intitule = $emploi_fetch['intitule_offre'];
                //display the message
                echo "
                            <div class='result'>
                                <div class='text-con'>
                                    <br/>
                                    <p> Mise en ligne le : {$emploi_date} </p>
                                    <p> Entreprise : {$emploi_entreprise} Type : {$emploi_type_offre}</p>
                                    <p> Intitulé de l'offre : {$emploi_intitule} </p>
                                    <a href='viewemploi.php?id_emploi=".$msg."'>Voir l'offre</a>
                                    <br/>
                                    <br/>
                                </div>
                            </div>
                            <hr>";
            }
            }
            else
            {
                echo "<li>Pas de résultats</li>";
            }
    }
?>