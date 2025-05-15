<div class="container-fluid">
    <h2 style="margin-top:0px">Data Alternatif</h2>
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <a href="<?php echo site_url('alternatif/create'); ?>" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="col-md-4 text-center">
            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4 text-right">
            <form action="<?php echo site_url('alternatif/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Alternatif</th>
                    <th>Harga</th>
                    <th>Merk</th>
                    <th>Garansi</th>
                    <th>Kadaluarsa</th>
                    <th>Tingkat Kebutuhan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alternatif_data)): ?>
                <?php foreach ($alternatif_data as $alternatif): ?>
                <tr>
                    <td><?php echo $alternatif->id ?></td>
                    <td><?php echo $alternatif->nama_alternatif ?></td>
                    <td><?php echo $alternatif->harga ?></td>
                    <td><?php echo $alternatif->merk ?></td>
                    <td><?php echo $alternatif->garansi ?></td>
                    <td><?php echo $alternatif->keahlianaa ?></td>
                    <td><?php echo $alternatif->tingkat_kebutuhan ?></td>
                    <td>
                        <a href="<?php echo site_url('alternatif/update/'.$alternatif->id) ?>" class="btn btn-primary btn-sm">Total</a>
                        <a href="<?php echo site_url('alternatif/update/'.$alternatif->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?php echo site_url('alternatif/delete/'.$alternatif->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No data available in table</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary">Hitung Nilai</a>
            <a href="#" class="btn btn-primary">Edit Nilai</a>
        </div>
        <div class="col-md-6 text-right">
            <?php echo $pagination ?>
        </div>
    </div>
</div>