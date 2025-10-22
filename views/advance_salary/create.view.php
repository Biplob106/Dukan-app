
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
                    <h3 class="mb-0">Attendance</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/attendance">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Attendance</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <form method="POST" action="/advance_salary">
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            <option value="">-- Select Employee --</option>
                            <?php foreach ($employees as $employee): ?>
                                <option value="<?= htmlspecialchars($employee['id']) ?>"
                                    <?= (isset($old['employee_id']) && $old['employee_id'] == $employee['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($employee['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="error"><?= $errors['employee_id'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Total Amount</label>
                        <input type="number" step="0.01" name="amount"
                            value="<?= htmlspecialchars($old['amount'] ?? '') ?>" class="form-control"
                            id="exampleInput">

                        <p class="error"><?= $errors['amount'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control"><?= htmlspecialchars($old['remarks'] ?? '') ?></textarea>
                        <p class="error"><?= $errors['remarks'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="created_at" value="<?= htmlspecialchars($old['created_at'] ?? date('Y-m-d')) ?>" class="form-control" required>
                        <p class="error"><?= $errors['created_at'] ?? '' ?></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Advance Salary</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
