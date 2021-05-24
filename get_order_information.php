<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}


$conn = mysqli_connect("localhost", "root", "", "progetto");


$ordine = $_GET["o"];

$queryTOT = "SELECT totale, data, ora, r.nome AS prodotto, prezzo, quantita, indirizzo FROM cliente c JOIN (ordine o JOIN riepilogo r ON o.id_ordine=r.ordine) ON c.id_cliente=o.cliente WHERE ordine='$ordine'";

$resTOT = mysqli_query($conn, $queryTOT) or die(mysqli_error($conn));

$TOT = array();

while($data = mysqli_fetch_assoc($resTOT))
{
    $TOT[] = array('tot' => $data["totale"], 'prodotto' => $data["prodotto"], 'n' => $data["quantita"], 'price' => $data["prezzo"],
                    'date' => $data["data"], 'time' => $data["ora"], 'address' => $data["indirizzo"]);
}

echo json_encode($TOT);

?>