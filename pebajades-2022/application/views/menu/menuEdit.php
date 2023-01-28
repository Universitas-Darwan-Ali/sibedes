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
                        <input type="hidden" name="menu_id" value="<?= $menu['menu_id']; ?>">
                        <div class="form-group">
                            <label for="menu">Menu</label>
                            <input type="text" name="menu" class="form-control" id="menu" value="<?= $menu['menu']; ?>">
                            <small class="form-text text-danger"><?= form_error('menu'); ?></small>
                        </div>
                        <button type="submit" name="edit" class="btn btn-primary float-right">Edit Menu</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->