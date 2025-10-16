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
                    <h3 class="mb-0">Edit Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/product">Product</a></li>
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
                <form method="POST" action="/product">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name"
                            value="<?= htmlspecialchars($old['name'] ?? $product['name'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['name'] ?? '' ?></p>
                    </div>

                    <!-- Size -->
                    <div class="mb-3">
                        <label class="form-label">Size</label>
                        <input type="text" name="size"
                            value="<?= htmlspecialchars($old['size'] ?? $product['size'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['size'] ?? '' ?></p>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="3"><?= htmlspecialchars($old['description'] ?? $product['description'] ?? '') ?></textarea>
                        <p class="error text-danger"><?= $errors['description'] ?? '' ?></p>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price"
                            value="<?= htmlspecialchars($old['price'] ?? $product['price'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['price'] ?? '' ?></p>
                    </div>

                    <!-- Color -->
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color"
                            value="<?= htmlspecialchars($old['color'] ?? $product['color'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['color'] ?? '' ?></p>
                    </div>

                    <!-- Material -->
                    <div class="mb-3">
                        <label class="form-label">Material</label>
                        <input type="text" name="material"
                            value="<?= htmlspecialchars($old['material'] ?? $product['material'] ?? '') ?>"
                            class="form-control">
                        <p class="error text-danger"><?= $errors['material'] ?? '' ?></p>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php'); ?>