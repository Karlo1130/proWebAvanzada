<?php

include 'app/productController.php';

if (!isset($_SESSION['data'])) {
	header("Location: index.php");
	exit;
}

$productController = new ProductController();

$data = $productController->getProducts();

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Home
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>

<body>

	<div class="">

		<div class="container-fluid">
			<div class="row">
				<div class="col-2 p-0 m-0 d-none d-md-block">
					<div class="d-flex flex-column min-vh-100 flex-shrink-0 p-3 text-white bg-dark">
						<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
							<svg class="bi me-2" width="40" height="32">
								<use xlink:href="#bootstrap"></use>
							</svg>
							<span class="fs-4">Sidebar</span>
						</a>
						<hr>
						<ul class="nav nav-pills  flex-column mb-auto">
							<li class="nav-item">
								<a href="#" class="nav-link active" aria-current="page">
									<svg class="bi me-2" width="16" height="16">
										<use xlink:href="#home"></use>
									</svg>
									Home
								</a>
							</li>
							<li>
								<a href="#" class="nav-link text-white">
									<svg class="bi me-2" width="16" height="16">
										<use xlink:href="#speedometer2"></use>
									</svg>
									Dashboard
								</a>
							</li>
							<li>
								<a href="#" class="nav-link text-white">
									<svg class="bi me-2" width="16" height="16">
										<use xlink:href="#table"></use>
									</svg>
									Orders
								</a>
							</li>
							<li>
								<a href="#" class="nav-link text-white">
									<svg class="bi me-2" width="16" height="16">
										<use xlink:href="#grid"></use>
									</svg>
									Products
								</a>
							</li>
							<li>
								<a href="#" class="nav-link text-white">
									<svg class="bi me-2" width="16" height="16">
										<use xlink:href="#people-circle"></use>
									</svg>
									Customers
								</a>
							</li>
						</ul>
						<hr>
						<div class="dropdown">
							<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
								<strong>mdo</strong>
							</a>
							<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
								<li><a class="dropdown-item" href="#">New project...</a></li>
								<li><a class="dropdown-item" href="#">Settings</a></li>
								<li><a class="dropdown-item" href="#">Profile</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="#">Sign out</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col p-0 m-0">
					<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dar" data-bs-theme="dark">
						<div class="container">
							<a class="navbar-brand" href="#">Navbar</a>
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>


							<div class="collapse navbar-collapse" id="navbarNav">
								<ul class="navbar-nav">
									<li class="nav-item">
										<a class="nav-link active" aria-current="page" href="#">Home</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">Features</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">Pricing</a>
									</li>
									<li class="nav-item">
										<a class="nav-link disabled" aria-disabled="true">Disabled</a>
									</li>
								</ul>
							</div>

							<form class="d-flex" role="search">
								<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
								<button class="btn btn-outline-success" type="submit">Search</button>
							</form>

							<div class="dropdown">
								<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
									<img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
									<strong>mdo</strong>
								</a>
								<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
									<li><a class="dropdown-item" href="#">New project...</a></li>
									<li><a class="dropdown-item" href="#">Settings</a></li>
									<li><a class="dropdown-item" href="#">Profile</a></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="#">Sign out</a></li>
								</ul>
							</div>
						</div>
					</nav>

					<main class="container-fluid d-flex flex-column">

						<div class="d-flex justify-content-end m-3">
							<?php
							if (!isset($_SESSION['data'])) {
								$idModal = 'loginModal';
							} else {
								$idModal = 'addProductModal';
							}
							?>
							<!-- <button class="btn btn-success w-auto" data-bs-toggle="modal" data-bs-target="#<?php //echo $idModal 
																												?>">Add</button> -->
							<button class="btn btn-success w-auto" data-bs-toggle="modal" data-bs-target="#addProductModal">Add</button>
						</div>

						<div class="row p-3 g-3">
							<?php foreach ($data as $tarjeta): ?>
								<div class="card p-1 m-2" style="width: 18rem;">
									<img class="card-img-top" src="<?php echo $tarjeta['cover']; ?>" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title"><?php echo $tarjeta['name']; ?></h5>
										<p class="card-text"><?php echo $tarjeta['description']; ?></p>
										<div class="d-flex flex-column gap-1">
											<a href="details.php?slug=<?php echo $tarjeta['slug']; ?>" class="btn btn-primary">Go somewhere</a>
											<!-- <a href="edit.php?slug=<?php //echo $tarjeta['slug']; 
																		?>" class="btn btn-warning">Edit</a> -->
											<?php
											if (!isset($_SESSION['data'])) {
												$idModal = 'loginModal';
											} else {
												$idModal = 'editProductModal';
											}
											?>
											<!-- <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#<?php //echo $idModal 
																															?>">Edit</button> -->
											<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal"
												data-bs-whatever='<?php echo $tarjeta['name'] . '|' . $tarjeta['slug'] . '|' . $tarjeta['description'] . '|' . $tarjeta['features'] . '|' . $tarjeta['id']; ?>'>
												Edit
											</button>
											<button class="btn btn-danger" onclick="alert(<?php echo $tarjeta['id'] ?>)">Delete</button>
											
											
											<form method="POST" action="app/productController.php" id="buttonIdHidden">
			
												<input type="hidden" name="buttonIdHidden" value="buttonIdHidden" id="buttonIdHidden">
                							</form>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>

					</main>

				</div>
			</div>
		</div>

	</div>

	<?php
		include 'modal/loginModal.php';
		include 'modal/addProductModal.php';
		include 'modal/editProductModal.php';
	?>

	<script>
		function alert(productId) {
			
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!"
				}).then((result) => {
				if (result.isConfirmed) {
					
					document.getElementById("valueIdHidden").value = productId
					document.getElementById("buttonIdHidden").submit
					console.log("hola");
					

					Swal.fire({
					title: "Deleted!",
					text: "Your file has been deleted.",
					icon: "success"
					});
				}
			});
		}
	</script>

	<script src="modal/modal.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>