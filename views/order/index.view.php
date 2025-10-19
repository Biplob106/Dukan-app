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
                    <h3 class="mb-0">Oders</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/order">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order</li>
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
                <a href="/order/create">
                    <span> Create Order</span> </a>

                <table border="1" cellpadding="10" cellspacing="0"
                    class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th>ID</th>
                            <th>Invoice Number</th>
                            <th>Customer Name </th>
                            <th>Sub Total</th>
                            <th>Discount</th>
                            <th>Grand Total </th>
                            <th>User ID </th>
                            <th>Created At  </th>
                            <th>Status </th>
                            <th>Delivery </th>
                            <th>Remark </th>
                            <th>payment status </th>
                            <th></th>
                            <th></th>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= ($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['invoice_number']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['sub_total']) ?></td>
                            <td><?= htmlspecialchars($order['discount']) ?></td>
                            <td><?= htmlspecialchars($order['grand_total']) ?></td>
                            <td><?= htmlspecialchars($order['user_email']) ?></td>
                             <td><?= htmlspecialchars($order['created_at']) ?></td>
                              <td><?= htmlspecialchars($order['status']) ?></td>
                               <td><?= htmlspecialchars($order['delivery_date']) ?></td>
                                <td><?= htmlspecialchars($order['remarks']) ?></td>
                               <td><?= htmlspecialchars($order['payment_status']) ?></td>

                            <td class="space-x-2">
                                <!-- Delete Form -->
                                <form class="inline-block" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                    <button
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Delete
                                    </button>
                                </form>

                                <!-- Update Button -->
                                <a href="/order/edit?id=<?= $order['id'] ?>"
                                    class="inline-block px-3 py-2 text-xs font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Update
                                </a>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-gray-500">No customers found.</td>
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