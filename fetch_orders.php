<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

switch($_GET["type"])
{
    case "all" : AllOrders(); break;
    case "delivered" : Delivered(); break;
    case "delivering" : Delivering(); break;
    default: break;
}


function AllOrders()
{
    $conn = mysqli_connect("localhost", "root", "", "progetto");
    $user = mysqli_real_escape_string($conn, $_SESSION["username"]);

    $queryC = "SELECT * FROM cliente WHERE username = '$user'";
    $resC = mysqli_query($conn, $queryC) or die(mysqli_error($conn));
    $cliente = mysqli_fetch_assoc($resC);
    $id = mysqli_real_escape_string($conn, $cliente["id_cliente"]);

    $query = "SELECT totale, data, ora, stato, ora_consegna FROM ordine WHERE cliente = '$id'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $OrdersArray = array();
    while($orders = mysqli_fetch_assoc($res))
    {
        $OrdersArray[] = array('tot' => $orders['totale']."€", 'date' => $orders['data'], 'time' => $orders['ora'], 
                            'type' => $orders['stato'], 'delivered' => $orders['ora_consegna']);
    }
    echo json_encode($OrdersArray);
}


function Delivered()
{
    $conn = mysqli_connect("localhost", "root", "", "progetto");
    $user = mysqli_real_escape_string($conn, $_SESSION["username"]);

    $queryC = "SELECT * FROM cliente WHERE username = '$user'";
    $resC = mysqli_query($conn, $queryC) or die(mysqli_error($conn));
    $cliente = mysqli_fetch_assoc($resC);
    $id = mysqli_real_escape_string($conn, $cliente["id_cliente"]);

    $query = "SELECT totale, data, ora, stato, ora_consegna FROM ordine WHERE cliente = '$id' AND stato = 'Consegnato' ";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $OrdersArray = array();
    while($orders = mysqli_fetch_assoc($res))
    {
        $OrdersArray[] = array('tot' => $orders['totale']."€", 'date' => $orders['data'], 'time' => $orders['ora'], 
                            'type' => $orders['stato'], 'delivered' => $orders['ora_consegna']);
    }
    echo json_encode($OrdersArray);
}


function Delivering()
{
    $conn = mysqli_connect("localhost", "root", "", "progetto");
    $user = mysqli_real_escape_string($conn, $_SESSION["username"]);

    $queryC = "SELECT * FROM cliente WHERE username = '$user'";
    $resC = mysqli_query($conn, $queryC) or die(mysqli_error($conn));
    $cliente = mysqli_fetch_assoc($resC);
    $id = mysqli_real_escape_string($conn, $cliente["id_cliente"]);

    $query = "SELECT totale, data, ora, stato, ora_consegna FROM ordine WHERE cliente = '$id' AND stato = 'In consegna' ";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $OrdersArray = array();
    while($orders = mysqli_fetch_assoc($res))
    {
        $OrdersArray[] = array('tot' => $orders['totale']."€", 'date' => $orders['data'], 'time' => $orders['ora'], 
                            'type' => $orders['stato'], 'delivered' => $orders['ora_consegna']);
    }
    echo json_encode($OrdersArray);
}

?>