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
                    <h3 class="mb-0">Edit Customer</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/product">Customer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <form method="POST" action="/customer">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($customer['id']) ?>">

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name"
                            value="<?= htmlspecialchars($old['name'] ?? $customer['name'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['name'] ?? '' ?></p>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                            value="<?= htmlspecialchars($old['email'] ?? $customer['email'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['email'] ?? '' ?></p>
                    </div>
                    <!-- phone -->
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="phone" name="phone"
                            value="<?= htmlspecialchars($old['phone'] ?? $customer['phone'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['email'] ?? '' ?></p>
                    </div>
                    <!-- Address -->
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address"
                            value="<?= htmlspecialchars($old['address'] ?? $customer['address'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['address'] ?? '' ?></p>
                    </div>

                    <!-- total amount -->
                    <div class="mb-3">
                        <label class="form-label">Total Amount</label>
                        <input type="number" step="0.01" name="total_amount"
                            value="<?= htmlspecialchars($old['total_amount'] ?? $customer['total_amount'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['total_amount'] ?? '' ?></p>
                    </div>
                    <!-- due amount -->
                    <div class="mb-3">
                        <label class="form-label">Due Amount</label>
                        <input type="number" step="0.01" name="due_amount"
                            value="<?= htmlspecialchars($old['due_amount'] ?? $customer['due_amount'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['due_amount'] ?? '' ?></p>
                    </div>
                    <!-- paid amount -->
                    <div class="mb-3">
                        <label class="form-label">Paid Amount</label>
                        <input type="number" step="0.01" name="paid_amount"
                            value="<?= htmlspecialchars($old['paid_amount'] ?? $customer['paid_amount'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['total_amount'] ?? '' ?></p>
                    </div>
                    <!-- total amount -->
                    <div class="mb-3">
                        <label class="form-label">Discount Amount</label>
                        <input type="number" step="0.01" name="discount_amount"
                            value="<?= htmlspecialchars($old['discount_amount'] ?? $customer['discount_amount'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['discount_amount'] ?? '' ?></p>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php'); ?>