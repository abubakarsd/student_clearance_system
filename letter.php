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
	
$ID = $_SESSION["ID"];
$matric_no = $_SESSION["matric_no"];

$sql = "select * from students where matric_no='$matric_no'"; 
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);

$csql = "SELECT * FROM clearance_apply WHERE student_id = $ID"; 
$cresult = $conn->query($csql);
$row = mysqli_fetch_array($cresult);

$academy_head = $row["is_accademic_head"];
$academy_sign_date = $row["acc_sign_date"];
$faculty_cle = $row["is_faculty"];
$faculty_sign_date = $row["faculty_sign_date"];
$dip_library = $row["is_dip_library"];
$dip_library_sign = $row["dip_library_sign_date"];
$kill_library = $row["is_kill"];
$kill_sign_date = $row["kill_sign_date"];
$is_sport = $row["is_sport"];
$sport_sign_date = $row["sport_sign_date"];
$is_hostel = $row["is_hostel"];
$hostel_sign_date = $row["hostel_sign_date"];
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clearance Letter |Arthur Javis University</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">



    <style type="text/css">
<!--
.style1 {
	font-size: xx-large;
	font-weight: bold;
}
.style2 {font-weight: bold}
-->
    </style>
</head>

<body>

            <div class="wrapper wrapper-content  animated fadeInRight article">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="ibox">
                        <div class="ibox-content">
                          <div class="article-title">
                            <div style="font-size: small; color: black; font-weight: bold; text-align: center;">
                                <p> STUDENT AFFAIRS DIVISION<br>
                                    AHMADU BELLO UNIVERSITY, ZARIA<br>
                                    EXIT/CLEARANCE FORM</p>
                            </div>
                            <center>
                            <table style="color: black; font-size: smaller; height: 100%" width="80%">
                                <tbody><tr>
                                    <td colspan="4">
                                        <div style="text-align: center; font-weight: bold">(To be completed in
                                            Duplicate)
                                        </div>
                                        <p>
                                            All students should complete the Exit/Clearance Form in duplicate at the end
                                            of the session and when leaving the University finally, that all University
                                            properties are returned in good shape. A copy of the completed and duty
                                            signed form should be left with the Hall Administration for record purpose.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 25%">NAME:</th>
                                    <td><?php echo $rowaccess['fullname']; ?></td>
                                    <th style="width: 15%">ROOM NO:</th>
                                    <td><?php echo $rowaccess['is_hostel']; ?></td>
                                </tr>
                                <tr>
                                    <th>COURSE:</th>
                                    <td>B.Sc <?php echo $rowaccess['dept']; ?></td>
                                    <th>REG NO.:</th>
                                    <td><?php echo $rowaccess['matric_no']; ?></td>
                                </tr>
                                <tr>
                                    <th>DEPARTMENT:</th>
                                    <td colspan="3">Department of <?php echo $rowaccess['dept']; ?></td>
                                </tr>
                                <tr>
                                    <th>DESTINATION:</th>
                                    <td colspan="3">
                                        ..................................................................................................................................................................
                                    </td>
                                </tr>
                                <tr>
                                    <th>PURPOSE:</th>
                                    <td colspan="3">
                                        ..................................................................................................................................................................
                                    </td>
                                </tr>
                                <tr>
                                    <th>CONTACT ADDRESS:</th>
                                    <td colspan="3"><?php echo $rowaccess['Address']; ?></td>
                                </tr>
                                <tr>
                                    <th>ACADEMIC HEAD:</th>
                                    <td colspan="3">
                                        <p>
                                        Department of <?php echo $rowaccess['dept']; ?><br>
                                            This is to certify that <b><?php echo $rowaccess['fullname']; ?></b> has been
                                            cleared by
                                            this Department.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    <?php echo $academy_sign_date; ?><br>
                                    ......................................................<br>
                                    <div>Date</div>
                                    </td>
                                    <td colspan="2" style="text-align: end">
                                    <?php if ($academy_head < 2)  { ?>
                                    <b>Pending</b><br>
                                    <?php } else {?>
                                    <b>Cleared</b><br>
                                        <?php } ?>
                                    ......................................................<br>
                                        HOD's Signature and Stamp
                                    </td>
                                </tr>

                                
                                <tr>
                                    <th>FACULTY:</th>
                                    <td colspan="3">
                                        <p>
                                            Faculty of <?php echo $rowaccess['faculty']; ?><br>
                                            This is to certify that <b><?php echo $rowaccess['fullname']; ?></b> has been
                                            cleared by
                                            the Faculty.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    <?php echo $faculty_sign_date; ?><br>
                                    ......................................................<br>
                                        <div>Date</div>
                                    </td>
                                    <td colspan="2" style="text-align: end">
                                    <?php if ($faculty_cle < 2)  { ?>
                                    <b>Pending</b><br>
                                    <?php } else {?>
                                    <b>Cleared</b><br>
                                        <?php } ?>
                                        ......................................................<br>
                                        Dean's Signature and Stamp
                                    </td>
                                </tr>

                                
                                <tr>
                                    <th>DEPARTMENTAL LIBRARY:</th>
                                    <td colspan="3">
                                        <p>
                                            Department of <?php echo $rowaccess['dept']; ?><br>
                                            This is to certify that <b><?php echo $rowaccess['fullname']; ?></b> has returned
                                            all the
                                            Departmental Library Books, checked and are in good shape.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    <?php echo $dip_library_sign; ?><br>
                                        ......................................................<br>
                                        <div>Date</div>
                                    </td>
                                    <td colspan="2" style="text-align: end">
                                    <?php if ($dip_library < 2)  { ?>
                                    <b>Pending</b><br>
                                    <?php } else {?>
                                    <b>Cleared</b><br>
                                        <?php } ?>
                                        ......................................................<br>
                                        Librarian's Signature and Stamp
                                    </td>
                                </tr>

                                
                                <tr>
                                    <th>KASHIM IBRAHIM LIBRARY:</th>
                                    <td colspan="3">
                                        <p>
                                            This is to certify that <b><?php echo $rowaccess['fullname']; ?></b> has returned
                                            all Library Books, checked and are in good condition.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    <?php echo $kill_sign_date; ?><br>
                                        ......................................................<br>
                                        <div>Date</div>
                                    </td>
                                    <td colspan="2" style="text-align: end">
                                    <?php if ($kill_library < 2)  { ?>
                                    <b>Pending</b><br>
                                    <?php } else {?>
                                    <b>Cleared</b><br>
                                        <?php } ?>
                                        ......................................................<br>
                                        K.I.L. Signature and Stamp
                                    </td>
                                </tr>

                                
                                <tr>
                                    <th>SPORT:</th>
                                    <td colspan="3">
                                        <p>
                                            This is to certify that <b><?php echo $rowaccess['fullname']; ?></b> is not in
                                            possession of sports equipment.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    <?php echo $sport_sign_date; ?><br>
                                        ......................................................<br>
                                        <div>Date</div>
                                    </td>
                                    <td colspan="2" style="text-align: end">
                                    <?php if ($is_sport < 2)  { ?>
                                    <b>Pending</b><br>
                                    <?php } else {?>
                                    <b>Cleared</b><br>
                                        <?php } ?>
                                        ......................................................<br>
                                        Sports Unit Signature and Stamp
                                    </td>
                                </tr>

                                
                                <tr>
                                    <th>HALL OF RESIDENCE:</th>
                                    <td colspan="3">
                                        <p>
                                            This is to certify that <b><?php echo $rowaccess['fullname']; ?></b> has submitted
                                            the items indicated below checked and found correct and in good condition.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding: 0px;">
                                        <table style="color: black; font-size: smaller;">
                                            <tbody><tr>
                                                <th>ITEM</th>
                                                <th>RECEIVER'S SIGNATURE</th>
                                            </tr>
                                            <tr>
                                                <td>BED</td>
                                                <td>
                                                <?php if ($is_hostel < 2)  { ?>
                                                    <b>Pending</b><br>
                                                    <?php } else {?>
                                                    <b>Cleared</b><br>
                                                        <?php } ?>
                                                ______________________________________________
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MATTRESS</td>
                                                <td><?php if ($is_hostel < 2)  { ?>
                                                <b>Pending</b><br>
                                                <?php } else {?>
                                                <b>Cleared</b><br>
                                                    <?php } ?>
                                                    ______________________________________________
                                                    </td>
                                            </tr>
                                            <tr>
                                                <td>KEY</td>
                                                <td>
                                                <?php if ($is_hostel < 2)  { ?>
                                                <b>Pending</b><br>
                                                <?php } else {?>
                                                <b>Cleared</b><br>
                                                    <?php } ?>
                                                ______________________________________________
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    <?php echo $hostel_sign_date; ?><br>
                                    ........................................................<br>
                                        <div>Date</div>
                                    </td>
                                    <td colspan="2" style="text-align: end">
                                    <?php if ($is_hostel < 2)  { ?>
                                    <b>Pending</b><br>
                                    <?php } else {?>
                                    <b>Cleared</b><br>
                                        <?php } ?>
                                        ......................................................<br>
                                        Hall Administrators' Signature and Stamp
                                    </td>
                                </tr>
                            </tbody></table>
                            </center>

                        </div>
                        <div class="row">
                              <div align="center"><a href="#" id="print-button" onclick="window.print();return false;">Print this page</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

</body>

</html>
