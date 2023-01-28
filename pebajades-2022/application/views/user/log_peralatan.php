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
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">NUP</th>
                        <th scope="col">Merk/Type</th>
                        <th scope="col">Tahun Perolehan</th>
                        <th scope="col">Nilai Perolehan (Rp)</th>
                        <th scope="col">Kondisi Barang(B/RR/RB)</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Perubahan</th>
                        <th scope="col">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($peralatan_log as $pl) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $pl['nama_brg']; ?></td>
                            <td><?= $pl['kode_barang_peralatan']; ?></td>
                            <td><?= $pl['nup']; ?></td>
                            <td><?= $pl['merk']; ?></td>
                            <td><?= $pl['th_perolehan']; ?></td>
                            <td><?= $pl['nilai_perolehan']; ?></td>
                            <td><?= $pl['kond_brg']; ?></td>
                            <td><?= $pl['ket']; ?></td>
                            <td><img src="<?= base_url('assets/img/aset/') . $pl['image']; ?>" width="100"></td>
                            <td><?= $pl['perubahan']; ?></td>
                            <td><?= $pl['waktu']; ?></td>
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