<?php
require base_path('views/partials/head.php');
require base_path('views/partials/header.php');
require base_path('views/partials/nav.php');
?>

<main class="app-main">
    <!-- App Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Create Transaction</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/transaction">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaction</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- App Content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <form method="POST" action="/transaction">
                     <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" value="<?= $old['id'] ?>">

                    <!-- Customer -->
                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" class="form-control" required>
                            <option value="">-- Select Customer --</option>
                            <?php foreach ($customers as $c): ?>
                                <option value="<?= $c['id'] ?>" <?= (isset($old['customer_id']) && $old['customer_id'] == $c['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="error"><?= $errors['customer_id'] ?? '' ?></p>
                    </div>

                    <!-- Order -->
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <select name="order_id" class="form-control" required>
                            <option value="">-- Select Order ID --</option>
                            <?php foreach ($orders as $order): ?>
                                <option value="<?= $order['id'] ?>" <?= (isset($old['order_id']) && $old['order_id'] == $order['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($order['id']) ?> 
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="error"><?= $errors['order_id'] ?? '' ?></p>
                    </div>

                    <!-- Amount -->
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" step="0.01" name="amount" value="<?= htmlspecialchars($old['amount'] ?? 0) ?>" class="form-control" required>
                        <p class="error"><?= $errors['amount'] ?? '' ?></p>
                    </div>
                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="method" class="form-control" required>
                            <option value="">-- Select Method --</option>
                            <option value="1" <?= (isset($old['method']) && $old['method']==1)?'selected':'' ?>>Cash</option>
                            <option value="2" <?= (isset($old['method']) && $old['method']==2)?'selected':'' ?>>Card</option>
                            <option value="3" <?= (isset($old['method']) && $old['method']==3)?'selected':'' ?>>Online</option>
                        </select>
                        <p class="error"><?= $errors['method'] ?? '' ?></p>
                    </div>

                    <!-- Transaction Date -->
                    <div class="mb-3">
                        <label class="form-label">Transaction Date</label>
                        <input type="date" name="created_at" value="<?= htmlspecialchars(date('Y-m-d', strtotime($old['created_at'])) ?? date('Y-m-d')) ?>" class="form-control" required>
                        <p class="error"><?= $errors['created_at'] ?? '' ?></p>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Create Transaction</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
