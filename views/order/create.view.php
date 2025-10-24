<?php
 require base_path('views/partials/head.php');
 require base_path('views/partials/header.php') ;

 require base_path('views/partials/nav.php');
?>

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Customer</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/customer">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <form method="POST" action="/order">
    <div class="mb-3">
        <label class="form-label">Customer</label>
        <select name="customer_id" class="form-control">
            <option value="">-- Select Customer --</option>
            <?php foreach ($customers as $c): ?>
                <option value="<?= $c['id'] ?>" <?= (isset($old['customer_id']) && $old['customer_id'] == $c['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="error"><?= $errors['customer_id'] ?? '' ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label">Product</label>
        <select name="product_id" class="form-control">
            <option value="">-- Select Product --</option>
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>" <?= (isset($old['product_id']) && $old['product_id'] == $product['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($product['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="error"><?= $errors['customer_id'] ?? '' ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label">Discount</label>
        <input type="number" step="0.01" name="discount" value="<?= htmlspecialchars($old['discount'] ?? 0) ?>" class="form-control">
        <p class="error"><?= $errors['discount'] ?? '' ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label">Delivery Date</label>
        <input type="date" name="delivery_date" value="<?= htmlspecialchars($old['delivery_date'] ?? '') ?>" class="form-control">
        <p class="error"><?= $errors['delivery_date'] ?? '' ?></p>
    </div>

    <div class="mb-3">
        <label class="form-label">Remarks</label>
        <textarea name="remarks" class="form-control"><?= htmlspecialchars($old['remarks'] ?? '') ?></textarea>
        <p class="error"><?= $errors['remarks'] ?? '' ?></p>
    </div>

    <button type="submit" class="btn btn-primary">Create Order</button>
</form>

            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

<?php require base_path('views/partials/footer.php') ?>