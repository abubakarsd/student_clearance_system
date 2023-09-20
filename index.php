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
      

    //get neccesary session details 
    $ID = $_SESSION["ID"];
    $matric_no = $_SESSION["matric_no"];
    $dept = $_SESSION['dept'];
    $faculty = $_SESSION['faculty'];
	
   
    $sql = "select SUM(amount) as tot_fee from fee where faculty='$faculty' AND dept='$dept'"; 
    $result = $conn->query($sql);
    $row_fee = mysqli_fetch_array($result);
    $tot_fee=$row_fee['tot_fee'];
    
    //Get outstanding payment etc
    $sql = "select SUM(amount) as tot_pay from payment where studentID='$ID'"; 
    $result = $conn->query($sql);
    $rowpayment = mysqli_fetch_array($result);
    $tot_pay=$rowpayment['tot_pay'];
    
    $outstanding_fee=$tot_fee-$tot_pay;

    if ($tot_fee == $tot_pay) {
        $paystatus = '<div align="center"><i class="fa fa-check-circle" style="font-size:28px;color:green"></i> Clearance fee Paid</div>';
    } else {
        $paystatus = '<div align="center"><i class="fa fa-times-circle" style="font-size:28px;color:orange"></i>Pending</div>';
    }

// Check if student has been cleared
$checkSQL = "SELECT *
    FROM clearance_apply
    WHERE 
        is_accademic_head >= 2
        AND is_faculty >= 2
        AND is_dip_library >= 2
        AND is_kill >= 2
        AND is_sport >= 2
        AND is_hostel >= 2
        AND student_id = $ID";

$checkRslt = $conn->query($checkSQL);

if ($checkRslt->num_rows > 0) {
    // Student has been cleared
    $clearanceResult = '<div align="center"><a href="result.php" target="_blank"><span class="label label-primary"><i class="fa fa-download"></i> Download Result</span></a></div>';
    $clearedStt = '<div align="center"><i class="fa fa-check-circle" style="font-size:28px;color:green"></i> Cleared</div>
    <span class="style2"><small> <a href="letter.php" target="_blank">Print Clearance Letter</a></small></span>
    ';
} else {
    // Student has not been cleared
    $clearanceResult = '<div align="center"><span class="label label-danger">Result not Ready</span></div>';
    $clearedStt = '<div align="left"><i class="fa fa-times-circle" style="font-size:28px;color:orange"></i> Pending</div>';
}

$sql = "SELECT * FROM clearance_apply WHERE student_id = $ID"; 
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);

$academy_head = $rowaccess["is_accademic_head"];
$faculty_cle = $rowaccess["is_faculty"];
$dip_library = $rowaccess["is_dip_library"];
$kill_library = $rowaccess["is_kill"];
$is_sport = $rowaccess["is_sport"];
$is_hostel = $rowaccess["is_hostel"];

$sql = "select * from students where matric_no='$matric_no'"; 
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);
?>
		   
