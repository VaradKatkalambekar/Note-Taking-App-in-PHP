<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />

    <title>iProcessor - Welcome to the best forums</title>
</head>

<body>
    <?php include "partials/_dbconnect.php"; ?>
    <?php require "partials/_header.php"; ?>
    

    <?php
    $threadid= $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $threadid";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];

        //Query to show who posted the question
        $sql2 = "SELECT user_email FROM `users` WHERE srn= '$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];

    }
    ?>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //Insert data in comment datbase
        $showAlert=false;
        $comment= $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment); 
        $srn = $_POST['srn'];
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`) VALUES ('$comment', '$threadid', '$srn')";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Your Comment was added!</strong> Thnk you for your contribution!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

    }
    ?>


    <!-- The category cards start here -->
    <div class="container ">
        <div class="card my-3">
            <h2 class="card-header text-center"><?php echo $thread_title; ?></h2>
            <div class="card-body">
                <h5 class="card-title"><?php echo $thread_desc; ?></h5>
                <p class="card-text">Peer to peer Forum. Forum Rules
                    No Spam / Advertising / Self-promote in the forums.
                    Do not post copyright-infringing material.
                    Do not post “offensive” posts, links or images.
                    Do not cross post questions.
                    Remain respectful of other members at all times.</p>
                <p>Posted By <b><?php echo $posted_by; ?></b></p>
            </div>
        </div>
    </div>


    
    <?php
   
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
    echo '<div class="container">
        <h3 class="py-2 text-center">Post a Comment</h3>
        <form action='.$_SERVER['REQUEST_URI'].' method="post">
        <div class="container">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type Your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="srn" value="'.$_SESSION["srn"].'">
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </div>
        </form>
     </div>';}
    
    else{
    echo '<div class="container">
    <h1 class="py-2 text-center">Post a Comment</h1>
    <p class="text-center"><b>You are not logged in! Please be logged in to post a comment</b></p>
    </div>';
    }
    ?>

    <div class="container">
        <h3 class="py-2 text-center">Discussions</h3>

        <?php
        $catid= $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id = $catid";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['comment_id'];
            $comment = $row['comment_content'];
            $comtime = $row['comment_time'];
            $userid = $row['comment_by'];

            $sql2 = "SELECT user_email FROM `users` WHERE srn= '$userid'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
        
        echo '<div class="media d-flex align-self-center my-3">
            <div class="flex-shrink-0">
                <img src="img/userdef.png" width="80px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
            <p class="font-weight-bold my-0"><b>Comment by '. $row2['user_email'] .' at '.$comtime.'</b></p>
                '.$comment.'
            </div>
        </div>';
    }
    if($noResult){
        echo '<div class="card text-center my-3">
        <div class="card-body">
          <h5 class="card-title">No Comments Found :(</h5>
          <p class="card-text">Be the first one to answer this question!</p>
        </div>
      </div>';
    }
    ?>
    </div>

    <?php require "partials/_footer.php"; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>