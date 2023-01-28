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

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newTanahModal"><i class="fas fa-plus"></i> Add New Tanah</a>
            <a href="<?= base_url('user/printtanah'); ?>" class="btn btn-danger mb-3"><i class="fas fa-print"></i> Print</a>
            <a href="<?= base_url('user/pdftanah'); ?>" class="btn btn-warning mb-3"><i class="fas fa-file"></i> Export as PDF</a>

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
                        <th scope="col">Jenis Tanah</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">NUP</th>
                        <th scope="col">Luas (M<sup>2</sup>)</th>
                        <th scope="col">Tahun Perolehan</th>
                        <th scope="col">Alas/Hak Bukti Kepemilikan</th>
                        <th scope="col">Nilai Perolehan (Rp)</th>
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
                    <?php foreach ($Tanah as $tn) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $tn['jns_tanah']; ?></td>
                            <td><?= $tn['kode_barang_tanah']; ?></td>
                            <td><?= $tn['nup']; ?></td>
                            <td><?= $tn['luas']; ?></td>
                            <td><?= $tn['th_perolehan']; ?></td>
                            <td><?= $tn['alas_hak']; ?></td>
                            <td><?= $tn['nilai_perolehan']; ?></td>
                            <td><?= $tn['ket']; ?></td>
                            <!-- <td><?= date('d F Y, H:i:s', $tn['date_created']); ?></td> -->
                            <td><img src="<?= base_url('assets/img/aset/') . $tn['image']; ?>" width="100"></td>
                            <td><?= $tn['comment']; ?></td>
                            <td><?= $tn['del']; ?></td>
                            <td>
                                <a href="<?= base_url('user/tanahEdit/') . $tn['tanah_id']; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url('user/tanahDelete/') . $tn['tanah_id']; ?>" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newTanahModal" tabindex="-1" role="dialog" aria-labelledby="newTanahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTanahModalLabel">Add New Tanah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('user/tanah'); ?>
            <div class="modal-body">

                <div class="form-group">
                    <select name="kode_tanah_id" id="kode_tanah_id" class="form-control">
                        <option value="">Select Tanah</option>
                        <?php foreach ($jns_tanah as $jt) : ?>
                            <option value="<?= $jt['kode_tanah_id']; ?>"><?= $jt['jns_tanah']; ?></option>
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
                    <input type="text" class="form-control" id="alas_hak" name="alas_hak" placeholder="Alas/Hak Bukti Kepemilikan">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="nilai_perolehan" name="nilai_perolehan" placeholder="Nilai Perolehan (Rp)">
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