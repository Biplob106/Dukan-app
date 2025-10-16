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
                    <h3 class="mb-0">Products</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product</li>
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
                <form method="POST" action="/product">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <p class="error"><?= $errors['name'] ?? '' ?></p>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Size</label>
                        <input type="text" name="size" value="<?= htmlspecialchars($old['size'] ?? '') ?>"
                            class="form-control" id="exampleInputPassword1">
                        <p class="error"><?= $errors['size'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>
                        <textarea type="text" name="description" class="form-control"
                            id="exampleInputPassword1"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>

                        <p class="error"><?= $errors['description'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price"
                            value="<?= htmlspecialchars($old['price'] ?? '') ?>" class="form-control"
                            id="exampleInputPassword1">

                        <p class="error"><?= $errors['price'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Color</label>
                        <input type="text" name=" color" value="<?= htmlspecialchars($old['color'] ?? '') ?>"
                            class="form-control" id="exampleInputPassword1">

                        <p class="error"><?= $errors['color'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Material</label>
                        <input type="text" name="material" value="<?= htmlspecialchars($old['material'] ?? '') ?>"
                            class="form-control" id="exampleInputPassword1">

                        <p class="error"><?= $errors['material'] ?? '' ?></p>
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