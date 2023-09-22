<?php 
 session_start();
 error_reporting(0);
 include('../connect2.php');
 $username=$_SESSION['admin-username'];
 $id= $_GET['id'];
     
 date_default_timezone_set('Africa/Lagos');
 $current_date = date('Y-m-d');	
     
 $checksql = $dbh->prepare("select * from admin where username='$username'"); 
$checksql->execute();
$row = $checksql->fetch();
 
$user_type = $row['designation'];

if ($user_type == 'Academy_head') {
    $sql = "UPDATE clearance_apply SET is_accademic_head = :acadamy_head, acc_sign_date = :sign_date WHERE student_id =:student_id";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([
        ':student_id' => $id,
        ':acadamy_head' => 3,
        ':sign_date' => $current_date
        ]);
    header("Location: clearance-request.php"); 
} else if ($user_type == 'faculty') {
    $sql = "UPDATE clearance_apply SET is_faculty = :is_faculty, faculty_sign_date = :sign_date WHERE student_id =:student_id";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([
        ':student_id' => $id,
        ':is_faculty' => 3,
        ':sign_date' => $current_date
        ]);
    header("Location: clearance-request.php"); 
} else if ($user_type == 'dip_library') {
    $sql = "UPDATE clearance_apply SET dip_library = :dip_library, dip_library_sign_date = :sign_date WHERE student_id =:student_id";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([
        ':student_id' => $id,
        ':dip_library' => 3,
        ':sign_date' => $current_date
        ]);
    header("Location: clearance-request.php"); 
} else if ($user_type == 'kil_library') {
    $sql = "UPDATE clearance_apply SET is_kill = :library, kill_sign_date = :sign_date WHERE student_id =:student_id";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([
        ':student_id' => $id,
        ':library' => 3,
        ':sign_date' => $current_date
        ]);
    header("Location: clearance-request.php"); 
} else if ($user_type == 'sport_head') {
    $sql = "UPDATE clearance_apply SET is_sport = :is_sport, sport_sign_date = :sign_date WHERE student_id =:student_id";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([
        ':student_id' => $id,
        ':is_sport' => 3,
        ':sign_date' => $current_date
        ]);
    header("Location: clearance-request.php"); 
} else if ($user_type == 'hall_admin') {
    $sql = "UPDATE clearance_apply SET is_hostel = :is_hostel, hostel_sign_date = :sign_date WHERE student_id =:student_id";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([
        ':student_id' => $id,
        ':is_hostel' => 3,
        ':sign_date' => $current_date
        ]);
    header("Location: clearance-request.php"); 
} else {
    echo "Error";
}
 ?>