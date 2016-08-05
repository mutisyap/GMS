<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 8/5/16
 * Time: 12:10 AM
 */

require_once "connect.php";
$connection=connectDB();
$vehicleID=$_POST['vehicleID'];
$sql="SELECT numberPlate FROM Vehicles WHERE vehicleID='$vehicleID'";
$result=$connection->query($sql);
if ($result->num_rows>0) {
    $row = $result->fetch_assoc();
    echo $row['numberPlate'];
}else{
    echo 1;
}