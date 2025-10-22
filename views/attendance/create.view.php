
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
                <form method="POST" action="/attendance">
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
                        <label class="form-label">Date</label>
                        <input type="date" name="attendance_date" value="<?= htmlspecialchars($old['attendance_date'] ?? date('Y-m-d')) ?>" class="form-control" required>
                        <p class="error"><?= $errors['attendance_date'] ?? '' ?></p>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_present" value="1" class="form-check-input" id="is_present"
                            <?= !empty($old['is_present']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_present">Present</label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_night" value="1" class="form-check-input" id="is_night"
                            <?= !empty($old['is_night']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_night">Night Shift</label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_paid" value="1" class="form-check-input" id="is_paid"
                            <?= !empty($old['is_paid']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_paid">Paid</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Attendance</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
