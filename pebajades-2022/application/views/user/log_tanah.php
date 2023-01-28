<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">


            <div class="col-md-12" style="margin-bottom: 20px">
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
            </div>

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
                        <th scope="col">Gambar</th>
                        <th scope="col">Perubahan</th>
                        <th scope="col">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($tanah_log as $tl) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $tl['jns_tanah']; ?></td>
                            <td><?= $tl['kode_barang_tanah']; ?></td>
                            <td><?= $tl['nup']; ?></td>
                            <td><?= $tl['luas']; ?></td>
                            <td><?= $tl['th_perolehan']; ?></td>
                            <td><?= $tl['alas_hak']; ?></td>
                            <td><?= $tl['nilai_perolehan']; ?></td>
                            <td><?= $tl['ket']; ?></td>
                            <td><img src="<?= base_url('assets/img/aset/') . $tl['image']; ?>" width="100"></td>
                            <td><?= $tl['perubahan']; ?></td>
                            <td><?= $tl['waktu']; ?></td>
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