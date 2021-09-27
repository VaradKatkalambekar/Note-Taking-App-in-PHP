<?php

$showError="false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $conpassword = $_POST['signupcPassword'];

    //check if this email exists on forum
    $existsql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already in use";
    } 
    else{
        if($password == $conpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $nsql = "INSERT INTO `users` (`user_email`, `password`) VALUES ('$user_email', '$hash') ";
            $result = mysqli_query($conn,$nsql);
            echo $result;
            if($result){
                $showAlert = true;
                 header("Location: /forum/index.php?signupsuccess=true");
                 exit();
            }
            else{
                $showError = "There was an error creating your Account"; 
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    } 
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");

}

    
    
    


?>