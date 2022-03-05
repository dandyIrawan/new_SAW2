<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Nis <?php echo form_error('nis') ?></label>
            <input type="text" class="form-control" name="nis" id="nis" placeholder="Nis" value="<?php echo $nis; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Jenis Kelamin <?php echo form_error('jeniskelamin') ?></label>
            <input type="text" class="form-control" name="jeniskelamin" id="jeniskelamin" placeholder="Jenis Kelamin" value="<?php echo $jeniskelamin; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Asal Sekolah <?php echo form_error('asalsekolah') ?></label>
            <input type="text" class="form-control" name="asalsekolah" id="asalsekolah" placeholder="Asal Sekolah" value="<?php echo $asalsekolah; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Tanggal Masuk <?php echo form_error('tanggal_masuk') ?></label>
            <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" placeholder="Tanggal Masuk" value="<?php echo $tanggal_masuk; ?>" />
        </div>
        <input type="hidden" name="id_siswa" value="<?php echo $id_siswa; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('siswa') ?>" class="btn btn-default">Cancel</a>
    </form>