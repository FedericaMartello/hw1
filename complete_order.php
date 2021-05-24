<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "progetto");

$ordine = $_GET["o"];
$prodotto = $_GET["p"];
$quantita = $_GET["q"];

$query = "INSERT INTO carrello (ordine, prodotto, quantita) VALUES ('$ordine', '$prodotto', '$quantita')";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

?>