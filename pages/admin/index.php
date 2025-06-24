<?php
session_start();
require '../../config/koneksi.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['admin'])) {
    header('Location: ../../auth/login.php');
    exit;
}
?>
<?php
// Ambil data statistik
$query_total_users = "SELECT COUNT(*) as total FROM users";
$result_total_users = $conn->query($query_total_users);
$total_users = $result_total_users->fetch_assoc()['total'];

$query_total_sales = "SELECT SUM(amount) as total FROM orders";
$result_total_sales = $conn->query($query_total_sales);
$total_sales = $result_total_sales->fetch_assoc()['total'] ?: 0;

$query_new_orders = "SELECT COUNT(*) as total FROM orders WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
$result_new_orders = $conn->query($query_new_orders);
$new_orders = $result_new_orders->fetch_assoc()['total'];

$query_page_views = "SELECT COUNT(*) as total FROM page_views"; // Contoh tabel page_views
$result_page_views = $conn->query($query_page_views);
$page_views = $result_page_views->fetch_assoc()['total'];

// Ambil pesanan terbaru
$query_recent_orders = "
    SELECT 
        o.order_id, 
        u.name AS customer, 
        p.product_name, 
        o.order_date, 
        o.amount, 
        o.status 
    FROM 
        orders o 
    LEFT JOIN 
        users u ON o.user_id = u.id 
    LEFT JOIN 
        products p ON o.product_id = p.id 
    ORDER BY 
        o.order_date DESC 
    LIMIT 5;
";
$result_recent_orders = $conn->query($query_recent_orders);

// Ambil aktivitas terbaru
$query_recent_activity = "
    SELECT 
        action, 
        timestamp 
    FROM 
        activity_logs 
    ORDER BY 
        timestamp DESC 
    LIMIT 5;
