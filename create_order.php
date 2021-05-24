<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}


header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "progetto");
$user = mysqli_real_escape_string($conn, $_SESSION["username"]);
$queryC = "SELECT * FROM cliente WHERE username = '$user'";
$resC = mysqli_query($conn, $queryC) or die(mysqli_error($conn));
$cliente = mysqli_fetch_assoc($resC);

$id = mysqli_real_escape_string($conn, $cliente["id_cliente"]);

$d = $_GET["d"];
$t = $_GET["t"];

$error = array();

$data = mysqli_real_escape_string($conn, $d);
$ora = mysqli_real_escape_string($conn, $t);

if(strtotime($data)<=strtotime("today")){
    $error[]="Data non valida";
    echo "Data non valida";
}


if (strtotime($ora) <= strtotime("11:00:00") || strtotime($ora) >= strtotime("23:59:00")) {
    $error[]="Ora non valida";
}

if(count($error)==0)
{
    $query = "INSERT INTO ordine (cliente, totale, data, ora, stato, ora_consegna)
    VALUES ('$id', 0, '$data', '$ora', 'In consegna', null)";

    $res = mysqli_query($conn, $query);

    if(!$res)
    {
        echo "Non ho registrato l'ordine";
    }
}

$queryID = "SELECT id_ordine FROM ordine WHERE cliente = '$id' AND data = '$data' AND ora = '$ora' AND totale = 0";
$resID = mysqli_query($conn, $queryID) or die(mysqli_error($conn));

$ordine = array();
$info = mysqli_fetch_assoc($resID);

$ordine[] = array('id_ordine' => $info["id_ordine"]);

echo json_encode($ordine);

?>