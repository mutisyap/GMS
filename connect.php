<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 6/14/16
 * Time: 11:16 AM
 */

function connectServer(){
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($serverName, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function connectDB($dbName = "Garage"){
    $serverName = "localhost";
    $username = "root";
    $password = "";


    $connection=new mysqli($serverName, $username, $password, $dbName);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}