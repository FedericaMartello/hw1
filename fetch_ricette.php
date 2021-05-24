<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');


$apikey = '6d93de76d1554878b8bea2be3c1b28ec';

$url = $_GET["url"];
$api_url = 'https://api.spoonacular.com/recipes/extract?url='.$url."&apiKey=".$apikey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$res=curl_exec($ch);
curl_close($ch);

$json = json_decode($res, true);

$newJson = array();
$newJson[] = array('nome' => $json['title'], 'foto' => $json['image'], 'ingredienti' => $json['extendedIngredients'], 'istruzioni' => $json['instructions']);


echo json_encode($newJson);

?>