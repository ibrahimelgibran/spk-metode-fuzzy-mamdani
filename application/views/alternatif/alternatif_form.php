<div class="container-fluid">
    <h2 style="margin-top:0px"><?php echo $button == 'Tambah Data' ? 'Tambah' : 'Edit'; ?> Data Alternatif</h2>
    <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="nama_alternatif">Nama Alternatif <?php echo form_error('nama_alternatif') ?></label>
            <input type="text" class="form-control" name="nama_alternatif" id="nama_alternatif" placeholder="Nama Alternatif" value="<?php echo $nama_alternatif; ?>" />
        </div>
        <div class="form-group">
            <label for="harga">Harga <?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
        </div>
        <div class="form-group">
            <label for="merk">Merk <?php echo form_error('merk') ?></label>
            <input type="text" class="form-control" name="merk" id="merk" placeholder="Merk" value="<?php echo $merk; ?>" />
        </div>
        <div class="form-group">
            <label for="garansi">Garansi <?php echo form_error('garansi') ?></label>
            <input type="text" class="form-control" name="garansi" id="garansi" placeholder="Garansi" value="<?php echo $garansi; ?>" />
        </div>
        <div class="form-group">
            <label for="keahlianaa">Kadaluarsa <?php echo form_error('keahlianaa') ?></label>
            <input type="text" class="form-control" name="keahlianaa" id="keahlianaa" placeholder="Kadaluarsa" value="<?php echo $keahlianaa; ?>" />
        </div>
        <div class="form-group">
            <label for="tingkat_kebutuhan">Tingkat Kebutuhan <?php echo form_error('tingkat_kebutuhan') ?></label>
            <input type="text" class="form-control" name="tingkat_kebutuhan" id="tingkat_kebutuhan" placeholder="Tingkat Kebutuhan" value="<?php echo $tingkat_kebutuhan; ?>" />
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('alternatif') ?>" class="btn btn-default">Cancel</a>
    </form>
</div>