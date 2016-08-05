<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 8/5/16
 * Time: 12:41 AM
 */

require_once "connect.php";
$connection=connectDB();
$invoiceID=$_POST['invoiceID'];
$sql="SELECT * FROM Invoice WHERE invoiceID='$invoiceID'";
$result=$connection->query($sql);
if ($result->num_rows>0) {
    $row = $result->fetch_assoc();
    if ($row['paid']=='TRUE'){
        echo 2;
    }else{
        echo $row['vehicleID'];
    }
}else{
    echo 1;
}