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
                <form method="POST" action="/customer">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <p class="error"><?= $errors['name'] ?? '' ?></p>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <p class="error"><?= $errors['email'] ?? '' ?></p>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">phone</label>
                        <input type="text" name="phone" value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <p class="error"><?= $errors['phone'] ?? '' ?></p>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <input type="text" name="address" value="<?= htmlspecialchars($old['address'] ?? '') ?>"
                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <p class="error"><?= $errors['address'] ?? '' ?></p>

                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Total Amount</label>
                        <input type="number" step="0.01" name="total_amount"
                            value="<?= htmlspecialchars($old['total_amount'] ?? '') ?>" class="form-control"
                            id="total_amount">

                        <p class="error"><?= $errors['total_amount'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Due Amount</label>
                        <input type="number" step="0.01" name="due_amount"
                            value="<?= htmlspecialchars($old['due_amount'] ?? '') ?>" class="form-control"
                            id="due_amount" readonly>

                        <p class="error"><?= $errors['due_amount'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Paid Amount</label>
                        <input type="number" step="0.01" name="paid_amount"
                            value="<?= htmlspecialchars($old['paid_amount'] ?? '') ?>" class="form-control"
                            id="paid_amount">

                        <p class="error"><?= $errors['paid_amount'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Discount Amount</label>
                        <input type="number" step="0.01" name="discount_amount"
                            value="<?= htmlspecialchars($old['discount_amount'] ?? '') ?>" class="form-control"
                            id="discount_amount">

                        <p class="error"><?= $errors['discount_amount'] ?? '' ?></p>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

<?php require base_path('views/partials/footer.php') ?>
<script>
    function calculateaDue(){
        let total = parseFloat(document.getElementById("total_amount").value) || 0 ;
        let paid = parseFloat(document.getElementById("paid_amount").value) || 0;
        let  dicount = parseFloat(document.getElementById("discount_amount").value)||0;
        let due = total-paid-discount;
        document.getElementById("due_amount").value = due.toFixed(2);

    }
    document.getElementById("total_amount").addEventListener("input",calculateaDue);
    document.getElementById("paid_amount").addEventListener("input",calculateaDue);
    document.getElementById("discount_amount").addEevenListener("input",calculateaDue);
</script>