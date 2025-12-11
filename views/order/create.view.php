<?php
    require base_path('views/partials/head.php');
    require base_path('views/partials/header.php');

    require base_path('views/partials/nav.php');
?>

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Create New Order</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/orders">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Order Form Card -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-cart-plus me-2"></i>Order Information
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="/order" id="orderForm">

                                <!-- Customer Selection -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-person-circle me-1"></i>Customer
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <select name="customer_id" id="customer_id" class="form-select form-select-lg" required style="padding-right: 50px;">
                                            <option value="">-- Select Customer --</option>
                                            <?php foreach ($customers as $c): ?>
                                                <option value="<?php echo $c['id'] ?>"<?php echo(isset($old['customer_id']) && $old['customer_id'] == $c['id']) ? 'selected' : '' ?>>
                                                    <?php echo htmlspecialchars($c['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="button"
                                                class="btn btn-success btn-sm position-absolute"
                                                style="top: 50%; right: 8px; transform: translateY(-50%); z-index: 5;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addCustomerModal"
                                                title="Add New Customer">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </div>
                                    <?php if (isset($errors['customer_id'])): ?>
                                        <div class="text-danger mt-1 small">
                                            <i class="bi bi-exclamation-circle"></i>                                                                                     <?php echo $errors['customer_id'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Product Selection -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-box-seam me-1"></i>Product
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <select name="product_id" id="product_id" class="form-select form-select-lg" required style="padding-right: 50px;">
                                            <option value="">-- Select Product --</option>
                                            <?php foreach ($products as $product): ?>
                                                <option value="<?php echo $product['id'] ?>"<?php echo(isset($old['product_id']) && $old['product_id'] == $product['id']) ? 'selected' : '' ?>>
                                                    <?php echo htmlspecialchars($product['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="button"
                                                class="btn btn-success btn-sm position-absolute"
                                                style="top: 50%; right: 8px; transform: translateY(-50%); z-index: 5;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addProductModal"
                                                title="Add New Product">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </div>
                                    <?php if (isset($errors['product_id'])): ?>
                                        <div class="text-danger mt-1 small">
                                            <i class="bi bi-exclamation-circle"></i>                                                                                     <?php echo $errors['product_id'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Discount and Delivery Date Row -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">
                                            <i class="bi bi-percent me-1"></i>Discount
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">
                                                <i class="bi bi-tag"></i>
                                            </span>
                                            <input type="number"
                                                   step="0.01"
                                                   name="discount"
                                                   value="<?php echo htmlspecialchars($old['discount'] ?? 0) ?>"
                                                   class="form-control"
                                                   placeholder="0.00">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <?php if (isset($errors['discount'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="bi bi-exclamation-circle"></i>                                                                                         <?php echo $errors['discount'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">
                                            <i class="bi bi-calendar-event me-1"></i>Delivery Date
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">
                                                <i class="bi bi-truck"></i>
                                            </span>
                                            <input type="date"
                                                   name="delivery_date"
                                                   value="<?php echo htmlspecialchars($old['delivery_date'] ?? '') ?>"
                                                   class="form-control">
                                        </div>
                                        <?php if (isset($errors['delivery_date'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="bi bi-exclamation-circle"></i>                                                                                         <?php echo $errors['delivery_date'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Remarks -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-chat-left-text me-1"></i>Remarks
                                    </label>
                                    <textarea name="remarks"
                                              class="form-control form-control-lg"
                                              rows="4"
                                              placeholder="Add any additional notes or special instructions..."><?php echo htmlspecialchars($old['remarks'] ?? '') ?></textarea>
                                    <?php if (isset($errors['remarks'])): ?>
                                        <div class="text-danger mt-1 small">
                                            <i class="bi bi-exclamation-circle"></i>                                                                                     <?php echo $errors['remarks'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Form Actions -->
                                <div class="d-flex gap-2 justify-content-end border-top pt-3">
                                    <a href="/orders" class="btn btn-secondary btn-lg">
                                        <i class="bi bi-x-circle me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle me-1"></i>Create Order
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->
</main>

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addCustomerModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Add New Customer
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCustomerForm">
                    <div class="mb-3">
                        <label for="customer_name" class="form-label fw-bold">
                            Customer Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="customer_name" name="name" required placeholder="Enter customer name">
                    </div>
                    <div class="mb-3">
                        <label for="customer_email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="customer_email" name="email" placeholder="customer@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="customer_phone" class="form-label fw-bold">Phone</label>
                        <input type="text" class="form-control" id="customer_phone" name="phone" placeholder="+880 1XXX-XXXXXX">
                    </div>
                    <div class="mb-3">
                        <label for="customer_address" class="form-label fw-bold">Address</label>
                        <textarea class="form-control" id="customer_address" name="address" rows="2" placeholder="Enter customer address"></textarea>
                    </div>
                     <!-- Total Amount -->
                    <div class="mb-3">
                        <label for="total_amount" class="form-label fw-bold">Total Amount</label>
                        <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" placeholder="0.00">
                    </div>

                    <!-- Paid Amount -->
                    <div class="mb-3">
                        <label for="paid_amount" class="form-label fw-bold">Paid Amount</label>
                        <input type="number" step="0.01" class="form-control" id="paid_amount" name="paid_amount" placeholder="0.00">
                    </div>

                    <!-- Due Amount -->
                    <div class="mb-3">
                        <label for="due_amount" class="form-label fw-bold">Due Amount</label>
                        <input type="number" step="0.01" class="form-control" id="due_amount" name="due_amount" placeholder="0.00">
                    </div>

                    <!-- Discount Amount -->
                    <div class="mb-3">
                        <label for="discount_amount" class="form-label fw-bold">Discount Amount</label>
                        <input type="number" step="0.01" class="form-control" id="discount_amount" name="discount_amount" placeholder="0.00">
                    </div>
                    <div id="customerFormError" class="alert alert-danger d-none">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <span id="customerErrorText"></span>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-primary" id="saveCustomerBtn">
                    <i class="bi bi-check-circle me-1"></i>Save Customer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addProductModalLabel">
                    <i class="bi bi-box-seam me-2"></i>Add New Product
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                    <div class="mb-3">
                        <label for="product_name" class="form-label fw-bold">
                            Product Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="product_name" name="name" required placeholder="Enter product name">
                    </div>
                    <div class="mb-3">
                        <label for="product_size" class="form-label fw-bold">Size</label>
                        <input type="text" class="form-control" id="product_size" name="size" placeholder="Enter size">
                    </div>
                    <div class="mb-3">
                        <label for="product_price" class="form-label fw-bold">Price</label>
                        <input type="number" step="0.01" class="form-control" id="product_price" name="price" placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label for="product_color" class="form-label fw-bold">Color</label>
                        <input type="text" class="form-control" id="product_color" name="color" placeholder="Enter color">
                    </div>

                    <div class="mb-3">
                        <label for="product_material" class="form-label fw-bold">Material</label>
                        <input type="text" class="form-control" id="product_material" name="material" placeholder="Enter material">
                    </div>

                    <div class="mb-3">
                        <label for="product_description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control" id="product_description" name="description" rows="2" placeholder="Enter product description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="product_images" class="form-label fw-bold">Images</label>
                        <input type="file" class="form-control" id="product_images" name="images[]" multiple>
                    </div>
                    <div id="productFormError" class="alert alert-danger d-none">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <span id="productErrorText"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-primary" id="saveProductBtn">
                    <i class="bi bi-check-circle me-1"></i>Save Product
                </button>
            </div>
        </div>
    </div>
</div>
<?php require base_path('views/partials/footer.php')?>

<script>
// Customer Modal Handler
document.getElementById('saveCustomerBtn').addEventListener('click', function() {
    const form = document.getElementById('addCustomerForm');
    const formData = new FormData(form);
    const errorDiv = document.getElementById('customerFormError');
    const errorText = document.getElementById('customerErrorText');

    errorDiv.classList.add('d-none');
    this.disabled = true;
    this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Saving...';

    fetch('/customer', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // Indicate AJAX request
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const select = document.getElementById('customer_id');
            const option = new Option(data.name, data.customer_id, true, true);
            select.add(option);

            const modal = bootstrap.Modal.getInstance(document.getElementById('addCustomerModal'));
            modal.hide();
            form.reset();

            // Show success message
            showToast('Customer added successfully!', 'success');
        } else {
            if(data.errors){
                let messages = [];
                for (const key in data.errors) {
                    messages.push(data.errors[key]);
                }
                errorText.innerHTML = messages.join('<br>');
            }
            else{

                errorText.textContent = data.message || 'Failed to create customer';
            }
            errorDiv.classList.remove('d-none');
        }
    })
    .catch(error => {
        errorText.textContent = 'An error occurred. Please try again.';
        errorDiv.classList.remove('d-none');
    })
    .finally(() => {
        this.disabled = false;
        this.innerHTML = '<i class="bi bi-check-circle me-1"></i>Save Customer';
    });
});

// Product Modal Handler
document.getElementById('saveProductBtn').addEventListener('click', function() {
    const form = document.getElementById('addProductForm');
    const formData = new FormData(form);
    const errorDiv = document.getElementById('productFormError');
    const errorText = document.getElementById('productErrorText');

    errorDiv.classList.add('d-none');
    this.disabled = true;
    this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Saving...';

    fetch('/product', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // Indicate AJAX request
        }

    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const select = document.getElementById('product_id');
            const option = new Option(data.name, data.product_id, true, true);
            select.add(option);

            const modal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
            modal.hide();
            form.reset();

            showToast('Product added successfully!', 'success');
        } else {
            if(data.errors){
                let messages = [];
                for (const key in data.errors) {
                    messages.push(data.errors[key]);
                }
                errorText.innerHTML = messages.join('<br>');
            }
            else{
            errorText.textContent = data.message || 'Failed to create product';
        }
        errorDiv.classList.remove('d-none');
    }
    })
    .catch(error => {
        errorText.textContent = 'An error occurred. Please try again.';
        errorDiv.classList.remove('d-none');
    })
    .finally(() => {
        this.disabled = false;
        this.innerHTML = '<i class="bi bi-check-circle me-1"></i>Save Product';
    });
});

// Reset forms when modals close
document.getElementById('addCustomerModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('addCustomerForm').reset();
    document.getElementById('customerFormError').classList.add('d-none');
});

document.getElementById('addProductModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('addProductForm').reset();
    document.getElementById('productFormError').classList.add('d-none');
});

// Toast notification helper
function showToast(message, type = 'success') {
    const toastHtml = `
        <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle-fill me-2"></i>${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;

    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }

    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    const toastElement = toastContainer.lastElementChild;
    const toast = new bootstrap.Toast(toastElement);
    toast.show();

    toastElement.addEventListener('hidden.bs.toast', () => {
        toastElement.remove();
    });
}
</script>

<style>
/* Custom styling for better visual appeal */
.form-select, .form-control {
    border-radius: 0.5rem;
    border: 2px solid #e0e0e0;
    transition: all 0.3s ease;
}

.form-select:focus, .form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}

.card {
    border: none;
    border-radius: 1rem;
}

.card-header {
    border-radius: 1rem 1rem 0 0 !important;
    padding: 1.25rem 1.5rem;
}

.btn {
    border-radius: 0.5rem;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.modal-content {
    border-radius: 1rem;
    border: none;
}

.modal-header {
    border-radius: 1rem 1rem 0 0;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 2px solid #e0e0e0;
    border-right: none;
}

.input-group .form-control {
    border-left: none;
}

.input-group-text + .form-control:focus {
    border-left: none;
}
</style>
