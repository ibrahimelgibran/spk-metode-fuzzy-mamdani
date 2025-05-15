<h2 style="margin-top:0px">Penilaian <?php echo $button ?></h2>
<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="alternatif_id">Nama Alternatif <?php echo form_error('alternatif_id') ?></label>
        <select class="form-control" name="alternatif_id" id="alternatif_id">
            <?php foreach ($alternatif_list as $alternatif) { ?>
                <option value="<?php echo $alternatif->id_alternatif; ?>" <?php echo ($alternatif_id == $alternatif->id_alternatif) ? 'selected' : ''; ?>>
                    <?php echo $alternatif->nama_alternatif; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="harga">Harga <?php echo form_error('harga') ?></label>
        <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan Harga" value="<?php echo $harga; ?>" />
    </div>

    <div class="form-group">
        <label for="merk">Merk <?php echo form_error('merk') ?></label>
        <input type="text" class="form-control" name="merk" id="merk" placeholder="Masukkan Merk" value="<?php echo $merk; ?>" />
    </div>

    <div class="form-group">
        <label for="garansi">Garansi <?php echo form_error('garansi') ?></label>
        <input type="text" class="form-control" name="garansi" id="garansi" placeholder="Masukkan Garansi" value="<?php echo $garansi; ?>" />
    </div>

    <div class="form-group">
        <label for="kadaluwarsa">Tanggal Kadaluwarsa <?php echo form_error('kadaluwarsa') ?></label>
        <input type="date" class="form-control" name="kadaluwarsa" id="kadaluwarsa" value="<?php echo $kadaluwarsa; ?>" />
    </div>

    <div class="form-group">
        <label for="tingkat_kebutuhan">Tingkat Kebutuhan <?php echo form_error('tingkat_kebutuhan') ?></label>
        <input type="number" class="form-control" name="tingkat_kebutuhan" id="tingkat_kebutuhan" placeholder="Masukkan Tingkat Kebutuhan (1-10)" value="<?php echo $tingkat_kebutuhan; ?>" />
    </div>

    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 

    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('penilaian') ?>" class="btn btn-default">Batal</a>
</form>
