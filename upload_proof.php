<?php
sleep(2);
session_start();
$con= new PDO("mysql:host=localhost;dbname=student_clearance", "root","");
$message = '';
$error = '';
if (isset($_POST['h_item'])) {
    $allowedExtensions = ['pdf', 'jpg', 'jpeg'];
    
    if (!empty($_FILES['clearance_file']['name'])) {
        $fileExtension = strtolower(pathinfo($_FILES['clearance_file']['name'], PATHINFO_EXTENSION));
    
        if (in_array($fileExtension, $allowedExtensions)) {
            $folder = "documents/";
            $image_path = $folder . $_FILES['clearance_file']['name'];
    
            if (move_uploaded_file($_FILES['clearance_file']['tmp_name'], $image_path)) {
                $stmt = $con->prepare("SELECT COUNT(*) FROM clearance_document WHERE student_id = :user_id");
                $stmt->execute([':user_id' => $_SESSION['ID']]);
                $count = $stmt->fetchColumn();
    
                if ($count > 0) {
                    $stmtupload = $con->prepare("UPDATE clearance_document SET prof_type = :prof_type, proof_doc = :proof_doc WHERE student_id = :student_id");
                } else {
                    $stmtupload = $con->prepare("INSERT INTO clearance_document (student_id, prof_type, proof_doc) VALUES (:student_id, :prof_type, :proof_doc)");
                }

                $stmtupload->execute([
                    ':student_id' => $_SESSION['ID'],
                    ':prof_type' => $_POST['h_item'],
                    ':proof_doc' => $image_path
                ]);
    
                $stmtReq = $con->prepare("UPDATE clearance_apply SET is_hostel = :is_hostel WHERE student_id = :student_id");
                $stmtReq->execute([
                    ':student_id' => $_SESSION['ID'],
                    ':is_hostel' => 1
                ]);
    
                $message = "Request Sent";
            } else {
                $error = "An error occurred while uploading the file.";
            }
        } else {
            $error = "Invalid file type. Only PDF and JPG/JPEG files are allowed.";
        }
    } else {
        $error = "Please select a file to upload.";
    }
}

// For example, you can create a response array
$response = array(
    'message' => $message,
    'error' => $error
);

echo json_encode($response);
?>