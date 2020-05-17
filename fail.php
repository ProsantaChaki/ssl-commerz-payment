
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SSL-Commerz Payment</title>
    <meta charset="utf-8">
    <meta property="og:image" id="mymetatag" content="">
    <link rel='shortcut icon' type='image/x-icon' href='/images/logo/sunnymoony.png' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/static_text.js"></script>
    <style>

    </style>

</head>
<body>

    <div class="jumbotron text-center">
        <h1>Welcome to MySchool</h1>
        <p>Please fill the all information blew to make your payment</p>
    </div>

    <div class="container">
        <h1>Your Payment request has been failed</h1>
    </div>
    <div class=" page-footer font-small blue pt-4" style="height: 100px; margin-top: 10px; background-color: #e9ecef">
        <div class="col-md-2 col-sm-2"></div>
        <div class="col-md-8 col-sm-8" style="text-align: right;">
        </div>
        <div class="col-md-2 col-sm-2"></div>
    </div>

</body>
</html>




<script>

    $.ajax({
        url:"includes/controller/paymentFailedController.php",
        type: 'POST',
        async: false,
        data: {
            'tran_id': '<?php  echo $_POST['tran_id']; ?>'
        },
        success: function (data) {
            alert('Failed')

        }
    })

</script>

