<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">Laporan Nilai Seluruh Siswa-Siswi</h3></div>
	        <div class="panel-body">
				<form class="form-inline" action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
					<label for="tahun">Tahun :</label>
					<select class="form-control" name="tahun">
						<option>---</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
					</select>
					<button type="submit" class="btn btn-primary">Tampilkan</button>
				</form>
	            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
				<?php
				$q = $connection->query("SELECT b.kode, b.nama, h.nilai, m.nama AS siswa, m.nis, (SELECT MAX(nilai) FROM hasil WHERE nis=h.nis) AS nilai_max FROM siswa m JOIN hasil h ON m.nis=h.nis JOIN jenis b ON b.kode=h.kode WHERE m.tahun_daftar='$_POST[tahun]'");
				$jenis = []; $data = []; $d = [];
				while ($r = $q->fetch_assoc()) {
					$jenis[$r["kode"]] = $r["nama"];
					$s = $connection->query("SELECT b.nama, a.nilai FROM hasil a JOIN jenis b USING(kode) WHERE a.nis=$r[nis] AND a.tahun=$_POST[tahun]");
					while ($rr = $s->fetch_assoc()){
						$d[$rr['nama']] = $rr['nilai'];
					}
					$m = max($d);
					$k = array_search($m, $d);
					$data[$r["nis"]."-".$r["siswa"]."-".$r["nilai_max"]."-".$k][$r["kode"]] = $r["nilai"];
				}
				?>
				<hr>
				<table class="table table-condensed">
	                <thead>
	                    <tr>
							<th>Rangking</th>
							<th>NIM</th>
							<th>Nama</th>
							<th>Nilai</th>
							
							
	                    </tr>
	                </thead>
					<tbody>
					<?php $no = 1; ?>
					<?php foreach($data as $key => $val): ?>
						<tr>
							<td><?=$no++?></td>
							<?php $x = explode("-", $key); ?>
							<td><?=$x[0]?></td>
							<td><?=$x[1]?></td>
							<?php foreach ($val as $v): ?>
								<td><?=number_format($v, 8)?></td>
							<?php endforeach; ?>
							
						</tr>
					<?php endforeach ?>
					</tbody>
		            </table>
	            <?php endif; ?>
	        </div>
	    </div>
	</div>
</div>
