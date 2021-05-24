<?php

    header('Content-Type: application/json');

    $conn = mysqli_connect("localhost", "root", "", "progetto");
    $username = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT username FROM cliente WHERE username = '$username'";
    $res = mysqli_query($conn, $query) or die (mysqli_error($conn));

    echo json_encode(array('username' => mysqli_num_rows($res)>0 ? "in_uso" : "non_in_uso"));

    mysqli_close($conn);
?>