<h2>Edit Penilaian</h2>
<form action="<?php echo site_url('penilaian/update_nilai'); ?>" method="post">
    <input type="hidden" name="alternatif_id" value="<?php echo $alternatif_id; ?>" />
    
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" name="harga" value="<?php echo $penilaian->harga ?? ''; ?>">
    </div>

    <div class="form-group">
        <label>Merk</label>
        <input type="text" class="form-control" name="merk" value="<?php echo $penilaian->merk ?? ''; ?>">
    </div>

    <div class="form-group">
        <label>Garansi</label>
        <input type="text" class="form-control" name="garansi" value="<?php echo $penilaian->garansi ?? ''; ?>">
    </div>

    <div class="form-group">
        <label>Kadaluwarsa</label>
        <input type="date" class="form-control" name="kadaluwarsa" value="<?php echo $penilaian->kadaluwarsa ?? ''; ?>">
    </div>

    <div class="form-group">
        <label>Tingkat Kebutuhan</label>
        <input type="number" class="form-control" name="tingkat_kebutuhan" value="<?php echo $penilaian->tingkat_kebutuhan ?? ''; ?>">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?php echo site_url('penilaian'); ?>" class="btn btn-default">Batal</a>
</form>