<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Dashboard | Online clearance System</title>

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
.style2 {color: #FF0000}
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
				
				
                    <span class="m-r-sm text-muted welcome-message">Welcome <?php echo $rowaccess['fullname']; ?></span>
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
<div class="wrapper wrapper-content">
        <div class="row">	  
			       
					    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <h5><span class="label label-primary pull-right">Clearance Fee </span>
                              </h5>
                            </div>
							
                            <div class="ibox-content">
                                <h3 class="no-margins">NGN<?php echo number_format((float) $tot_fee ,2); ?> </h3>
                                <small> </small> 
						  </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <h5><span class="label label-secondary pull-right">Payment Status</span>
                              </h5>
                            </div>
							
                            <div class="ibox-content">
                                <?php echo $paystatus; ?>
						  </div>
                         
                        </div>
                    </div>    
					
					
					<div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <h5><span class="label label-info pull-right">Status</span>
                              </h5>
                            </div>
							
                          <div class="ibox-content">
                              <h3 class="no-margins">
                              <?php echo $clearedStt; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <h5><span class="label label-success pull-right">Statement Of Result</span>
                              </h5>
                            </div>
							
                            <div class="ibox-content">
                                <?php echo $clearanceResult; ?>
						  </div>
                        </div>
                    </div>             
 
        <div class="row">
          <div class="col-lg-12"> 
            <p>&nbsp;</p>
            <p>
		
			</p>
            <p>		</p>
            <table width="100%" height="341" align="center">
              <tr>
                <td width="100%"><table border="0" align="center" class="table table-hover no-margins">
                  <thead>
                    <tr>
                      <th width="10%"><div align="center"><span class="style1">Fee </span></div></th>
                      <th width="10%"><div align="center"><span class="style1">Academic Head </span></div></th>
                      <th width="10%"><div align="center"><span class="style1">Faculty </span></div></th>
                      <th width="10%"><div align="center"><span class="style1">Departmental Library </span></div></th>
                      <th width="10%"><div align="center"><span class="style1">KIL </span></div></th>
                      <th width="10%"><div align="center" class="style1">Sport</div></th>
                      <th width="10%"><div align="center"><span class="style1">Hall Of Residence</span></div></th>
                    </tr>
                  </thead>
                  <tbody>
                   <tr>
	
				   
				    <td>
					  <?php if (($outstanding_fee)==(("0")))  { ?>
					   <div align="center"><span class="label label-primary">Cleared</span> </div>
					   <?php } else {?>
					   <div align="center"><span class="label label-warning">Pending</span> </div>
 						<?php } ?>
				     </td>
						
                     <td>
					   	 <?php if ($academy_head < 2)  { ?>
					   <div align="center"><span class="label label-warning">Pending</span> </div>
					   <?php } else {?>
					   <div align="center"><span class="label label-primary">Cleared</span> </div>
 						<?php } ?>
				     </td>

                     <td>
					   	 <?php if ($faculty_cle < 2)  { ?>
					   <div align="center"><span class="label label-warning">Pending</span> </div>
					   <?php } else {?>
					   <div align="center"><span class="label label-primary">Cleared</span> </div>
 						<?php } ?>
				     </td>

                     <td>
					   	 <?php if ($dip_library < 2)  { ?>
					   <div align="center"><span class="label label-warning">Pending</span> </div>
					   <?php } else {?>
					   <div align="center"><span class="label label-primary">Cleared</span> </div>
 						<?php } ?>
				     </td>
						
				       <td>
					   	 <?php if ($kill_library < 2)  { ?>
					   <div align="center"><span class="label label-warning">Pending</span> </div>
					   <?php } else {?>
					   <div align="center"><span class="label label-primary">Cleared</span> </div>
 						<?php } ?>
				     </td>
						
                      <td>
					   	 <?php if ($is_sport < 2)  { ?>
					   <div align="center"><span class="label label-warning">Pending</span> </div>
					   <?php } else {?>
					   <div align="center"><span class="label label-primary">Cleared</span> </div>
 						<?php } ?>
				     </td>
						
						
						 <td>
					   	 <?php if ($is_hostel < 2)  { ?>
					   <div align="center"><span class="label label-warning">Pending</span> </div>
					   <?php } else {?>
					   <div align="center"><span class="label label-primary">Cleared</span> </div>
 						<?php } ?>
					    </td>
						
				    </tr>
                  </tbody>
                </table></td>
              </tr>
            </table>
            <p align="center"></p>
            <div class="row">&nbsp; </p>
          </div>
          </div>


          </div>
            <div class="footer">
            
            <div>
<?php include('footer.php');  ?>            </div>
        </div>
        </div>
</div>

            <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('.chart').easyPieChart({
                barColor: '#f8ac59',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            var data2 = [
                [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
                [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
                [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
                [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
                [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
                [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
                [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
                [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
            ];

            var data3 = [
                [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
                [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
                [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
                [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
                [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
                [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
                [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
                [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
            ];


            var dataset = [
                {
                    label: "Number of orders",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Payments",
                    data: data2,
                    yaxis: 2,
                    color: "#464f88",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.2
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
        });
    </script>
</body>
</html>
