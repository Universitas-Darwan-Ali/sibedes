<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">

                </div>

                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="role_id" value="<?= $role['role_id']; ?>">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" name="role" class="form-control" id="role" value="<?= $role['role']; ?>">
                            <small class="form-text text-danger"><?= form_error('role'); ?></small>
                        </div>
                        <button type="submit" name="edit" class="btn btn-primary float-right">Edit Role</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->