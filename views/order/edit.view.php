<?php
require base_path('views/partials/head.php');
require base_path('views/partials/header.php');
require base_path('views/partials/nav.php');
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Order</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/order">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <form method="POST" action="/order/update">
                        <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">


                    <div class="mb-3">
                        <label class="form-label">Invoice Number</label>
                        <input
                            name="invoice_number"
                            value="<?= htmlspecialchars($old['invoice_number'] ?? $order['invoice_number']) ?>"
                            class="form-control"
                            readonly
                        >
                        <p class="error"><?= $errors['invoice_number'] ?? '' ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" class="form-control">
                            <option value="">-- Select Customer --</option>
                            <?php foreach ($customers as $c): ?>
                                <option value="<?= $c['id'] ?>"
                                    <?= ((isset($old['customer_id']) && $old['customer_id'] == $c['id']) 
                                         || ($order['customer_id'] == $c['id'] && !isset($old['customer_id']))) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="error"><?= $errors['customer_id'] ?? '' ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sub Total</label>
                        <input type="number" step="0.01" name="sub_total"
                               value="<?= htmlspecialchars($old['sub_total'] ?? $order['sub_total']) ?>" class="form-control">
                        <p class="error"><?= $errors['sub_total'] ?? '' ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Discount</label>
                        <input type="number" step="0.01" name="discount"
                               value="<?= htmlspecialchars($old['discount'] ?? $order['discount']) ?>" class="form-control">
                        <p class="error"><?= $errors['discount'] ?? '' ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Grand Total</label>
                        <input type="number" step="0.01" name="grand_total"
                               value="<?= htmlspecialchars($old['grand_total'] ?? $order['grand_total']) ?>" class="form-control" readonly>
                        <p class="error"><?= $errors['grand_total'] ?? '' ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Delivery Date</label>
                        <input type="date" name="delivery_date"
                               value="<?= htmlspecialchars($old['delivery_date'] ?? $order['delivery_date']) ?>" class="form-control">
                        <p class="error"><?= $errors['delivery_date'] ?? '' ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control"><?= htmlspecialchars($old['remarks'] ?? $order['remarks']) ?></textarea>
                        <p class="error"><?= $errors['remarks'] ?? '' ?></p>
                    </div>

                    <button type="submit" class="btn btn-success">Update Order</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php'); ?>
