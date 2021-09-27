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
    $catid= $_GET['id'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $catid";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['description'];
    }
    ?>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //Insert data in datbase
        $showAlert=false;
        $th_title= $_POST['title'];
        $th_desc= $_POST['desc'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 

        $srn = $_POST['srn'];
        $sql="INSERT INTO `threads`( `thread_title`, `thread_desc`, `thread_user_id`, `thread_cat_id`) VALUES ('$th_title','$th_desc','$srn','$catid')";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Your Question was added!</strong> Please wait for community to respond!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

    }
    ?>


    <!-- The category cards start here -->
    <div class="container ">
        <div class="card my-3">
            <h1 class="card-header text-center">Welcome to <?php echo $catname; ?> Forums</h1>
            <div class="card-body">
                <h5 class="card-title"><?php echo $catdesc; ?></h5>
                <p class="card-text">Peer to peer Forum. Forum Rules
                    No Spam / Advertising / Self-promote in the forums.
                    Do not post copyright-infringing material.
                    Do not post “offensive” posts, links or images.
                    Do not cross post questions.
                    Remain respectful of other members at all times.</p>
                <a href="#" class="btn btn-success">Learn More</a>
            </div>
        </div>
    </div>

    <?php
    
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
    echo'
    <div class="container">
        <h3 class="py-2 text-center">Ask a Question!</h3>
        <form action=" '. $_SERVER["REQUEST_URI"] .' " method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep the title short and crisp...</div>
            </div>
            <input type="hidden" name="srn" value="'.$_SESSION["srn"].'">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Elaborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';}
    
    else{
    echo '<div class="container">
    <h1 class="py-2 text-center">Start a discussion</h1>
    <p class="text-center"><b>You are not logged in! Please be logged in to start a discussion</b></p>
    </div>';
    }
    ?>

    

    <div class="container">
        <h3 class="py-2 text-center">Browse Through the questions</h3>

        <?php
        $catid= $_GET['id'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $catid";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $thread_id = $row['thread_id'];
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thtime = $row['timestamp'];
            $userid = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE srn= '$userid'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

        
        echo '<div class="media d-flex align-self-center my-3">
            <div class="flex-shrink-0">
                <img src="img/userdef.png" width="80px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
           
                <h5><a class="text-dark" href="thread.php?threadid='.$thread_id.'">'.$thread_title.'</a></h5>
                '.$thread_desc.' <div class="font-weight-bold my-0"><b>Asked by '. $row2['user_email'] . ' at '.$thtime.'</b></div>
            </div>
        </div>';
    }
    if($noResult){
        echo '<div class="card text-center my-3">
        <div class="card-body">
          <h5 class="card-title">No Questions Found :(</h5>
          <p class="card-text">Be the first one to ask a question!</p>
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