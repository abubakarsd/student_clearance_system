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

// check if student has sent request
$sqlcheck = "SELECT * FROM clearance_apply WHERE student_id = $ID"; 
$resultcheck = $conn->query($sqlcheck);
$row = mysqli_fetch_array($resultcheck);

$academy_head = $row["is_accademic_head"];
$faculty_cle = $row["is_faculty"];
$dip_library = $row["is_dip_library"];
$kill_library = $row["is_kill"];
$is_sport = $row["is_sport"];
$is_hostel = $row["is_hostel"];

if ($academy_head == 1) {
    $condition = "btn btn-danger disabled";
    $condition_txt = "Request Sent";
} else if ($academy_head == 2) {
    $condition = "btn btn-success disabled";
    $condition_txt = "Request Approved";
} else {
    $condition = "btn btn-primary";
    $condition_txt = "Send Request";
}

if ($faculty_cle == 1) {
    $condition1 = "btn btn-danger disabled";
    $condition_txt1 = "Request Sent";
} else if ($faculty_cle == 2) {
    $condition1 = "btn btn-success disabled";
    $condition_txt1 = "Request Approved";
} else {
    $condition1 = "btn btn-primary";
    $condition_txt1 = "Send Request";
}

if ($dip_library == 1) {
    $condition2 = "btn btn-danger disabled";
    $condition_txt2 = "Request Sent";
} else if ($dip_library == 2) {
    $condition2 = "btn btn-success disabled";
    $condition_txt2 = "Request Approved";
} else {
    $condition2 = "btn btn-primary";
    $condition_txt2 = "Send Request";
}

if ($kill_library == 1) {
    $condition3 = "btn btn-danger disabled";
    $condition_txt3 = "Request Sent";
} else if ($kill_library == 2) {
    $condition3 = "btn btn-success disabled";
    $condition_txt3 = "Request Approved";
} else {
    $condition3 = "btn btn-primary";
    $condition_txt3 = "Send Request";
}

if ($is_sport == 1) {
    $condition4 = "btn btn-danger disabled";
    $condition_txt4 = "Request Sent";
} else if ($is_sport == 2) {
    $condition4 = "btn btn-success disabled";
    $condition_txt4 = "Request Approved";
} else {
    $condition4 = "btn btn-primary";
    $condition_txt4 = "Send Request";
}

if ($is_hostel == 1) {
    $condition5 = "btn btn-danger disabled";
    $condition_txt5 = "Request Sent";
} else if ($is_hostel == 2) {
    $condition5 = "btn btn-success disabled";
    $condition_txt5 = "Request Approved";
} else {
    $condition5 = "btn btn-primary";
    $condition_txt5 = "Send Request";
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apply Clearance | Online Student clearance system</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
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
                    <button type='button' id='ac_request' class="<?php echo $condition; ?>"><i class="fa fa-send"></i> <?php echo $condition_txt; ?></button>
                    </td>
                    </tr>
                    <tr>
                    <td>Faculty</td>
                    <td>
                    <button type='button' id='faculty_request' class="<?php echo $condition1; ?>"><i class="fa fa-send"></i> <?php echo $condition_txt1; ?></button>
                    </td>
                    </tr>
                    <tr>
                    <td>Departmental Library</td>
                    <td>
                    <button type='button' id='dipl_request' class="<?php echo $condition2; ?>"><i class="fa fa-send"></i> <?php echo $condition_txt2; ?></button>
                    </td>
                    </tr>
                    <tr>
                    <td>Kashim Ibrahim Library</td>
                    <td>
                    <button type='button' id='kil_request' class="<?php echo $condition3; ?>"><i class="fa fa-send"></i> <?php echo $condition_txt3; ?></button>
                    </td>
                    </tr>
                    <tr>
                    <td>Sport</td>
                    <td>
                    <button type='button' id='sport_request' class="<?php echo $condition4; ?>"><i class="fa fa-send"></i> <?php echo $condition_txt4; ?></button>
                    </td>
                    </tr>
                    <tr>
                    <td>Hall Of Residence</td>
                    <td>
                    <button type='button' id='hall_request' class="<?php echo $condition5; ?>"><i class="fa fa-send"></i> <?php echo $condition_txt5; ?></button>
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