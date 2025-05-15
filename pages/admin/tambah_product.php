<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - Admin Dashboard</title>
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
                            <a class="nav-link text-white-50" href="#">
                                <i class="bi bi-house-door me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="#">
                                <i class="bi bi-file-earmark me-2"></i>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#">
                                <i class="bi bi-cart me-2"></i>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="#">
                                <i class="bi bi-people me-2"></i>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="#">
                                <i class="bi bi-bar-chart me-2"></i>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="#">
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
                            <a class="nav-link text-white-50" href="#">
                                <i class="bi bi-file-text me-2"></i>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="#">
                                <i class="bi bi-file-text me-2"></i>
                                Last quarter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <div>
                        <button class="btn btn-sm d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                            <i class="bi bi-list fs-5"></i>
                        </button>
                        <h1 class="h2 d-inline-block ms-2">Add New Product</h1>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
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
                                <img src="https://via.placeholder.com/32" class="rounded-circle me-2" width="32" height="32" alt="User">
                                <span>Admin User</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                    </ol>
                </nav>
                
                <!-- Product Form -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <form class="needs-validation" novalidate>
                            <!-- Form Tabs -->
                            <ul class="nav nav-tabs mb-4" id="productTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-controls="basic-info" aria-selected="true">Basic Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="false">Images</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pricing-tab" data-bs-toggle="tab" data-bs-target="#pricing" type="button" role="tab" aria-controls="pricing" aria-selected="false">Pricing</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab" aria-controls="inventory" aria-selected="false">Inventory</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">SEO</button>
                                </li>
                            </ul>
                            
                            <!-- Tab Content -->
                            <div class="tab-content" id="productTabContent">
                                <!-- Basic Info Tab -->
                                <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="productName" class="form-label">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="productName" placeholder="Enter product name" required>
                                            <div class="invalid-feedback">
                                                Please provide a product name.
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="sku" placeholder="Enter SKU" required>
                                            <div class="invalid-feedback">
                                                Please provide a SKU.
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="barcode" class="form-label">Barcode (ISBN, UPC, GTIN, etc.)</label>
                                            <input type="text" class="form-control" id="barcode" placeholder="Enter barcode">
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="shortDescription" class="form-label">Short Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="shortDescription" rows="3" placeholder="Enter a short description" required></textarea>
                                            <div class="invalid-feedback">
                                                Please provide a short description.
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="fullDescription" class="form-label">Full Description</label>
                                            <div class="card">
                                                <div class="card-header bg-light p-2">
                                                    <div class="btn-toolbar">
                                                        <div class="btn-group me-2">
                                                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-type-bold"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-type-italic"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-type-underline"></i>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group me-2">
                                                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-list-ul"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-list-ol"></i>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-link"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-image"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0">
                                                    <textarea class="form-control border-0" id="fullDescription" rows="6" placeholder="Enter full product description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                            <select class="form-select" id="category" required>
                                                <option value="" selected disabled>Select category</option>
                                                <option value="1">Electronics</option>
                                                <option value="2">Clothing</option>
                                                <option value="3">Home & Garden</option>
                                                <option value="4">Sports & Outdoors</option>
                                                <option value="5">Toys & Games</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a category.
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="brand" class="form-label">Brand</label>
                                            <select class="form-select" id="brand">
                                                <option value="" selected disabled>Select brand</option>
                                                <option value="1">Apple</option>
                                                <option value="2">Samsung</option>
                                                <option value="3">Nike</option>
                                                <option value="4">Adidas</option>
                                                <option value="5">Sony</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="tags" class="form-label">Tags</label>
                                            <input type="text" class="form-control" id="tags" placeholder="Enter tags separated by commas">
                                            <div class="form-text">Enter tags separated by commas (e.g., wireless, bluetooth, headphones)</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Images Tab -->
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Product Images <span class="text-danger">*</span></label>
                                            <div class="card bg-light">
                                                <div class="card-body text-center p-5">
                                                    <i class="bi bi-cloud-arrow-up fs-1 text-secondary mb-3"></i>
                                                    <h5>Drop files here or click to upload</h5>
                                                    <p class="text-muted">Upload up to 10 images (Max size: 5MB each)</p>
                                                    <input type="file" class="form-control" id="productImages" multiple accept="image/*" hidden>
                                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('productImages').click()">
                                                        <i class="bi bi-upload me-2"></i>Upload Images
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 mt-4">
                                            <h6>Preview</h6>
                                            <div class="row g-3">
                                                <div class="col-6 col-md-3">
                                                    <div class="card">
                                                        <div class="position-relative">
                                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product Image">
                                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" title="Remove">
                                                                <i class="bi bi-x"></i>
                                                            </button>
                                                            <div class="badge bg-success position-absolute bottom-0 start-0 m-2">Main Image</div>
                                                        </div>
                                                        <div class="card-body p-2">
                                                            <div class="d-flex justify-content-between">
                                                                <small class="text-muted">product1.jpg</small>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="mainImage" id="image1" checked>
                                                                    <label class="form-check-label" for="image1">
                                                                        Main
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="card">
                                                        <div class="position-relative">
                                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product Image">
                                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" title="Remove">
                                                                <i class="bi bi-x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="card-body p-2">
                                                            <div class="d-flex justify-content-between">
                                                                <small class="text-muted">product2.jpg</small>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="mainImage" id="image2">
                                                                    <label class="form-check-label" for="image2">
                                                                        Main
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Pricing Tab -->
                                <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label for="regularPrice" class="form-label">Regular Price <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="regularPrice" placeholder="0.00" step="0.01" min="0" required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid price.
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="salePrice" class="form-label">Sale Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="salePrice" placeholder="0.00" step="0.01" min="0">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="costPrice" class="form-label">Cost Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="costPrice" placeholder="0.00" step="0.01" min="0">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="taxClass" class="form-label">Tax Class</label>
                                            <select class="form-select" id="taxClass">
                                                <option value="standard">Standard</option>
                                                <option value="reduced">Reduced Rate</option>
                                                <option value="zero">Zero Rate</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="scheduleSale">
                                                <label class="form-check-label" for="scheduleSale">Schedule Sale</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="saleStart" class="form-label">Sale Start Date</label>
                                            <input type="date" class="form-control" id="saleStart">
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="saleEnd" class="form-label">Sale End Date</label>
                                            <input type="date" class="form-control" id="saleEnd">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Inventory Tab -->
                                <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inventorySku" placeholder="Enter SKU" required>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="stockStatus" class="form-label">Stock Status <span class="text-danger">*</span></label>
                                            <select class="form-select" id="stockStatus" required>
                                                <option value="instock">In Stock</option>
                                                <option value="outofstock">Out of Stock</option>
                                                <option value="onbackorder">On Backorder</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="manageStock" checked>
                                                <label class="form-check-label" for="manageStock">Manage Stock</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="stockQuantity" class="form-label">Stock Quantity</label>
                                            <input type="number" class="form-control" id="stockQuantity" placeholder="0" min="0">
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="lowStockThreshold" class="form-label">Low Stock Threshold</label>
                                            <input type="number" class="form-control" id="lowStockThreshold" placeholder="5" min="0">
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="allowBackorders">
                                                <label class="form-check-label" for="allowBackorders">Allow Backorders</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="weight" class="form-label">Weight (kg)</label>
                                            <input type="number" class="form-control" id="weight" placeholder="0.00" step="0.01" min="0">
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <label for="dimensions" class="form-label">Dimensions (cm)</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" placeholder="Length" step="0.1" min="0">
                                                <input type="number" class="form-control" placeholder="Width" step="0.1" min="0">
                                                <input type="number" class="form-control" placeholder="Height" step="0.1" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- SEO Tab -->
                                <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="metaTitle" class="form-label">Meta Title</label>
                                            <input type="text" class="form-control" id="metaTitle" placeholder="Enter meta title">
                                            <div class="form-text">Recommended length: 50-60 characters</div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="metaDescription" class="form-label">Meta Description</label>
                                            <textarea class="form-control" id="metaDescription" rows="3" placeholder="Enter meta description"></textarea>
                                            <div class="form-text">Recommended length: 150-160 characters</div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="metaKeywords" class="form-label">Meta Keywords</label>
                                            <input type="text" class="form-control" id="metaKeywords" placeholder="Enter keywords separated by commas">
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="slug" class="form-label">Product URL Slug</label>
                                            <div class="input-group">
                                                <span class="input-group-text text-muted">example.com/product/</span>
                                                <input type="text" class="form-control" id="slug" placeholder="product-url-slug">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="d-flex justify-content-between border-top mt-4 pt-4">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </button>
                                <div>
                                    <button type="button" class="btn btn-outline-primary me-2">
                                        <i class="bi bi-save me-2"></i>Save Draft
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>Publish Product
                                    </button>
                                </div>
                            </div>
                        </form>
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

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Form Validation Script -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>