<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM kriteria WHERE kd_kriteria='$_GET[key]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validasi = false; $err = false;
	if ($update) {
		$sql = "UPDATE kriteria SET kode=$_POST[kode], nama='$_POST[nama]', sifat='$_POST[sifat]', bobot='$_POST[bobot]' WHERE kd_kriteria='$_GET[key]'";
	} else {
		$sql = "INSERT INTO kriteria VALUES (NULL, $_POST[kode], '$_POST[nama]', '$_POST[sifat]', '$_POST[bobot]')";
		$validasi = true;
	}

	if ($validasi) {
		$q = $connection->query("SELECT kd_kriteria FROM kriteria WHERE kode=$_POST[kode] AND nama LIKE '%$_POST[nama]%'AND bobot=$_POST[bobot]");
		if ($q->num_rows) {
			echo alert("Kriteria sudah ada!", "?page=kriteria");
			$err = true;
		}
	}

  if (!$err AND $connection->query($sql)) {
		echo alert("Berhasil!", "?page=kriteria");
	} else {
		echo alert("Gagal!", "?page=kriteria");
	}
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM kriteria WHERE kd_kriteria='$_GET[key]'");
	echo alert("Berhasil!", "?page=kriteria");
}
?>
<div class="row">
	<div class="col-md-4">
	    <div class="panel panel-<?= ($update) ? "warning" : "info" ?>">
	        <div class="panel-heading"><h3 class="text-center"><?= ($update) ? "EDIT" : "TAMBAH" ?></h3></div>
	        <div class="panel-body">
	            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
									<div class="form-group">
										<label for="kode">Jenis</label>
										<select class="form-control" name="kode">
											<?php $query = $connection->query("SELECT * FROM jenis"); while ($data = $query->fetch_assoc()): ?>
												<option value="<?=$data["kode"]?>" <?= (!$update) ?: (($row["kode"] != $data["kode"]) ?: 'selected="on"') ?>><?=$data["nama"]?></option>
											<?php endwhile; ?>
										</select>
									</div>
	                <div class="form-group">
	                    <label for="nama">Nama</label>
	                    <input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
	                </div>
									<div class="form-group">
	                    <label for="bobot">Bobot</label>
	                    <input type="text" name="bobot" class="form-control" <?= (!$update) ?: 'value="'.$row["bobot"].'"' ?>>
	                </div>
						<div class="form-group">
	                  <label for="sifat" ></label>
					  <input type="hidden" name="sifat" class="form-control" readonly value="max" <?= (!$update) ?: (($row["sifat"] != "max") ?: 'selected="on"') ?>>
									</div>
	                <button type="submit" class="btn btn-<?= ($update) ? "success" : "info" ?> btn-block">Simpan</button>
	                <?php if ($update): ?>
										<a href="?page=kriteria" class="btn btn-info btn-block">Batal</a>
									<?php endif; ?>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="col-md-8">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">DAFTAR KRITERIA</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>Kode</th>
	                        <th>Kriteria</th>
	                        <th>Bobot</th>
	                        <th></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php if ($query = $connection->query("SELECT a.nama AS kriteria, b.nama AS jenis, a.kd_kriteria, a.sifat, a.bobot FROM kriteria a JOIN jenis b USING(kode)")): ?>
	                        <?php while($row = $query->fetch_assoc()): ?>
	                        <tr>
	                            <td><?=$no++?></td>
	                            <td>C<?=$row['kd_kriteria']?></td>
	                            <td><?=$row['kriteria']?></td>
	                            <td><?=$row['bobot']?></td>
	                            <td>
	                                <div class="btn-group">
	                                    <a href="?page=kriteria&action=update&key=<?=$row['kd_kriteria']?>" class="btn btn-light btn-xs">Edit</a>
	                                    <a href="?page=kriteria&action=delete&key=<?=$row['kd_kriteria']?>" class="btn btn-danger btn-xs">Hapus</a>
	                                </div>
	                            </td>
	                        </tr>
	                        <?php endwhile ?>
	                    <?php endif ?>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
