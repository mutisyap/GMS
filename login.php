<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 8/1/16
 * Time: 12:25 AM
 */
require_once "connect.php";
session_start();
if (isset($_POST['ID'])){
    $data = array();
    $ID=$_POST['ID'];
    $password1=$_POST['password'];
    $password1 = hash('sha256', $password1);

    $connection=connectDB();


    $sql="SELECT idNumber, name, role FROM Users WHERE idNumber='$ID' AND password='$password1'";

    $result = $connection->query($sql);

    if ($result == TRUE) {
        if ($result->num_rows ==1) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['idNumber'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            $role=$row['role'];
            if ($role=='Admin'){//admin
                header ("Location: admin.php");
            }else if($role=='User'){
                header ("Location: user.php");
            }else{
                header ("Location: index.html");
            }
        } else {
            die ("<script>alert ('Invalid Username or Password. Please Enter Details again'); window.location.assign('index.html');</script>");
        }
    } else {
        die ("<script>alert ('Server Error. Please contact administrator'); window.location.assign('index.html');</script>");
    }
}