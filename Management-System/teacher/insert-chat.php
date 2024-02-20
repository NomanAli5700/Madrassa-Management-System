<?php 
include ("../includes/config.php");


if (isset($_POST['submit'])) {
    $message = $_POST['message'];
    $teacherId = $_POST['ID'];
    $studentId = $_POST['id'];
    $chatSessionId = $_POST['session_id'];

   

   
        $sql = "INSERT INTO chats (session_id, from_id, to_id, message) VALUES ('$chatSessionId', '$teacherId', '$studentId', '$message')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Data Saved Successfully";
            header("Location: ../teacher/chat.php");
        } else {
            mysqli_close($conn);
        }
    }

?>
       