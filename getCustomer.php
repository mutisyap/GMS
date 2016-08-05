<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 8/4/16
 * Time: 4:41 PM
 */
require_once "connect.php";
$connection=connectDB();
$idNumber=$_POST['custID'];
$sql="SELECT name, role FROM Users WHERE idNumber='$idNumber'";
$result=$connection->query($sql);
if ($result->num_rows>0) {
    $row = $result->fetch_assoc();
    $name=$row['name'];
    if ($row['role']=='User'){
        echo $name;
    }else{
        echo 2;
    }

}else{
    echo 1;
}