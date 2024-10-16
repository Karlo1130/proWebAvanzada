<?php

  session_start();

  if(!isset($_SESSION['data'])){
    header("Location: index.php");
    exit;
}

  $data = $_SESSION['data'];

  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$data['token']),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  $response = json_decode($response, true);
  $data = $response['data'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar scroll</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Link
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Link</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <div class="dropdown px-3">
            <a href="" class="d-flex align-items-center dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name=Karlo+Salvador&size=32" class="rounded-circle me-2" alt="">
                <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li>
                    <a href="" class="dropdown-item">New project...</a>
                </li>
                <li>
                    <a href="" class="dropdown-item">Settings</a>
                </li>
                <li>
                    <a href="" class="dropdown-item">Profile</a>
                </li>
                <li>
                    <hr style="border-color: gray;">
                </li>
                <li>
                    <a href="" class="dropdown-item">Sign out</a>
                </li>
            </ul>
        </div>
        </div>
      </div>
  </nav>

  <main class="container-fluid d-flex">

    <div class="row p-3 g-3">
      <?php foreach ($data as $tarjeta): ?>
        <div class="card p-1 m-2" style="width: 18rem;">
          <img class="card-img-top" src="<?php echo $tarjeta['cover']; ?>" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?php echo $tarjeta['name']; ?></h5>
            <p class="card-text"><?php echo $tarjeta['description']; ?></p>
            <a href="details.php?slug=<?php echo $tarjeta['slug']; ?>" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </main>

  <div class="offcanvas offcanvas-start show p-3 d-flex flex-column flex-shrink-0 bg-dark fixed-bottom" tabindex="-1">
      <div class="offcanvas-header">
          <h5 class="offcanvas-title text-white">Sidebar</h5>
      </div>
      <hr style="border-color: gray;">
      <div class="offcanvas-body">
          <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                  <a class="text-white nav-link active" href="">Home</a>
              </li>
              <li class="nav-item">
                  <a class="text-white nav-link" href="">Dashboard</a>
              </li>
              <li class="nav-item">
                  <a class="text-white nav-link" href="">Orders</a>
              </li>
              <li class="nav-item">
                  <a class="text-white nav-link" href="">Products</a>
              </li>
              <li class="nav-item">
                  <a class="text-white nav-link" href="">Customers</a>
              </li>
          </ul>
      </div>
      <hr style="border-color: gray;">
      <div class="dropdown">
          <a href="" class="d-flex align-items-center dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown">
              <img src="https://ui-avatars.com/api/?name=Karlo+Salvador&size=32" class="rounded-circle me-2" alt="">
              <strong>mdo</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
              <li>
                  <a href="" class="dropdown-item">New project...</a>
              </li>
              <li>
                  <a href="" class="dropdown-item">Settings</a>
              </li>
              <li>
                  <a href="" class="dropdown-item">Profile</a>
              </li>
              <li>
                  <hr style="border-color: gray;">
              </li>
              <li>
                  <a href="" class="dropdown-item">Sign out</a>
              </li>
          </ul>
      </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>