<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 8/1/16
 * Time: 12:02 AM
 */
if (isset($_POST['idNo'])){
    $firstName=trim($_POST['firstName']);
    $middleName=trim($_POST['middleName']);
    $surname=trim($_POST['surname']);
    $idNo=trim($_POST['idNo']);
    $password=trim($_POST['pwd']);
    $password2=trim($_POST['pwd1']);

    $fullName="";
    $role='Admin';
    if ($password!=$password2){
        echo ("<script>alert('Passwords Must Match'); window.location.assign('index.html');</script>");
        die();
    }
    if ($middleName=="" || $middleName=NULL){
        $fullName=$firstName." ".$surname;
    }else{
        $fullName=$firstName." ".$middleName." ".$surname;
    }
    $password = hash('sha256', $password);


    require_once "connect.php";

    $connection=connectDB();

    $signUpSql="INSERT INTO `Users`(`idNumber`, `name`, `password`, `role`) VALUES ('$idNo','$fullName','$password','$role')";
    if ($connection->query($signUpSql) == TRUE) {
        echo "<script>alert('Successfully Created Account   Please proceed to log in'); window.location.assign('index.html');</script>";
    } else {
        echo "<script>alert('Error creating Account  Please try again'); window.location.assign('index.html');</script>";
    }

}