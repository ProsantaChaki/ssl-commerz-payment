
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
        <h2>Horizontal form</h2>
        <form class="form-horizontal" id="paymentInfo" name="paymentInfo">
            <div class="form-group " >
                <label class="control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="mobile">Mobile:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="mobile" placeholder="Enter Mobile No" name="mobile">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="u_id">Unique Id:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="u_id" placeholder="Enter Your Unique Id" name="u_id">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="amount">Amount:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="amount" placeholder="Enter The Amount of Money" name="amount">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="makePayment"  class="btn btn-default">Make Payment</button>
                </div>
            </div>
        </form>
    </div>
    <div class=" page-footer font-small blue pt-4" style="height: 100px; margin-top: 10px; background-color: #e9ecef">
        <div class="col-md-2 col-sm-2"></div>
        <div class="col-md-8 col-sm-8" style="text-align: right;">
            <p>এই পেজ এর যেকোনো উপাদান আপনারা আপনাদের ইচ্ছা মত ব্যাবহার করতে পারেন। </p>
        </div>
        <div class="col-md-2 col-sm-2"></div>
    </div>



    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="fb_image">
                <div class="modal-header">
                    <input type="hidden" id="score">
                    <h5 class="modal-title" id="">আপনার পাপকর্মের ফলাফল</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="scoreBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fb_hidden_" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary fb_hidden_" data-dismiss="modal" id="share_button"><i class="fab fa-facebook-f"></i>Share in Facebook</button>

                    <img class="fb_hidden_" src = "images/facebook-share.jpg" id="" style="height: 0px">
                </div>
            </div>
        </div>
    </div>
    <div id="fb-root"></div>
</body>
</html>




<script>

    $('#makePayment').click(function () {
        event.preventDefault()

        if(($('#name').val() !== null && $('#name').val() !== '') && ($('#u_id').val() !== null && $('#u_id').val() !== '') &&($('#amount').val() !== null && $('#amount').val() !== '') && (($('#email').val() !== null && $('#email').val() !== '') || ($('#mobile').val() !== null && $('#mobile').val() !== ''))){
            alert(project_url)
            var formData = new FormData($('#paymentInfo')[0]);

            $.ajax({
                url: project_url + "includes/controller/paymentController.php",
                type:'POST',
                data:formData,
                async:false,
                cache:false,
                contentType:false,processData:false,
                success: function (data) {
                    console.log(data)
                    //data = JSON.parse(data)
                    //window.location.href = data['url'];
                }
            })
        }else alert('Please Fill All The Information')
    })


</script>

