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
                <a href="/employee/create">
                    <span> Add New Employee</span> </a>

                <table border="1" cellpadding="10" cellspacing="0"
                    class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th>NID </th>
                            <th>Joining date </th>
                            <th>Salary</th>
                            <th>Night Salary</th>
                            <th>Frequency </th>
                            <th>Advance Salary</th>
                             <th>Created at </th>
                            <th></th>
                    </thead>
                    <tbody>
                        <?php if (!empty($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?= ($employee['id']) ?></td>
                            <td><?= htmlspecialchars($employee['name']) ?></td>
                            <td><?= htmlspecialchars($employee['email']) ?></td>
                            <td><?= htmlspecialchars($employee['phone']) ?></td>
                            <td><?= htmlspecialchars($employee['address']) ?></td>
                            <td><?= htmlspecialchars($employee['date_of_birth']) ?></td>
                            <td><?= htmlspecialchars($employee['nid_bc']) ?></td>
                            <td><?= htmlspecialchars($employee['date_of_joining']) ?></td>
                            <td><?= htmlspecialchars($employee['salary']) ?></td>
                            <td><?= htmlspecialchars($employee['night_salary']) ?></td>
                            <td><?= htmlspecialchars($employee['frequency']) ?></td>
                            <td><?= htmlspecialchars($employee['advance_salary']) ?></td>
                             <td><?= htmlspecialchars($employee['created_at']) ?></td>


                            <td class="space-x-2">
                                <!-- Delete Form -->
                                <form class="inline-block" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                                    <button
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Delete
                                    </button>
                                </form>

                                <!-- Update Button -->
                                <a href="/employee/edit?id=<?= $employee['id'] ?>"
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