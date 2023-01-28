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
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <!-- <?php date_default_timezone_set('Asia/Jakarta'); ?> -->
                    <?php foreach ($Comment_Tanah as $ct) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $ct['jns_tanah']; ?></td>
                            <td><?= $ct['kode_barang_tanah']; ?></td>
                            <td><?= $ct['nup']; ?></td>
                            <td><?= $ct['luas']; ?></td>
                            <td><?= $ct['th_perolehan']; ?></td>
                            <td><?= $ct['alas_hak']; ?></td>
                            <td><?= $ct['nilai_perolehan']; ?></td>
                            <td><?= $ct['ket']; ?></td>
                            <!-- <td><?= date('d F Y, H:i:s', $ct['date_created']); ?></td> -->
                            <td><img src="<?= base_url('assets/img/aset/') . $ct['image']; ?>" width="100"></td>
                            <td><?= $ct['comment']; ?></td>
                            <td>
                                <a href="<?= base_url('user/comment_tanah_edit/') . $ct['tanah_id']; ?>" class="badge badge-danger">ADD COMMENT</a>
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

