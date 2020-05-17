<?php 
session_start();
include '../dbConnect.php';	
include("../dbClass.php");

$dbClass = new dbClass;	
extract($_POST);


$conditionArray= array(
    'id'=>$_POST['tran_id'],
);

$saveInfo = $dbClass->delete('payment_information',$conditionArray);

return 'success';

?>