<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">


            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newBangunanModal"><i class="fas fa-plus"></i> Add New Bangunan</a>
            <a href="<?= base_url('user/printbangunan'); ?>" class="btn btn-danger mb-3"><i class="fas fa-print"></i> Print</a>
            <a href="<?= base_url('user/pdfbangunan'); ?>" class="btn btn-warning mb-3"><i class="fas fa-file"></i> Export as PDF</a>

            <!-- <div class="col-md-12" style="margin-bottom: 20px">
                <div class="row">
                    <div class="col-md-2">
                        <span>Pilih dari tanggal</span>
                        <div class="input-group">
                            <input type="text" class="form-control pickdate date_range_filter" name="">
                            <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <span>Sampai tanggal</span>
                        <div class="input-group">
                            <input type="text" class="form-control pickdate date_range_filter2" name="">
                            <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
            </div> -->

            <table id="tabelData" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis Bangunan</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">NUP</th>
                        <th scope="col">Luas (M<sup>2</sup>)</th>
                        <th scope="col">Tahun Perolehan</th>
                        <th scope="col">Tipe Bangunan</th>
                        <th scope="col">Nilai (Rp)</th>
                        <th scope="col">Keterangan</th>
                        <!-- <th scope="col">Time</th> -->
                        <th scope="col">Gambar</th>
                        <th scope="col" class="text-danger">Comment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <!-- <?php date_default_timezone_set('Asia/Jakarta'); ?> -->
                    <?php foreach ($Bangunan as $b) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $b['jns_bangun']; ?></td>
                            <td><?= $b['kode_barang_bangunan']; ?></td>
                            <td><?= $b['nup']; ?></td>
                            <td><?= $b['luas']; ?></td>
                            <td><?= $b['th_perolehan']; ?></td>
                            <td><?= $b['tipe_bangun']; ?></td>
                            <td><?= $b['nilai']; ?></td>
                            <td><?= $b['ket']; ?></td>
                            <!-- <td><?= date('d F Y, H:i:s', $b['date_created']); ?></td> -->
                            <td><img src="<?= base_url('assets/img/aset/') . $b['image']; ?>" width="100"></td>
                            <td><?= $b['comment']; ?></td>
                            <td><?= $b['del']; ?></td>
                            <td>
                                <a href="<?= base_url('user/bangunanEdit/') . $b['bangunan_id']; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url('user/bangunanDelete/') . $b['bangunan_id']; ?>" class="badge badge-danger">delete</a>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="newBangunanModal" tabindex="-1" role="dialog" aria-labelledby="newBangunanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBangunanModalLabel">Add New Bangunan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('user/bangunan'); ?>
            <div class="modal-body">

                <div class="form-group">
                    <select name="kode_bangunan_id" id="kode_bangunan_id" class="form-control">
                        <option value="">Select Bangunan</option>
                        <?php foreach ($jns_bangun as $jb) : ?>
                            <option value="<?= $jb['kode_bangunan_id']; ?>"><?= $jb['jns_bangun']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="nup" name="nup" placeholder="NUP">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="luas" name="luas" placeholder="Luas (M2)">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="th_perolehan" name="th_perolehan" placeholder="Tahun Perolehan">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="tipe_bangun" name="tipe_bangun" placeholder="Tipe Bangunan">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Nilai (Rp)">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="ket" name="ket" placeholder="Keterangan">
                </div>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" required>
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>