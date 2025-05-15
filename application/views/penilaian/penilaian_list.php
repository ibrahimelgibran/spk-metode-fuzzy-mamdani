<h2 style="margin-top:0px">Daftar Penilaian</h2>

<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url('penilaian/create'),'Tambah Data', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') ?? ''; ?>
        </div>
    </div>
    <div class="col-md-3 text-right">
        <form action="<?php echo site_url('penilaian/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php if ($q != '') { ?>
                        <a href="<?php echo site_url('penilaian'); ?>" class="btn btn-default">Reset</a>
                    <?php } ?>
                    <button class="btn btn-primary" type="submit">Cari</button>
                </span>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>Id</th>
        <th>Nama Alternatif</th>
        <th>Harga</th>
        <th>Merk</th>
        <th>Garansi</th>
        <th>Kadaluwarsa</th>
        <th>Tingkat Kebutuhan</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($penilaian_data as $penilaian) { ?>
    <tr>
        <td><?php echo $penilaian->id_penilaian; ?></td>
        <td><?php echo $penilaian->nama_alternatif; ?></td>
        <td><?php echo $penilaian->harga; ?></td>
        <td><?php echo $penilaian->merk; ?></td>
        <td><?php echo $penilaian->garansi; ?></td>
        <td><?php echo $penilaian->kadaluwarsa; ?></td>
        <td><?php echo $penilaian->tingkat_kebutuhan; ?></td>
        <td style="text-align:center">
            <?php 
            echo anchor(site_url('penilaian/update/'.$penilaian->id_penilaian),'Edit', 'class="btn btn-warning btn-sm"');
            echo ' | ';
            echo anchor(site_url('penilaian/delete/'.$penilaian->id_penilaian),'Hapus','class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin?\')"'); 
            ?>
        </td>
    </tr>
    <?php } ?>
</table>

<div class="row">
    <div class="col-md-6">
        <a href="#" class="btn btn-primary">Total Data: <?php echo $total_rows ?></a>
    </div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div>
