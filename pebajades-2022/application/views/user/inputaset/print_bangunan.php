<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <style type="text/css">
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
        }
        h5 {
            text-align: right;
           padding-bottom: 10px;
           padding-top: 30px;
           padding-right: 100px;
           padding-left: 100px;
        }
        h6 {
             text-align: left;
           padding-bottom: 5px;
           padding-top: 5px;
           padding-right: 80px;
           padding-left: 400px;
        }
    </style>
</head>

<body>
<h3 style="text-align: center;">LAPORAN HASIL INVENTARISASI (LHI) ASET DESA</h3>
<h3 style="text-align: center;">BERUPA BANGUNAN</h3>
    <div class="row">
        <div class="col-lg">
 <table class="table table-hover">
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
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
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
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <script type="text/javascript">
                window.print();
            </script>


        </div>
    </div>


<h5>Tim Inventarisasi</h5>
<h6>1. HADRIANSYAH</h6>
<h6>2. ALMON .TK.LIU</h6>
<h6>3. DEWI MURNI</h6>
<h6>4. GREGORIAN YESUANDA .LA</h6>
<h6>5. YOSIAS ELKAM</h6>
<h6>6. RUDI IRWANTO</h6>
</body>

</html>