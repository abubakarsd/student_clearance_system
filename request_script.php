<?php
sleep(2);
session_start();
$con= new PDO("mysql:host=localhost;dbname=student_clearance", "root","");
$message = '';
$error = '';
    if ($_POST['cl_request'] === '1') {
        $stmt = $con->prepare("SELECT COUNT(*) FROM clearance_apply WHERE student_id = :user_id");
        $stmt->execute([
            ':user_id' => $_SESSION['ID']
        ]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $stmtReq = $con->prepare("UPDATE clearance_apply SET is_accademic_head = :is_accademic WHERE student_id = :student_id");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_accademic' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        } else {
            $stmtReq = $con->prepare("INSERT INTO clearance_apply (student_id,is_accademic_head) VALUES (:student_id,:is_accademic)");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_accademic' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        }
    } else if ($_POST['cl_request'] === '2') {
        $stmt = $con->prepare("SELECT COUNT(*) FROM clearance_apply WHERE student_id = :user_id");
        $stmt->execute([
            ':user_id' => $_SESSION['ID']
        ]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $stmtReq = $con->prepare("UPDATE clearance_apply SET is_faculty = :is_faculty WHERE student_id = :student_id");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_faculty' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        } else {
            $stmtReq = $con->prepare("INSERT INTO clearance_apply (student_id,is_faculty) VALUES (:student_id,:is_faculty)");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_faculty' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        }
    } else if ($_POST['cl_request'] === '3') {
        $stmt = $con->prepare("SELECT COUNT(*) FROM clearance_apply WHERE student_id = :user_id");
        $stmt->execute([
            ':user_id' => $_SESSION['ID']
        ]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $stmtReq = $con->prepare("UPDATE clearance_apply SET is_dip_library = :is_dip_library WHERE student_id = :student_id");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_dip_library' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        } else {
            $stmtReq = $con->prepare("INSERT INTO clearance_apply (student_id,is_dip_library) VALUES (:student_id,:is_dip_library)");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_dip_library' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        }
    } else if ($_POST['cl_request'] === '4') {
        $stmt = $con->prepare("SELECT COUNT(*) FROM clearance_apply WHERE student_id = :user_id");
        $stmt->execute([
            ':user_id' => $_SESSION['ID']
        ]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $stmtReq = $con->prepare("UPDATE clearance_apply SET is_kill = :is_kill WHERE student_id = :student_id");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_kill' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        } else {
            $stmtReq = $con->prepare("INSERT INTO clearance_apply (student_id,is_kill) VALUES (:student_id,:is_kill)");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_kill' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        }
    } else if ($_POST['cl_request'] === '5') {
        $stmt = $con->prepare("SELECT COUNT(*) FROM clearance_apply WHERE student_id = :user_id");
        $stmt->execute([
            ':user_id' => $_SESSION['ID']
        ]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $stmtReq = $con->prepare("UPDATE clearance_apply SET is_sport = :is_sport WHERE student_id = :student_id");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_sport' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        } else {
            $stmtReq = $con->prepare("INSERT INTO clearance_apply (student_id,is_sport) VALUES (:student_id,:is_sport)");
            $stmtReq->execute([
                ':student_id' => $_SESSION['ID'],
                ':is_sport' => 1
                ]);
            if ($stmtReq) {
                $message = "Request Sent";
            } else {
                $error = "An error occurred";
            }
        }
    }
    
    // For example, you can create a response array
    $response = array(
        'message' => $message,
        'error' => $error
    );
    
    echo json_encode($response);    
?>