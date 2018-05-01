<?
$host = 'localhost';
$user = 'root';
$pass = 'root'; 
$db = 'linkece';

$id_user = $_SESSION['id_user'];
$mysqli = new mysqli($host,$user,$pass,$db);
$name = isset($_POST["statut"])?$_POST["statut"]:"";
$sql="INSERT INTO post (id_user, descriptif) 
        VALUES('$id_user','$name')";
        $result = mysqli_query($db_handle, $sql);

?>