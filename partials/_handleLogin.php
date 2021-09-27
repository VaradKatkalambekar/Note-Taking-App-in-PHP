<?php


$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    //check if this email exists on forum
    $existsql = "SELECT * FROM `users` WHERE user_email = '$user_email' ";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);

    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['srn'] = $row['srn'];
            $_SESSION['user_email'] = $user_email;
            echo "logged in". $user_email;
        }
        else{
            header("Location: /forum/index.php?signupsuccess=false&error=$showError");
        }
        header("Location: /forum/index.php");
    }   
}

?>