<!DOCTYPE html>
<html><head>
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
           padding-right: 200px;
           padding-left: 100px;
        }
        h6 {
             text-align: left;
           padding-bottom: 5px;
           padding-top: 5px;
           padding-right: 80px;
           padding-left: 650px;
        }
    </style>
</head><body>
<h3 style="text-align: center;">LAPORAN HASIL INVENTARISASI (LHI) ASET DESA</h3>
<h3 style="text-align: center;">BERUPA BANGUNAN</h3>
<hr>
    <table>
        <tr>
            <th>No</th>
            <th>Jenis Bangunan</th>
            <th>Kode Barang</th>
            <th>NUP</th>
            <th>Luas (M<sup>2</sup>)</th>
            <th>Tahun Perolehan</th>
            <th>Tipe Bangunan</th>
            <th>Nilai (Rp)</th>
            <th>Keterangan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($Bangunan as $b) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $b['jns_bangun']; ?></td>
                <td><?= $b['kode_barang_bangunan']; ?></td>
                <td><?= $b['nup']; ?></td>
                <td><?= $b['luas']; ?></td>
                <td><?= $b['th_perolehan']; ?></td>
                <td><?= $b['tipe_bangun']; ?></td>
                <td><?= $b['nilai']; ?></td>
                <td><?= $b['ket']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<h5>Tim Inventarisasi</h5>
<h6>1. HADRIANSYAH</h6>
<h6>2. ALMON .TK.LIU</h6>
<h6>3. DEWI MURNI</h6>
<h6>4. GREGORIAN YESUANDA .LA</h6>
<h6>5. YOSIAS ELKAM</h6>
<h6>6. RUDI IRWANTO</h6>
</body></html>