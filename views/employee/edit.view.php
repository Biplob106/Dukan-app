<?php
    require base_path('views/partials/head.php');
    require base_path('views/partials/header.php');

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
                    <h3 class="mb-0">Employee</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/employee">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Employee</li>
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
              <form method="POST" action="/employee">
                <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($employee['id']) ?>">
                    
                <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($old['name'] ?? $employee['name'] ?? '')?>"
                        
                            class="form-control" id="exampleInputName1" aria-describedby="nameHelp">
                        <p class="error"><?php echo $errors['name'] ?? ''?></p>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? $employee['email'] ?? '')?>"
                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <p class="error"><?php echo $errors['email'] ?? ''?></p>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPhone1" class="form-label">phone</label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($old['phone'] ?? $employee['phone'] ?? '')?>"
                            class="form-control" id="exampleInputPhone1" aria-describedby="phoneHelp">
                        <p class="error"><?php echo $errors['phone'] ?? ''?></p>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputAddress1" class="form-label">Address</label>
                        <input type="text" name="address" value="<?php echo htmlspecialchars($old['address'] ?? $employee['address'] ?? '')?>"
                            class="form-control" id="exampleInputAddress1" aria-describedby="addressHelp">
                        <p class="error"><?php echo $errors['address'] ?? ''?></p>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="<?= htmlspecialchars($old['date_of_birth'] ?? $employee['date_of_birth'] ?? '') ?>" class="form-control">
                        <p class="error"><?= $errors['date_of_birth'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">NID</label>
                        <input type="text" name="nid_bc" value="<?php echo htmlspecialchars($old['nid_bc'] ?? $employee['nid_bc'] ?? '')?>"
                            class="form-control" id="exampleInput" aria-describedby="Help">
                        <p class="error"><?php echo $errors['nid_bc'] ?? ''?></p>

                    </div>
                     <div class="mb-3">
                        <label class="form-label">Date of Joining</label>
                        <input type="date" name="date_of_joining" value="<?= htmlspecialchars($old['date_of_joining'] ?? $employee['date_of_joining'] ?? '') ?>" class="form-control">
                        <p class="error"><?= $errors['date_of_joining'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Salary</label>
                        <input type="number" step="0.01" name="salary" value="<?= htmlspecialchars($old['salary'] ?? $employee['salary'] ?? '') ?>" class="form-control">
                        <p class="error"><?= $errors['salary'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Night Salary</label>
                        <input type="number" step="0.01" name="night_salary" value="<?= htmlspecialchars($old['night_salary'] ?? $employee['night_salary'] ?? '') ?>" class="form-control">
                        <p class="error"><?= $errors['night_salary'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Fequency</label>
                        <input type="text" name="frequency" value="<?php echo htmlspecialchars($old['frequency'] ?? $employee['frequency'] ?? '')?>"
                            class="form-control" id="exampleInput" aria-describedby="emailHelp">
                        <p class="error"><?php echo $errors['frequency'] ?? ''?></p>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Advance Salary</label>
                        <input type="number" step="0.01" name="advance_salary" value="<?= htmlspecialchars($old['advance_salary'] ?? $employee['advance_salary'] ?? '') ?>" class="form-control">
                        <p class="error"><?= $errors['advance_salary'] ?? '' ?></p>
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

<?php require base_path('views/partials/footer.php')?>