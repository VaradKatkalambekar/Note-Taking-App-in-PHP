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

    <!-- The search start here -->
    <div class="container my-3">
        <h1 class="text-center">Here are your Search Results for <em>"<?php echo $_GET['search']; ?>"</em></h1>
        <?php
                $noresult = true;
                $query = $_GET['search'];
                $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$query')";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $thread_title = $row['thread_title'];
                    $thread_desc = $row['thread_desc'];
                    $thread_id=$row['thread_id'];
                    $url = "thread.php?threadid=". $thread_id;
                    $noresult = false;
                    //display search results

                    echo '<div class="result">
                    <h3 class="text-center"><a href="'.$url.'" class="text-dark">'. $thread_title .'</a></h3>
                    <p class="text-center">'. $thread_desc .'</p>
                    </div>
                    </div>';
                }
                
                if($noresult){
                    echo '<div class="container ">
                    <div class="card my-3">
                        <h2 class="card-header text-center"><?php echo $thread_title; ?></h2>
                        <div class="card-body">
                            <h5 class="card-title">Error! No results were found for <em>"'.$_GET['search'].'"</em></h5>
                            <p class="card-text">
                            <b>Suggestions:<br>
                            Make sure that all words are spelled correctly.<br>
                            Try different keywords.<br>
                            Try more general keywords.<br></b>
                            </p>
                            <p>Posted By <b><?php echo $posted_by; ?></b></p>
                        </div>
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