<?php
session_start();
$user_id = $_SESSION['user_id'];
include 'config/koneksi.php';
$u = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id"));
include 'config/koneksi.php';

if (isset($_GET['error'])) {
    $error = $_GET['error'];
    echo "<script>alert('$error')</script>";
}

if (isset($_GET['success'])) {
    $success = $_GET['success'];
    echo "<script>alert('$success')</script>";
}

if (isset($_GET['logout'])) {
    $logout = $_GET['logout'];
    echo "<script>alert('$logout')</script>";
}

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    echo "<script>alert('$status')</script>";
}
$products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$cart = mysqli_query($conn, "SELECT c.id as cart_id, c.user_id, c.product_id, c.quantity, p.name, p.price, p.image_url FROM carts c JOIN products p ON c.product_id = p.id WHERE c.user_id = " . $user_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Shop</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap core CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex me-3">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <form class="d-flex">
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?= array_sum(array_column($cart->fetch_all(MYSQLI_ASSOC), 'quantity')); ?></span>
                    </button>
                </form>

            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($products as $product): ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image -->
                            <img class="card-img-top" src="./uploads/<?= $product['image_url'] ?>" alt="...">

                            <!-- Product details -->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name -->
                                    <h5 class="fw-bolder"><?= $product['name'] ?></h5>
                                    <!-- Product price -->
                                    $<?= $product['price'] ?>
                                </div>
                            </div>

                            <button class="btn btn-outline-dark mt-auto" onclick="addToCart(<?= $product['id'] ?>)">
                                Add to Cart
                            </button>


                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>

    <!-- Modal Notifikasi -->
    <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="cartModalLabel">🛒 Keranjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="cartModalBody">
                    Produk berhasil ditambahkan ke keranjang!
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Keranjang -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="cartModalLabel">🛒 Keranjang Belanja</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    $total = 0;
                    if ($cart): ?>
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $id => $item):
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                ?>
                                    <tr>
                                        <td>
                                            <img src="./uploads/<?= $item['image_url'] ?>" width="60" class="me-2">
                                            <?= $item['name'] ?>
                                        </td>
                                        <td>
                                            <form method="post" action="update_cart.php" class="d-flex gap-1">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <input type="number" name="qty" value="<?= $item['quantity'] ?>" min="1" class="form-control form-control-sm w-50">
                                                <button class="btn btn-sm btn-secondary">Ubah</button>
                                            </form>
                                        </td>
                                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                        <td>
                                            <form method="post" action="remove_cart.php">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total</td>
                                    <td colspan="2" class="fw-bold">Rp <?= number_format($total, 0, ',', '.') ?></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="text-end">
                            <a href="pages/user/checkout.php" class="btn btn-success">Checkout Sekarang</a>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted">Keranjang masih kosong 😢</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    <script>
        function addToCart(productId) {
            fetch('logic/addtocart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'product_id=' + encodeURIComponent(productId)
                })
                .then(response => response.text())
                .then(result => {
                    // Masukkan respon ke body modal
                    document.getElementById('cartModalBody').textContent = result;
                    // Tampilkan modal
                    const cartModal = new bootstrap.Modal(document.getElementById('addToCartModal'));
                    cartModal.show();

                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

</body>

</html>