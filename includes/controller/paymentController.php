<?php
session_start();
include '../dbConnect.php';
include("../dbClass.php");

$dbClass = new dbClass;
extract($_POST);

    $paymentSettings = $dbClass->getSingleRow("SELECT * FROM payment_setup WHERE(id = 1)");

    $mobile = isset($_POST['mobile'])? $_POST['mobile']:'';
    $email = isset($_POST['email'])? $_POST['email']:'';

    $columValue = array(
        'user_identification'=>$_POST['u_id'],
        'user_name'=>$_POST['name'],
        'user_mobile'=>$mobile,
        'user_email'=>$email,
        'amount'=>$_POST['amount'],
    );
    $payerId=$dbClass->insert('payment_information',$columValue);

//echo 1; die;
    //$date = new date();
    $post_data = array();
    $post_data['store_id'] = $paymentSettings['store_id'];
    $post_data['store_passwd'] = $paymentSettings['store_password'];
    $post_data['total_amount'] = $_POST['amount'];
    $post_data['currency'] = "BDT";
    $post_data['tran_id'] = $payerId;
    $post_data['success_url'] = "http://prosantachaki.com/payment/success.php";
    $post_data['fail_url'] = "http://prosantachaki.com/payment/fail.php";
    $post_data['cancel_url'] = "http://prosantachaki.com/payment";
# $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

# EMI INFO


# CUSTOMER INFORMATION
    $post_data['cus_name'] = $_POST['name'];
    $post_data['cus_email'] = $email;
    $post_data['cus_add1'] = "Dhaka";
    $post_data['cus_add2'] = "Dhaka";
    $post_data['cus_city'] = "Dhaka";
    $post_data['cus_state'] = "Dhaka";
    $post_data['cus_postcode'] = "1000";
    $post_data['cus_country'] = "Bangladesh";
    $post_data['cus_phone'] = $mobile;
    $post_data['cus_fax'] = "01711111111";

# SHIPMENT INFORMATION
    $post_data['shipping_method'] = "NO";
    $post_data['num_of_item'] = "1";


# CART PARAMETERS

    $post_data['product_name'] = 'Fee';
    $post_data['product_category'] = "Fee";
    $post_data['product_profile'] = "general";




    # REQUEST SEND TO SSLCOMMERZ
    $direct_api_url = $paymentSettings['api_address'];

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $direct_api_url );
    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($handle, CURLOPT_POST, 1 );
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


    $content = curl_exec($handle );

    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if($code == 200 && !( curl_errno($handle))) {
        curl_close( $handle);
        $sslcommerzResponse = $content;
    } else {
        curl_close( $handle);
        echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
        exit;
    }

# PARSE THE JSON RESPONSE
echo $sslcommerzResponse;
    //$sslcz = json_decode($sslcommerzResponse, true );

    if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
        $response_data = array(
            'status'=>'1',
            'url'=>$sslcz['GatewayPageURL']
        );
        //echo     json_encode($response_data);
         header("Location: ". $sslcz['GatewayPageURL']);
        exit;
    } else {
        echo "JSON Data parsing error!";
    }


?>