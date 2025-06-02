<?php
session_start();
include 'connection.php';

if(isset($_POST['submit_feedback'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $user_id = $_SESSION['user_id'];
    $category_id = validate($_POST['category_id']);
    $content = validate($_POST['content']);
    
    // Determine location
    if(!empty($_POST['detected_location'])) {
        $location = validate($_POST['detected_location']);
    } else if(!empty($_POST['manual_location'])) {
        $location = validate($_POST['manual_location']);
    } else {
        $location = "Unknown location";
    }
    
    if(empty($category_id)) {
        header('location: ../pages/client/submit-feedback.php?error=Category is required!');
        exit();
    } else if(empty($content)) {
        header('location: ../pages/client/submit-feedback.php?error=Feedback content is required!');
        exit();
    } else {
        $sql = "INSERT INTO feedbacks (user_id, category_id, content, location) 
                VALUES ('$user_id', '$category_id', '$content', '$location')";
        
        $result = mysqli_query($db, $sql);
        
        if($result) {
            header('location: ../pages/client/submit-feedback.php?success=Feedback submitted successfully!');
            exit();
        } else {
            header('location: ../pages/client/submit-feedback.php?error=Failed to submit feedback. Please try again.');
            exit();
        }
    }
}