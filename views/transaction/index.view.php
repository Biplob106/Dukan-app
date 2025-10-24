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
                        <li class="breadcrumb-item"><a href="/transaction">Home</a></li>
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
                <a href="/transaction/create">
                    <span> Create Transactions</span> </a>
                  <table border="1" cellpadding="10" cellspacing="0" class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th>ID</th>
            <th>Customer Name</th>
            <th>Order ID</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Created At</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($transactions)): ?>
            <?php foreach ($transactions as $transaction): ?>
                <?php
                    $methodName = match($transaction['method']) {
                        1 => 'Cash',
                        2 => 'Card',
                        3 => 'Online',
                        default => 'Unknown',
                    };
                ?>
                <tr>
                    <td><?= $transaction['id'] ?></td>
                    <td><?= htmlspecialchars($transaction['name']) ?></td>
                    <td><?= htmlspecialchars($transaction['order_id']) ?></td>
                    <td><?= htmlspecialchars($transaction['amount']) ?></td>
                    <td><?= $methodName ?></td>
                    <td><?= htmlspecialchars($transaction['created_at']) ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                            <button>Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="/transaction/edit?id=<?= $transaction['id'] ?>">Update</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center text-gray-500">No transactions found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
                
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

<?php require base_path('views/partials/footer.php') ?>