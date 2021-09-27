<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
      crossorigin="anonymous"
    />

    <title>iProcessor - Welcome to the best forums</title>
  </head>
  <body>
  <?php include "partials/_dbconnect.php"; ?>
    <?php require "partials/_header.php"; ?>
    

    <!-- Slider Starts here -->
    <div
      id="carouselExampleIndicators"
      class="carousel slide"
      data-bs-ride="carousel"
    >
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
      </div>
      <div class="carousel-inner carousel-fade">
        <div class="carousel-item active">
          <img src="https://source.unsplash.com/2400x800/?coding,apple" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="https://source.unsplash.com/2400x800/?programming,microsoft" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="https://source.unsplash.com/2400x800/?circuits" class="d-block w-100" alt="..." />
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- The category cards start here -->
    <h2 class="text-center my-3">Browse Categories</h2>
    <div class="container">
      <div class="row">
        <!-- Fetch all the categories and use to iiterate-->
        <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
          // echo $row['category_id'];
          // echo $row['category_name'];
          // echo $row['description'];
          // echo $row['created'];
          $catid = $row['category_id'];
          $cat = $row['category_name'];
          $desc = $row['description'];
          echo '<div class="col-md-4 my-4">
          <div class="card" style="width: 18rem">
            <img
              src="https://source.unsplash.com/500x400/?coding,electronics'.$cat.'"
              class="card-img-top"
              alt="..."
            />
            <div class="card-body">
              <h5 class="card-title"><a href="threads.php?id='.$catid.'">'.$cat.'</a></h5>
              <p class="card-text">
              ' . substr($desc, 0, 125).  '.....
              </p>
              <a href="threads.php?id='.$catid.'" class="btn btn-primary">Open Thread</a>
            </div>
          </div>
        </div>';
        }
        ?>
        <!-- use a for loop toiterate through categories -->
        

    <?php require "partials/_footer.php"; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>
