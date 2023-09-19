<?php
session_start();
error_reporting(0);
include('connect.php');

if(empty($_SESSION['matric_no']))
    {   
    header("Location: login.php"); 
    }
    else{
	}

    date_default_timezone_set('Africa/Lagos');
    $current_date = date('Y-m-d H:i:s');

    //get neccesary session details 
$ID = $_SESSION["ID"];
$matric_no = $_SESSION["matric_no"];
$dept = $_SESSION['dept'];
$faculty = $_SESSION['faculty'];


$sql = "select * from students where matric_no='$matric_no'"; 
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);


$sql = "select SUM(amount) as tot_fee from fee where faculty='$faculty' AND dept='$dept'"; 
$result = $conn->query($sql);
$row_fee = mysqli_fetch_array($result);
$tot_fee=$row_fee['tot_fee'];

//Get outstanding paymentetc
$sql = "select SUM(amount) as tot_pay from payment where studentID='$ID'"; 
$result = $conn->query($sql);
$rowpayment = mysqli_fetch_array($result);
$tot_pay=$rowpayment['tot_pay'];

$outstanding_fee=$tot_fee-$tot_pay;

if(isset($_POST["btnpay"]))
{

$amt = mysqli_real_escape_string($conn,$_POST['txtamt']);

if ($amt > $outstanding_fee) {
$_SESSION['error'] ='Amount Can\'t be greater than Outstanding fee ';

}else {
//save fee details

$permitted_chars = '0123456789ABCDEFR';
$feeID = substr(str_shuffle($permitted_chars), 0, 12);

$query = "INSERT into `payment` (feeID,studentID,amount,datepaid)
VALUES ('$feeID','$ID','$amt','$current_date')";

$result = mysqli_query($conn,$query);
if($result){

header( "refresh:2;url= pay-fee.php" );
$_SESSION['success'] ='Fee payment Was Sucessfull';
}else{
$_SESSION['error'] ='Problem paying Fee';

}
}
}


?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fee Payment | Online Student clearance system</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

<script type="text/javascript">
		function confirmpayment(){
if(confirm("ARE YOU SURE YOU WISH TO PAY NOW ?" ))
{
return  true;
}
else {return false;
}
	 
}
</script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>

<body>
<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img src="<?php echo $rowaccess['photo'];  ?>" alt="image" width="100" height="100" class="img-circle" />
                         </span>


                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"><span class="text-muted text-xs block">Matric No:<?php echo $rowaccess['matric_no'];  ?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
