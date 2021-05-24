<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "progetto");

$query = "SELECT * FROM prodotto";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

$foodArray = array();
while($food = mysqli_fetch_assoc($res))
{
    $foodArray[] = array('id' => $food['id_prodotto'], 'name' => $food['nome'], 'descr' => $food['descrizione'], 
                        'prezzo' => $food['prezzo']."€", 'image' => $food['foto']);
}
echo json_encode($foodArray);

exit;

?>





