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
                        <th scope="col">Jenis Bangunan</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">NUP</th>
                        <th scope="col">Luas (M<sup>2</sup>)</th>
                        <th scope="col">Tahun Perolehan</th>
                        <th scope="col">Tipe Bangunan</th>
                        <th scope="col">Nilai (Rp)</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Perubahan</th>
                        <th scope="col">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bangunan_log as $bl) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $bl['jns_bangun']; ?></td>
                            <td><?= $bl['kode_barang_bangunan']; ?></td>
                            <td><?= $bl['nup']; ?></td>
                            <td><?= $bl['luas']; ?></td>
                            <td><?= $bl['th_perolehan']; ?></td>
                            <td><?= $bl['tipe_bangun']; ?></td>
                            <td><?= $bl['nilai']; ?></td>
                            <td><?= $bl['ket']; ?></td>
                            <td><img src="<?= base_url('assets/img/aset/') . $bl['image']; ?>" width="100"></td>
                            <td><?= $bl['perubahan']; ?></td>
                            <td><?= $bl['waktu']; ?></td>
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