</div>	
             
           <?php
           include('sidebar.php');
			   
			   ?>
			   
	       </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>

				<span class="m-r-sm text-muted welcome-message">Welcome <?php echo $rowaccess['fullname'];  ?></span>

                </li>
                <li class="dropdown">
                                     
                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
               
            </ul>

        </nav>


        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                       
                        <li class="active"><strong>Apply Clearance </strong></li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                        <div class="col-lg-8">
                        <table class="table" cellpadding="5" cellspacing="8">
                    <tr>
                        <th> Designee Name</th>
                        <th> Action</th>
                    </tr>
                    <tr>
                    <td>Academic Head</td>
                    <td>
                    <button type='button' id='ac_request' class="btn btn-primary"><i class="fa fa-send"></i> Send Request </button>
                    </td>
                    </tr>
                    <tr>
                    <td>Faculty</td>
                    <td>
                    <button type='button' id='faculty_request' class="btn btn-primary"><i class="fa fa-send"></i> Send Request </button>
                    </td>
                    </tr>
                    <tr>
                    <td>Departmental Library</td>
                    <td>
                    <button type='button' id='dipl_request' class="btn btn-primary"><i class="fa fa-send"></i> Send Request </button>
                    </td>
                    </tr>
                    <tr>
                    <td>Kashim Ibrahim Library</td>
                    <td>
                    <button type='button' id='kil_request' class="btn btn-primary"><i class="fa fa-send"></i> Send Request </button>
                    </td>
                    </tr>
                    <tr>
                    <td>Sport</td>
                    <td>
                    <button type='button' id='sport_request' class="btn btn-primary"><i class="fa fa-send"></i> Send Request </button>
                    </td>
                    </tr>
                    <tr>
                    <td>Hall Of Residence</td>
                    <td>
                    <button type='button' id='hall_request' class="btn btn-primary"><i class="fa fa-send"></i> Apply Request </button>
                    </td>
                    </tr>
                </table>
                        </div>
                        <div class="col-lg-4 hidden" id="proof_section">
                        <form action="#" method="POST" class="ibox" id="hostel_form" enctype="multipart/form-data">
                            <div class="ibox-title">
                                <h3 class="ibox-text">Provide Hostel Documents</h3>
                            </div>
                            <div class="ibox-content">
                                <div class="form-group">
                                    <label for="h_item">Select Item <span class="text-danger">*</span></label>
                                    <select name="h_item" id="h_item" class="form-control" required>
                                        <option value="">Choose Item</option>
                                        <option value="Hostel Clearance Slip">Hostel Clearance Slip</option>
                                        <option value="Other Document">Other Document</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="clearance_file">Clearance Form <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="clearance_file" name="clearance_file" required>
                                </div>
                                <button type="submit" id="btn_send_proof" class="btn btn-primary"><i class="fa fa-upload"></i> Send Proof</button>
                            </div>
                        </form>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-lg-5"></div>
            </div>
            <div class="row"></div>
        </div>
        <div class="footer">
            <div class="pull-right"></div>
            <div><?php  include('../footer.php'); ?></div>
        </div>

        </div>
        </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
		<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong> 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong> 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>
    <script>
    $(document).ready(function(){
        $("#hall_request").on('click', function(e){
            e.preventDefault();
            $("#proof_section").removeClass("hidden");
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-secondary');
        });

        //Request for academy clearance
        $('#ac_request').on('click', function(e){
        e.preventDefault();
        let cl_request = "1";
        // Store a reference to the button
        let button = $(this);
        $.ajax({
            url: 'request_script.php',
            method: 'POST',
            dataType: 'json',
            data: {cl_request: cl_request},
            beforeSend: function() {
                button.html('Requesting.....');
                button.attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.error  != "") {
                    alert(data.error);
                    button.html('Send Request');
                    button.attr('disabled', false);
                } else {
                    button.html(data.message);
                    button.removeClass('btn-primary');
                    button.addClass('btn-danger');
                    button.attr('disabled', true);
                }
                
            }
        });
    });
    //Request for Faculty clearance
        $('#faculty_request').on('click', function(e){
        e.preventDefault();
        let cl_request = "2";
        // Store a reference to the button
        let button = $(this);
        $.ajax({
            url: 'request_script.php',
            method: 'POST',
            dataType: 'json',
            data: {cl_request: cl_request},
            beforeSend: function() {
                button.html('Requesting.....');
                button.attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.error  != "") {
                    alert(data.error);
                    button.html('Send Request');
                    button.attr('disabled', false);
                } else {
                    button.html(data.message);
                    button.removeClass('btn-primary');
                    button.addClass('btn-danger');
                    button.attr('disabled', true);
                }
                
            }
        });
    });
    //Request for dipartmental clearance
        $('#dipl_request').on('click', function(e){
        e.preventDefault();
        let cl_request = "3";
        // Store a reference to the button
        let button = $(this);
        $.ajax({
            url: 'request_script.php',
            method: 'POST',
            dataType: 'json',
            data: {cl_request: cl_request},
            beforeSend: function() {
                button.html('Requesting.....');
                button.attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.error  != "") {
                    alert(data.error);
                    button.html('Send Request');
                    button.attr('disabled', false);
                } else {
                    button.html(data.message);
                    button.removeClass('btn-primary');
                    button.addClass('btn-danger');
                    button.attr('disabled', true);
                }
                
            }
        });
    });
    //Request for Kill Library clearance
        $('#kil_request').on('click', function(e){
        e.preventDefault();
        let cl_request = "4";
        // Store a reference to the button
        let button = $(this);
        $.ajax({
            url: 'request_script.php',
            method: 'POST',
            dataType: 'json',
            data: {cl_request: cl_request},
            beforeSend: function() {
                button.html('Requesting.....');
                button.attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.error  != "") {
                    alert(data.error);
                    button.html('Send Request');
                    button.attr('disabled', false);
                } else {
                    button.html(data.message);
                    button.removeClass('btn-primary');
                    button.addClass('btn-danger');
                    button.attr('disabled', true);
                }
                
            }
        });
    });
    //Request for sport clearance
        $('#sport_request').on('click', function(e){
        e.preventDefault();
        let cl_request = "5";
        // Store a reference to the button
        let button = $(this);
        $.ajax({
            url: 'request_script.php',
            method: 'POST',
            dataType: 'json',
            data: {cl_request: cl_request},
            beforeSend: function() {
                button.html('Requesting.....');
                button.attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.error  != "") {
                    alert(data.error);
                    button.html('Send Request');
                    button.attr('disabled', false);
                } else {
                    button.html(data.message);
                    button.removeClass('btn-primary');
                    button.addClass('btn-danger');
                    button.attr('disabled', true);
                }
                
            }
        });
    });
    // Upload hostel proof
    $("#hostel_form").on('submit', function(event) {
    event.preventDefault();

    var hostelItem = $("#h_item").val();
    var hostelProof = $("#clearance_file")[0].files[0]; // Get the selected file

    if (hostelProof == undefined || hostelItem == "") {
        alert("Please select an item and upload a file to submit.");
    } else {
        var formData = new FormData();
        formData.append('h_item', hostelItem);
        formData.append('clearance_file', hostelProof); // Use 'clearance_file' as the key

        $.ajax({
            url: 'upload_proof.php',
            method: 'POST',
            dataType: 'json',
            data: formData,
            processData: false, // Prevent jQuery from automatically processing the data
            contentType: false, // Prevent jQuery from setting content type
            beforeSend: function() {
                $("#btn_send_proof").html('Loading..');
                $("#btn_send_proof").attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.error) {
                    alert("Error: " + data.error);
                } else if (data.message) {
                    $("#proof_section").addClass("hidden");
                    $("#hall_request").removeClass('btn-secondary');
                    $("#hall_request").addClass('btn-danger');
                    $("#hall_request").html(data.message);
                    $("#hall_request").attr('disabled', 'disabled');
                }

                $("#btn_send_proof").html('<i class="fa fa-upload"></i> Send Proof');
                $("#btn_send_proof").attr('disabled', false);
            },
            error: function() {
                alert("An error occurred while processing the request.");
            }
        });
    }
});
    });
    </script>
</body>
</html>