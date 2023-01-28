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
                        <input type="hidden" name="sub_menu_id" value="<?= $subMenu['sub_menu_id']; ?>">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="<?= $subMenu['title']; ?>">
                            <small class="form-text text-danger"><?= form_error('title'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="menu">Menu</label>
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['menu_id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" name="url" class="form-control" id="url" value="<?= $subMenu['url']; ?>">
                            <small class="form-text text-danger"><?= form_error('url'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" name="icon" class="form-control" id="icon" value="<?= $subMenu['icon']; ?>">
                            <small class="form-text text-danger"><?= form_error('icon'); ?></small>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>

                        <button type="submit" name="edit" class="btn btn-primary float-right">Edit Submenu</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->