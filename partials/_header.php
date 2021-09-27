<?php 
include "partials/_dbconnect.php";

session_start();


echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/forum">iProcessor</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Top Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';


                    $sql = "SELECT category_name, category_id FROM `categories` LIMIT 5";
                    $result=mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
 
                        echo '<a class="dropdown-item" href="threads.php?id='.$row['category_id'].'">' . $row['category_name'] . '</a>';
                       
                    }


                    echo '</ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="contact.php">Contact </a>
                </li>
            </ul>';

            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']=true){
                echo '<form class="d-flex" method="get" action="search.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <p class="text-light mx-2 my-0" >Welcome '.$_SESSION['user_email'].'</p>
            <div class="mx-2">
                <a role="button" href="partials/_logout.php" class="btn btn-outline-success" >Log Out</a>
            </div>
            ';

            }
            else{

            echo '<form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <div class="mx-2">
                <button class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
            </div>
        </div>';}


    echo '</div>
</nav>';
?>

<?php include 'partials/_loginmodal.php';?>
<?php include 'partials/_signup.php';?>

<?php if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> You can now Login....
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else if(isset($_GET['error']) && $_GET['signupsuccess']=="false"){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    <strong>Failure!</strong> Could not create account
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>