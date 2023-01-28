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
                        <input type="hidden" name="tanah_id" value="<?= $Tanah['tanah_id']; ?>">

                        <div class="form-group">
                            <label for="kode_tanah_id">Kode ID</label>
                            <input type="text" name="kode_tanah_id" class="form-control" id="kode_tanah_id" value="<?= $Tanah['kode_tanah_id']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('kode_tanah_id'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="nup">NUP</label>
                            <input type="text" name="nup" class="form-control" id="nup" value="<?= $Tanah['nup']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('nup'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="luas">Luas (M<sup>2</sup>)</label>
                            <input type="text" name="luas" class="form-control" id="luas" value="<?= $Tanah['luas']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('luas'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="th_perolehan">Tahun Perolehan</label>
                            <input type="text" name="th_perolehan" class="form-control" id="th_perolehan" value="<?= $Tanah['th_perolehan']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('th_perolehan'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="alas_hak">Alas/Hak Bukti Kepemilikan</label>
                            <input type="text" name="alas_hak" class="form-control" id="alas_hak" value="<?= $Tanah['alas_hak']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('alas_hak'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="nilai_perolehan">Nilai Perolehan (Rp)</label>
                            <input type="text" name="nilai_perolehan" class="form-control" id="nilai_perolehan" value="<?= $Tanah['nilai_perolehan']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('nilai_perolehan'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <input type="text" name="ket" class="form-control" id="ket" value="<?= $Tanah['ket']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('ket'); ?></small>
                        </div>


                        <button type="submit" name="edit" class="btn btn-primary float-right" onclick="return confirm('Yakin hapus data?')">Konfirmasi Delete Tanah</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->