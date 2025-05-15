<h2 style="margin-top:0px">Kriteria <?php echo $button ?></h2>
<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="nama_kriteria">Nama Kriteria <?php echo form_error('nama_kriteria') ?></label>
        <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" placeholder="Nama Kriteria" value="<?php echo $nama_kriteria; ?>" />
    </div>

    <div class="form-group">
    <label for="bobot">Bobot <?php echo form_error('bobot') ?></label>
    <input type="number" step="any" class="form-control" name="bobot" id="bobot" placeholder="Bobot" value="<?php echo $bobot; ?>" />
</div>


    <input type="hidden" name="id_kriteria" value="<?php echo $id_kriteria; ?>" /> 
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('kriteria') ?>" class="btn btn-default">Cancel</a>
</form>
