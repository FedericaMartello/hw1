<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

$count = $_GET["count"];

switch($count)
{
    case 1 : One(); break;
    case 2 : Two(); break;
    case 3 : Three(); break;
    default: break;
}

function One()
{
    $conn = mysqli_connect("localhost", "root", "", "progetto");
    $ingr = $_GET["i1"];
    $query = "SELECT * FROM prodotto WHERE id_prodotto IN
    (SELECT prodotto FROM contiene WHERE ingrediente='$ingr')";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $products=array();
    while($product = mysqli_fetch_assoc($res))
    {
        $products[] = array('id' => $product['id_prodotto'], 'image' => $product['foto'], 'nome' => $product['nome'], 
        'prezzo' => $product['prezzo']."€");
    }
    echo json_encode($products);
}

function Two()
{
    $conn = mysqli_connect("localhost", "root", "", "progetto");
    $ingr1 = $_GET["i1"];
    $ingr2 = $_GET["i2"];
    $query = "SELECT * FROM prodotto WHERE id_prodotto IN
    (SELECT prodotto FROM contiene WHERE ingrediente='$ingr1')
    AND id_prodotto IN (SELECT prodotto FROM contiene WHERE ingrediente='$ingr2')";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $products=array();
    while($product = mysqli_fetch_assoc($res))
    {
        $products[] = array('id' => $product['id_prodotto'], 'image' => $product['foto'], 'nome' => $product['nome'], 
        'prezzo' => $product['prezzo']."€");
    }
    echo json_encode($products);
}

function Three()
{
    $conn = mysqli_connect("localhost", "root", "", "progetto");
    $ingr1 = $_GET["i1"];
    $ingr2 = $_GET["i2"];
    $ingr3 = $_GET["i3"];

    $query = "SELECT * FROM prodotto WHERE id_prodotto IN
    (SELECT prodotto FROM contiene WHERE ingrediente='$ingr1')
    AND id_prodotto IN (SELECT prodotto FROM contiene WHERE ingrediente='$ingr2')
    AND id_prodotto IN (SELECT prodotto FROM contiene WHERE ingrediente='$ingr3')";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $products=array();
    while($product = mysqli_fetch_assoc($res))
    {
        $products[] = array('id' => $product['id_prodotto'], 'image' => $product['foto'], 'nome' => $product['nome'], 
        'prezzo' => $product['prezzo']."€");
    }
    echo json_encode($products);
}

?>