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
                        <input type="hidden" name="bangunan_id" value="<?= $Bangunan['bangunan_id']; ?>">

                        <div class="form-group">
                            <label for="kode_bangunan_id">Kode ID</label>
                            <input type="text" name="kode_bangunan_id" class="form-control" id="kode_bangunan_id" value="<?= $Bangunan['kode_bangunan_id']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('kode_bangunan_id'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="nup">NUP</label>
                            <input type="text" name="nup" class="form-control" id="nup" value="<?= $Bangunan['nup']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('nup'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="luas">Luas (M<sup>2</sup>)</label>
                            <input type="text" name="luas" class="form-control" id="luas" value="<?= $Bangunan['luas']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('luas'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="th_perolehan">Tahun Perolehan</label>
                            <input type="text" name="th_perolehan" class="form-control" id="th_perolehan" value="<?= $Bangunan['th_perolehan']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('th_perolehan'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="tipe_bangun">Tipe Bangunan</label>
                            <input type="text" name="tipe_bangun" class="form-control" id="tipe_bangun" value="<?= $Bangunan['tipe_bangun']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('tipe_bangun'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="nilai">Nilai (Rp)</label>
                            <input type="text" name="nilai" class="form-control" id="nilai" value="<?= $Bangunan['nilai']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('nilai'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <input type="text" name="ket" class="form-control" id="ket" value="<?= $Bangunan['ket']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('ket'); ?></small>
                        </div>


                        <button type="submit" name="edit" class="btn btn-primary float-right" onclick="return confirm('Yakin hapus data?')">Konfirmasi Delete Bangunan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->