";
$result_recent_activity = $conn->query($query_recent_activity);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-12 col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse" id="sidebarMenu">
                <div class="position-sticky pt-3">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <span class="fs-4 text-white fw-bold">Admin Panel</span>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="index.php">
                                <i class="bi bi-house-door me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="orders.php">
                                <i class="bi bi-file-earmark me-2"></i>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="products.php">
                                <i class="bi bi-cart me-2"></i>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="customers.php">
                                <i class="bi bi-people me-2"></i>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="reports.php">
                                <i class="bi bi-bar-chart me-2"></i>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="settings.php">
                                <i class="bi bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                    
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="reports.php?period=current_month">
                                <i class="bi bi-file-text me-2"></i>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="reports.php?period=last_quarter">
                                <i class="bi bi-file-text me-2"></i>
                                Last quarter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
             <h2 class="mt-2 mb-0"><?= $total_users ?></h2>
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <div>
                        <button class="btn btn-sm d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                            <i class="bi bi-list fs-5"></i>
                        </button>
                        <h1 class="h2 d-inline-block ms-2">Dashboard</h1>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="input-group me-2">
                            <input type="text" class="form-control" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary position-relative">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-envelope"></i>
                            </button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <img src="https://placehold.co/32x32" class="rounded-circle me-2" width="32" height="32" alt="User">
                                <span>Admin User</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../../authentication/logout.php">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="bi bi-people fs-4 text-primary"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="card-title mb-0">Total Users</h6>
                        <h2 class="mt-2 mb-0"><?= number_format($total_users) ?></h2>
                        <p class="text-success mb-0"><i class="bi bi-arrow-up"></i> 12.5%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="bi bi-cart fs-4 text-success"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="card-title mb-0">Total Sales</h6>
                        <h2 class="mt-2 mb-0">$<?= number_format($total_sales, 2) ?></h2>
                        <p class="text-success mb-0"><i class="bi bi-arrow-up"></i> 8.2%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="bi bi-bag-check fs-4 text-warning"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="card-title mb-0">New Orders</h6>
                        <h2 class="mt-2 mb-0"><?= number_format($new_orders) ?></h2>
                        <p class="text-danger mb-0"><i class="bi bi-arrow-down"></i> 3.8%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <i class="bi bi-eye fs-4 text-info"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="card-title mb-0">Page Views</h6>
                        <h2 class="mt-2 mb-0"><?= number_format($page_views) ?></h2>
                        <p class="text-success mb-0"><i class="bi bi-arrow-up"></i> 24.5%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
                <!-- Charts Section -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Sales Overview</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        This Month
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="../reports/today.php">Today</a></li>
                                    <li><a class="dropdown-item" href="../reports/week.php">This Week</a></li>
                                    <li><a class="dropdown-item" href="../reports/month.php">This Month</a></li>
                                    <li><a class="dropdown-item" href="../reports/year.php">This Year</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Placeholder for chart -->
                                <div class="bg-light p-3 rounded text-center" style="height: 300px;">
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <div>
                                            <i class="bi bi-bar-chart-line fs-1 text-secondary"></i>
                                            <p class="mt-2">Sales Chart Visualization</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Traffic Sources</h5>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <!-- Placeholder for pie chart -->
                                <div class="bg-light p-3 rounded text-center" style="height: 300px;">
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <div>
                                            <i class="bi bi-pie-chart fs-1 text-secondary"></i>
                                            <p class="mt-2">Traffic Sources Chart</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Orders Table -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Orders</h5>
                        <button class="btn btn-sm btn-primary">View All</button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#ORD-0001</td>
                                        <td>John Doe</td>
                                        <td>Product A</td>
                                        <td>2023-05-12</td>
                                        <td>$120.00</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>
                                        <div class="dropdown">
                                           <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                             <i class="bi bi-three-dots-vertical"></i>
                                           </button>
                                           <ul class="dropdown-menu">
                                             <li><a class="dropdown-item" href="view_order.php?id=<?= $order['order_id'] ?>">View</a></li>
                                             <li><a class="dropdown-item" href="edit_order.php?id=<?= $order['order_id'] ?>">Edit</a></li>
                                             <li><a class="dropdown-item text-danger" href="delete_order.php?id=<?= $order['order_id'] ?>" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Delete</a></li>
                                           </ul>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-0002</td>
                                        <td>Jane Smith</td>
                                        <td>Product B</td>
                                        <td>2023-05-11</td>
                                        <td>$85.00</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td>
                                          <div class="dropdown">
                                           <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                             <i class="bi bi-three-dots-vertical"></i>
                                           </button>
                                         <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="view_order.php?id=<?= $order['order_id'] ?>">View</a></li>
                                            <li><a class="dropdown-item" href="edit_order.php?id=<?= $order['order_id'] ?>">Edit</a></li>
                                            <li><a class="dropdown-item text-danger" href="delete_order.php?id=<?= $order['order_id'] ?>" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Delete</a></li>
                                         </ul>
                                         </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-0003</td>
                                        <td>Robert Johnson</td>
                                        <td>Product C</td>
                                        <td>2023-05-10</td>
                                        <td>$240.00</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="view_order.php?id=<?= $order['order_id'] ?>">View</a></li>
                                                    <li><a class="dropdown-item" href="edit_order.php?id=<?= $order['order_id'] ?>">Edit</a></li>
                                                    <li><a class="dropdown-item text-danger" href="delete_order.php?id=<?= $order['order_id'] ?>" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-0004</td>
                                        <td>Emily Davis</td>
                                        <td>Product D</td>
                                        <td>2023-05-09</td>
                                        <td>$65.00</td>
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="dropdown-item" href="view_order.php?id=<?= $order['order_id'] ?>">View</a></li>
                                                    <li><a class="dropdown-item" href="edit_order.php?id=<?= $order['order_id'] ?>">Edit</a></li>
                                                    <li><a class="dropdown-item text-danger" href="delete_order.php?id=<?= $order['order_id'] ?>" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-0005</td>
                                        <td>Michael Wilson</td>
                                        <td>Product E</td>
                                        <td>2023-05-08</td>
                                        <td>$195.00</td>
                                        <td><span class="badge bg-info">Shipped</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="dropdown-item" href="view_order.php?id=<?= $order['order_id'] ?>">View</a></li>
                                                    <li><a class="dropdown-item" href="edit_order.php?id=<?= $order['order_id'] ?>">Edit</a></li>
                                                    <li><a class="dropdown-item text-danger" href="delete_order.php?id=<?= $order['order_id'] ?>" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity and Quick Actions -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="card-title mb-0">Recent Activity</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 d-flex">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-person-plus text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold">New user registered</p>
                                            <small class="text-muted">5 minutes ago</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 d-flex">
                                        <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-cart-check text-success"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold">New order placed</p>
                                            <small class="text-muted">15 minutes ago</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 d-flex">
                                        <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold">Server warning received</p>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 d-flex">
                                        <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-gear text-info"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold">System updated</p>
                                            <small class="text-muted">3 hours ago</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 d-flex">
                                        <div class="bg-danger bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-x-circle text-danger"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold">Order #2345 cancelled</p>
                                            <small class="text-muted">5 hours ago</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="card-title mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
    <div class="d-grid gap-2">
        <!-- Add New Product -->
        <a href="products.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>
            Add New Product
        </a>

        <!-- Manage Users -->
        <a href="customers.php" class="btn btn-outline-primary">
            <i class="bi bi-people me-2"></i>
            Manage Users
        </a>

        <!-- System Settings -->
        <a href="settings.php" class="btn btn-outline-primary">
            <i class="bi bi-gear me-2"></i>
            System Settings
        </a>

        <!-- Generate Report -->
        <a href="reports.php" class="btn btn-outline-primary">
            <i class="bi bi-file-earmark-text me-2"></i>
            Generate Report
        </a>

        <!-- Help & Support -->
        <a href="help.php" class="btn btn-outline-primary">
            <i class="bi bi-question-circle me-2"></i>
            Help & Support
        </a>
    </div>
</div></tr>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    <p class="col-md-4 mb-0 text-muted">&copy; 2023 Admin Dashboard</p>
                    <ul class="nav col-md-4 justify-content-end">
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                    </ul>
                </footer>
            </div>
        </div>
    </div>
    <li><a class="dropdown-item" href="../../authentication/logout.php">Sign out</a></li>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$order_query = "SELECT * FROM orders ORDER BY order_date DESC LIMIT 5";
$order_result = $conn->query($order_query);
?>

<?php while ($order = $order_result->fetch_assoc()): ?>
<tr>
    <td><?= $order['order_id'] ?></td>
    <td><?= $order['customer_name'] ?></td>
    <td><?= $order['product_name'] ?></td>
    <td><?= $order['order_date'] ?></td>
    <td>$<?= number_format($order['amount'], 2) ?></td>
    <td><span class="badge bg-success"><?= $order['status'] ?></span></td>
</tr>
<?php endwhile; ?>