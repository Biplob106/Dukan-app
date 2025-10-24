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
                    <h3 class="mb-0">Transactions</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/customer">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaction</li>
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
              <form method="POST" action="/transaction">
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
        <label class="form-label">Order name</label>
        <select name="product_id" class="form-control">
            <option value="">-- Select Order ID --</option>
            <?php foreach ($orders as $order): ?>
                <option value="<?= $order['id'] ?>" <?= (isset($old['order_id']) && $old['order_id'] == $order['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($order['id']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="error"><?= $errors['customer_id'] ?? '' ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label">Amount</label>
        <input type="number" step="0.01" name="amount" value="<?= htmlspecialchars($old['amount'] ?? 0) ?>" class="form-control">
        <p class="error"><?= $errors['amount'] ?? '' ?></p>
    </div>
    <div class="mb-3">
    <label class="form-label">Payment Method</label>
    <select name="method" class="form-control">
        <option value="">-- Select Method --</option>
        <option value="1" <?= (isset($old['method']) && $old['method']==1)?'selected':'' ?>>Cash</option>
        <option value="2" <?= (isset($old['method']) && $old['method']==2)?'selected':'' ?>>Card</option>
        <option value="3" <?= (isset($old['method']) && $old['method']==3)?'selected':'' ?>>Online</option>
    </select>
    <p class="error"><?= $errors['method'] ?? '' ?></p>
</div>
<div class="mb-3">
                        <label class="form-label">Transaction Date</label>
                        <input type="date" name="created_at" value="<?= htmlspecialchars($old['created_at'] ?? date('Y-m-d')) ?>" class="form-control" required>
                        <p class="error"><?= $errors['created_at'] ?? '' ?></p>
                    </div>

   
    <button type="submit" class="btn btn-primary">Create Transaction</button>
</form>

            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

<?php require base_path('views/partials/footer.php') ?>