/**
 * Created by pta on 8/4/16.
 */

$(document).ready(function(){
    $("#signUp").click(function (){
        $("#signUpDiv").show();
        $("#contentDiv").hide();
    });

    $("#content").click(function (){
        $("#signUpDiv").hide();
        $("#contentDiv").show();
    });
    $("#login").click(function (){
        $("#signUpDiv").hide();
        $("#contentDiv").show();
    });
    $("#viewCust").click(function (){
       $("#viewCustDiv").show();
        $("#registerCarDiv").hide();
        $("#invoiceDiv").hide();
        $("#clearInvoiceDiv").hide();
    });
    $("#registerCar").click(function (){
        $("#viewCustDiv").hide();
        $("#registerCarDiv").show();
        $("#invoiceDiv").hide();
        $("#clearInvoiceDiv").hide();
    });
    $("#clearInvoice").click(function (){
        $("#clearInvoiceDiv").show();
        $("#viewCustDiv").hide();
        $("#registerCarDiv").hide();
        $("#invoiceDiv").hide();
    });
    /*$("#createCar").click(function (){
        $("#viewCustDiv").hide();
        $("#invoiceDiv").hide();
    });*/
    $("#createInvoice").click(function (){
        $("#viewCustDiv").hide();
        $("#registerCarDiv").hide();
        $("#invoiceDiv").show();
        $("#clearInvoiceDiv").hide();
    });
});

function validatePassword(){
    var pwd1=document.forms["signUpForm"]['pwd'].value.trim();
    var pwd2=document.forms["signUpForm"]['pwd1'].value.trim();

    if(pwd1.length < 6){
        document.getElementById('pwdError').innerHTML="Password Too short";
    }else{
        if (pwd1!=pwd2){
            document.getElementById('pwdError').innerHTML="Passwords don't match";
        }else{
            document.getElementById('pwdError').innerHTML="<i class='glyphicon glyphicon-ok'></i>";
        }
    }
}

function validateStaffID(){
    var staffID=document.forms["signUpForm"]['staffID'].value.trim();
    if (staffID.length<3){
        document.getElementById('staffIDError').innerHTML="Enter a Valid Staff ID";
    }else{
        //let's check if staff ID exists in records
        var staffIdData=$("#signUpForm").serialize();
        var url="./staffIDExists.php";
        $.post(url, staffIdData, function (response){
            if (response==1){
                document.getElementById('staffIDError').innerHTML="Staff ID already associated with account";
            }else{
                document.getElementById('staffIDError').innerHTML="<i class='glyphicon glyphicon-ok'></i>";
            }
        });
    }
}
function getCustomer(){
    var custID=document.forms["addVehicle"]['custID'].value.trim();
    if (custID.length<3){
        document.getElementById('custIDLabel').innerHTML="ID too short";
        document.getElementById("registerCarBtn").disabled = true;
    }else{
        var data = {custID: custID};
        var url="getCustomer.php";
        $.post(url, data, function (response){
            if (response==1){
                document.getElementById('custIDLabel').innerHTML="Invalid ID";
                document.getElementById("registerCarBtn").disabled = true;
            }else if(response==2){
                document.getElementById('custIDLabel').innerHTML="User Not a customer";
                document.getElementById("registerCarBtn").disabled = true;
            }
            else
            {
                document.getElementById('custIDLabel').innerHTML=response;
                document.getElementById("registerCarBtn").disabled = false;
            }
        });
    }
}
function getVehicleID(){
    var vehicleID=document.forms["invoiceForm"]['vehicleID'].value.trim();
    if (vehicleID.length<4){
        document.getElementById('numberPlate1').innerHTML="Too Short";
        document.getElementById("invoiceBtn").disabled = true;
    }else{
        var data = {vehicleID: vehicleID};
        var url="getNumberPlate.php";
        $.post(url, data, function (response){
            if (response==1){
                document.getElementById('numberPlate1').innerHTML="Invalid vehicle ID";
                document.getElementById("invoiceBtn").disabled = true;
            }
            else
            {
                document.getElementById('numberPlate1').innerHTML=response;
                document.getElementById("invoiceBtn").disabled = false;
            }
        });
    }
}

function getVehicle(){
    var invoiceID=document.forms["clearInvoiceForm"]['invoiceID'].value.trim();
    if (invoiceID.length<4){
        document.getElementById('vehicleIDLabel').innerHTML="Too Short";
        document.getElementById("clearInvoiceBtn").disabled = true;
    }else{
        var data = {invoiceID: invoiceID};
        var url="getVehicleID.php";
        $.post(url, data, function (response){
            if (response==1){
                document.getElementById('vehicleIDLabel').innerHTML="Invalid invoice ID";
                document.getElementById("clearInvoiceBtn").disabled = true;
            }else if (response==2){
                document.getElementById('vehicleIDLabel').innerHTML="Invoice already cleared";
                document.getElementById("clearInvoiceBtn").disabled = true;
            }
            else
            {
                document.getElementById('vehicleIDLabel').innerHTML="Vehicle ID = "+response;
                document.getElementById("clearInvoiceBtn").disabled = false;
            }
        });
    }
}

/*
*  $.post(url, data, function(response){
 if (response==2){
 document.getElementById('approveStaffIDLabel').innerHTML="Staff Already Approved";
 document.getElementById("approveUserBtn").disabled = false;
 }else if (response==0){
 document.getElementById('approveStaffIDLabel').innerHTML="Invalid Staff ID";
 document.getElementById("approveUserBtn").disabled = false;
 }else{
 document.getElementById('approveStaffIDLabel').innerHTML=response;
 document.getElementById("approveUserBtn").disabled = false;
 }
 });
* */