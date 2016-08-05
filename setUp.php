<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 6/14/16
 * Time: 12:15 PM
 */
//require_once "connect.php";

//create database Crimes
require_once "connect.php";
$connection=connectServer();
/*
$dbSql="CREATE DATABASE Garage";
if ($connection->query($dbSql) === TRUE){
    echo "database created successfully<br>";
}else{
    echo "Database creation Error ".$connection->error;
    die();
}
$connection->close();
*/
//Creating tables
$conn=connectDB();

$usersSql="CREATE TABLE Users(
idNumber INT (10) PRIMARY KEY,
name VARCHAR (50) NOT NULL,
password VARCHAR (64) NOT NULL,
role VARCHAR (10) NOT NULL,
confirmed VARCHAR (10) DEFAULT 'FALSE',
profilePic VARCHAR (20)
)";
if ($conn->query($usersSql) === TRUE) {
    echo "Table Users created successfully<br>";
} else {
    echo "Error creating table Users: " . $conn->error;
}


$vehicleSql="CREATE TABLE Vehicles(
vehicleID VARCHAR (6)  PRIMARY KEY,
numberPlate VARCHAR (10) NOT NULL,
problem VARCHAR (2000) NOT NULL,
description VARCHAR (50) NOT NULL,
custID INT (6) NOT NULL
)";
if ($conn->query($vehicleSql) === TRUE) {
    echo "Table Vehicles created successfully<br>";
} else {
    echo "Error creating table vehicles: " . $conn->error;
}


$invoiceTable="CREATE TABLE Invoice (
invoiceID VARCHAR  (6) PRIMARY KEY,
vehicleID VARCHAR (20) UNIQUE NOT NULL,
amount INT (20) NOT NULL,
deadline VARCHAR (20),
paid VARCHAR (10) DEFAULT 'FALSE'
)";

if ($conn->query($invoiceTable) === TRUE) {
    echo "Table invoice created successfully<br>";
} else {
    echo "Error creating table Invoices: " . $conn->error;
}
$conn->close();
