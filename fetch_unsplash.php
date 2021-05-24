<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

$client_id = 'ioSxzr9ddsSbjVxWX890zuChICwr2xGurDtH43G_JOA';

$query = urlencode($_GET["type"]);
$url = 'https://api.unsplash.com/search/photos?per_page=12&orientation=landscape&client_id='.$client_id.'&query='.$query;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$res=curl_exec($ch);
curl_close($ch);

$json = json_decode($res, true);

$newJson = array();
for ($i = 0; $i < count($json['results']); $i++) {
    $newJson[] = array('id' => $json['results'][$i]['id'], 'image' => $json['results'][$i]['urls']['full']);
}

echo json_encode($newJson);

?>