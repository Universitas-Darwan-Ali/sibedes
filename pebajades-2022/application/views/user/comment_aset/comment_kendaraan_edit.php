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
                        <input type="hidden" name="kendaraan_id" value="<?= $Comment_Kendaraan['kendaraan_id']; ?>">

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="comment" class="form-control" id="comment" rows="5"></textarea>
                            <button type="submit" name="edit" class="btn btn-danger float-right">Add Comment</button>
                        </div>

                        <div class="form-group">
                            <label for="kode_kendaraan_id">Kode ID</label>
                            <input type="text" name="kode_kendaraan_id" class="form-control" id="kode_kendaraan_id" value="<?= $Comment_Kendaraan['kode_kendaraan_id']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('kode_kendaraan_id'); ?></small>
                        </div>


                        <div class="form-group">
                            <label for="nup">NUP</label>
                            <input type="text" name="nup" class="form-control" id="nup" value="<?= $Comment_Kendaraan['nup']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('nup'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="merk">Merk/Type</label>
                            <input type="text" name="merk" class="form-control" id="merk" value="<?= $Comment_Kendaraan['merk']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('merk'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="th_perolehan">Tahun Perolehan</label>
                            <input type="text" name="th_perolehan" class="form-control" id="th_perolehan" value="<?= $Comment_Kendaraan['th_perolehan']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('th_perolehan'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="no_identitas">Nomor Identitas</label>
                            <input type="text" name="no_identitas" class="form-control" id="no_identitas" value="<?= $Comment_Kendaraan['no_identitas']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('no_identitas'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="nilai_perolehan">Nilai Perolehan (Rp)</label>
                            <input type="text" name="nilai_perolehan" class="form-control" id="nilai_perolehan" value="<?= $Comment_Kendaraan['nilai_perolehan']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('nilai_perolehan'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="kond_brg">Kondisi Barang(B/RR/RB)</label>
                            <input type="text" name="kond_brg" class="form-control" id="kond_brg" value="<?= $Comment_Kendaraan['kond_brg']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('kond_brg'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <input type="text" name="ket" class="form-control" id="ket" value="<?= $Comment_Kendaraan['ket']; ?>" READONLY>
                            <small class="form-text text-danger"><?= form_error('ket'); ?></small>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->