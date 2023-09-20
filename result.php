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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement of Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .student-info {
            margin-bottom: 20px;
        }

        .student-info p {
            margin: 5px 0;
        }

        .grades {
            border-collapse: collapse;
            width: 100%;
        }

        .grades th, .grades td {
            padding: 10px;
            text-align: left;
        }

        .grades th {
            background-color: #f2f2f2;
        }

        .grades tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .grades tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Statement of Result</h1>
        <div class="student-info">
            <p><strong>Name:</strong> <?php echo $rowaccess['fullname']; ?></p>
            <p><strong>Registration Number:</strong> <?php echo $rowaccess['matric_no']; ?></p>
            <p><strong>Department:</strong> <?php echo $rowaccess['dept']; ?></p>
            <p><strong>Faculty:</strong> <?php echo $rowaccess['faculty']; ?></p>
            <p><strong>Grade:</strong> Second Class Upper</p>
        </div>
        <table class="grades">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Credit Hours</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mathematics</td>
                    <td>3</td>
                    <td>A</td>
                </tr>
                <tr>
                    <td>Physics</td>
                    <td>3</td>
                    <td>B</td>
                </tr>
                <tr>
                    <td>Computer Science</td>
                    <td>3</td>
                    <td>A</td>
                </tr>
                <!-- Add more rows for other courses -->
            </tbody>
        </table>

        <div class="certification">
            <p>This is to certify that <strong><?php echo $rowaccess['fullname']; ?></strong> has successfully graduated from the Department of </strong> <?php echo $rowaccess['dept']; ?>, Faculty of <?php echo $rowaccess['faculty']; ?>.</p>
        </div>
        <div class="signature">
            <p>________________________</p>
            <p>Signature</p>
        </div>

    </div>
</body>
</html>