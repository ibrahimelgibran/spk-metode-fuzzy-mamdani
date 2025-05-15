<h2>Tambah Data Penilaian</h2>
<table class="table table-bordered">
    <tr>
        <th>Id</th>
        <th>Nama Alternatif</th>
        <th>Harga</th>
        <th>Merk</th>
        <th>Garansi</th>
        <th>Kadaluwarsa</th>
        <th>Tingkat Kebutuhan</th>
        <th>Action</th>
    </tr>
    <?php foreach ($alternatif as $alt) { ?>
    <tr>
        <td><?php echo $alt->id; ?></td>
        <td><?php echo $alt->nama_alternatif; ?></td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>
            <a href="<?php echo site_url('penilaian/edit_nilai/'.$alt->id); ?>" class="btn btn-primary">Edit</a>
        </td>
    </tr>
    <?php } ?>
</table>
<a href="<?php echo site_url('penilaian/hitung_nilai'); ?>" class="btn btn-success">Hitung Nilai</a>
