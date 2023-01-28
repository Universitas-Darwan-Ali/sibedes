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
                        <input type="hidden" name="peralatan_id" value="<?= $Peralatan['peralatan_id']; ?>">

                        <div class="form-group">
                            <select name="kode_peralatan_id" id="kode_peralatan_id" class="form-control">
                                <option value="">Select Peralatan</option>
                                <?php foreach ($nama_brg as $nb) : ?>
                                    <option value="<?= $nb['kode_peralatan_id']; ?>"><?= $nb['nama_brg']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="nup">NUP</label>
                            <input type="text" name="nup" class="form-control" id="nup" value="<?= $Peralatan['nup']; ?>">
                            <small class="form-text text-danger"><?= form_error('nup'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="merk">Merk/Type</label>
                            <input type="text" name="merk" class="form-control" id="merk" value="<?= $Peralatan['merk']; ?>">
                            <small class="form-text text-danger"><?= form_error('merk'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="th_perolehan">Tahun Perolehan</label>
                            <input type="text" name="th_perolehan" class="form-control" id="th_perolehan" value="<?= $Peralatan['th_perolehan']; ?>">
                            <small class="form-text text-danger"><?= form_error('th_perolehan'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="nilai_perolehan">Nilai Perolehan (Rp)</label>
                            <input type="text" name="nilai_perolehan" class="form-control" id="nilai_perolehan" value="<?= $Peralatan['nilai_perolehan']; ?>">
                            <small class="form-text text-danger"><?= form_error('nilai_perolehan'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="kond_brg">Kondisi Barang(B/RR/RB)</label>
                            <input type="text" name="kond_brg" class="form-control" id="kond_brg" value="<?= $Peralatan['kond_brg']; ?>">
                            <small class="form-text text-danger"><?= form_error('kond_brg'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <input type="text" name="ket" class="form-control" id="ket" value="<?= $Peralatan['ket']; ?>">
                            <small class="form-text text-danger"><?= form_error('ket'); ?></small>
                        </div>


                        <button type="submit" name="edit" class="btn btn-primary float-right">Edit Peralatan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->