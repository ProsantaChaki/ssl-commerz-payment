<?php 
session_start();
include '../dbConnect.php';	
include("../dbClass.php");

$dbClass = new dbClass;	
extract($_POST);

$columValue = array(
    'ssl_payment_id'=>$_POST['val_id'],
    'card_type'=>$_POST['card_type'],
    'card_no'=>$_POST['card_no'],
    'status'=>1,
    'payment_date'=>$_POST['tran_date'],
);

$conditionArray= array(
    'id'=>$_POST['tran_id'],
);

$saveInfo = $dbClass->update('payment_information',$columValue,$conditionArray);

return 'success';

?>