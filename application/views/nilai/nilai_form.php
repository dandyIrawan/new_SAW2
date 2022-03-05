<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="int">Nama Siswa <?php echo form_error('id_siswa') ?></label>
            <!-- <input type="text" class="form-control" name="id_siswa" id="id_siswa" placeholder="Id Siswa" value="<?php echo $id_siswa; ?>" /> -->
            <select class="form-control" name="id_siswa">
                <?php 
                $d = $this->db->query("SELECT * FROM siswa where id_siswa='$id_siswa'");
                if ($d->num_rows() == null) {
                 ?>
                <option value="">--Pilih Siswa--</option>
                <?php }else { 
                    $d = $d->row();
                    ?>
                <option value="<?php echo $d->id_siswa; ?>"><?php echo $d->nis.'-'.$d->nama; ?></option>

                <?php 
                }
                $sql = $this->db->query("SELECT * FROM siswa");
                foreach ($sql->result() as $row) {
                 ?>
                <option value="<?php echo $row->id_siswa; ?>"><?php echo $row->nis.'-'.$row->nama; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="int">Kriteria <?php echo form_error('id_kriteria') ?></label>
            <!-- <input type="text" class="form-control" name="id_kriteria" id="id_kriteria" placeholder="Id Kriteria" value="<?php echo $id_kriteria; ?>" /> -->
            <select class="form-control" name="id_kriteria">
                <?php 
                $d = $this->db->query("SELECT * FROM kriteria where id_kriteria='$id_kriteria'");
                if ($d->num_rows() == null) {
                 ?>
                <option value="">--Pilih Kriteria--</option>
                <?php }else { 
                    $d = $d->row();
                    ?>
                <option value="<?php echo $d->id_kriteria; ?>"><?php echo $d->kriteria; ?></option>
                <?php 
                }
                $sql = $this->db->query("SELECT * FROM kriteria");
                foreach ($sql->result() as $row) {
                 ?>
                <option value="<?php echo $row->id_kriteria; ?>"><?php echo $row->kriteria; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Nilai <?php echo form_error('nilai') ?></label>
            <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" value="<?php echo $nilai; ?>" />
        </div>
        <input type="hidden" name="id_nilai" value="<?php echo $id_nilai; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('nilai') ?>" class="btn btn-default">Cancel</a>
    </form>