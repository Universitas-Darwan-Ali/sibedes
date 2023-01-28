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
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">NUP</th>
                        <th scope="col">Merk/Type</th>
                        <th scope="col">Tahun Perolehan</th>
                        <th scope="col">Nilai Perolehan (Rp)</th>
                        <th scope="col">Kondisi Barang(B/RR/RB)</th>
                        <th scope="col">Keterangan</th>
                        <!-- <th scope="col">Time</th> -->
                        <th scope="col">Gambar</th>
                        <th scope="col" class="text-danger">Comment</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <!-- <?php date_default_timezone_set('Asia/Jakarta'); ?> -->
                    <?php foreach ($Comment_Peralatan as $cp) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $cp['nama_brg']; ?></td>
                            <td><?= $cp['kode_barang_peralatan']; ?></td>
                            <td><?= $cp['nup']; ?></td>
                            <td><?= $cp['merk']; ?></td>
                            <td><?= $cp['th_perolehan']; ?></td>
                            <td><?= $cp['nilai_perolehan']; ?></td>
                            <td><?= $cp['kond_brg']; ?></td>
                            <td><?= $cp['ket']; ?></td>
                            <!-- <td><?= date('d F Y, H:i:s', $cp['date_created']); ?></td> -->
                            <td><img src="<?= base_url('assets/img/aset/') . $cp['image']; ?>" width="100"></td>
                            <td><?= $cp['comment']; ?></td>
                            <td>
                                <a href="<?= base_url('user/comment_peralatan_edit/') . $cp['peralatan_id']; ?>" class="badge badge-danger">ADD COMMENT</a>
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