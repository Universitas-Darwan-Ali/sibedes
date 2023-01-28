<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="col-xl mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="<?= base_url('admin/role'); ?>" class="card-link h5 mb-0 font-weight-bold text-gray-800">Role (User Access Management)</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="<?= base_url('menu'); ?>" class="card-link h5 mb-0 font-weight-bold text-gray-800">Menu Management</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-folder fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="<?= base_url('menu/submenu'); ?>" class="card-link h5 mb-0 font-weight-bold text-gray-800">Submenu Management</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-folder-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->