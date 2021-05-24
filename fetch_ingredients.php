<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "progetto");

$query = "SELECT * FROM ingrediente";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

$IngredientsArray = array();
while($ingredient = mysqli_fetch_assoc($res))
{
    $IngredientsArray[] = array('id' => $ingredient['id_ingrediente'], 'name' => $ingredient['nome']);
}
echo json_encode($IngredientsArray);

exit;

?>





