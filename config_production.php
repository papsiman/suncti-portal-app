<?php 
    //Database
    $servername = "localhost";
    $username = "root";
    $password = "P0r@dmin!23$";
    $dbname = "sunctidb";
    $port = 3307;

    //Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

    //Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //Url
    $monitoringUrl = '../../operator/operator/index.html';

?>