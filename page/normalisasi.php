<?php
spl_autoload_register(function($class){
  require_once $class.'.php';
});

$saw = new Saw();
 ?>

<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">Data Siswa-Siswi</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
              <thead>
  <tr>
  <th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Alamat</th>
  </tr>
  </thead>
  <tbody>
<?php
$no = 1;
$karyawan = $saw->get_data_karyawan();
while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) { 
?>
  <tr>
    <td><?=$no++?></td>
    <td><?php echo $data_karyawan['nis']; ?></td>
    <td><?php echo $data_karyawan['nama']; ?></td>
    <td><?php echo $data_karyawan['alamat']; ?></td>
  </tr>

<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">Kriteria</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
              <thead> 
  <tr>
  <th rowspan="2">No</th>
    <th rowspan="2">NIS</th>
    <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
  <tr>
  <?php 
  $no = 1;
  $kriteria = $saw->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?> 
      <th>C<?php echo $data_kriteria['kd_kriteria']; ?></th>

  <?php } ?>
  </tr>
  </thead>
  <tbody>
  
  <?php
  $karyawan = $saw->get_data_karyawan();
  while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
  ?> 
    <tr>
    <td><?=$no++?></td>
      <td>E<?php echo $data_karyawan['nis']; ?></td>
      <?php
      $nilai = $saw->get_data_nilai_id($data_karyawan['nis']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) { ?>
        <td><?php echo $data_nilai['nilai']; ?></td>

      <?php } ?>
    </tr>

  <?php } ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">Normalisasi</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
              <thead>
  <tr>
  <th rowspan="2">No</th>
    <th rowspan="2">NIS</th>
    <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
  </tr>

  </tr>

  <tr>
  <?php
  $no = 1;
  $hasil_ranks=array();
  $kriteria = $saw->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <th>C<?php echo $data_kriteria['kd_kriteria']; ?></th>

  <?php } ?>
  </tr>
  </thead>
  <tbody>
  <?php
  $karyawan = $saw->get_data_karyawan();
  while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
  <td><?=$no++?></td>
      <td><?php echo $data_karyawan['nis']; ?></td>
      <?php
      // tampilkan nilai dengan nis ...
      $hasil_normalisasi=0;
      $nilai = $saw->get_data_nilai_id($data_karyawan['nis']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
      //
        $kriteria = $saw->get_data_kriteria_id($data_nilai['kd_kriteria']);
        while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          if ($data_kriteria['sifat']=="min") {
            $min = $saw->nilai_min($data_nilai['kd_kriteria']);
            while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
                
                  <?php
                   echo number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                   ?>
                 
              </td>
            <?php } ?>

          <?php }elseif ($data_kriteria['sifat']=="max") {
            $max = $saw->nilai_max($data_nilai['kd_kriteria']);
            while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
                
                  <?php
                  echo $hasil = $data_nilai['nilai']/$data_max['max'];
                    $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                  ?>
                
              </td>
            <?php } ?>
          <?php }
        ?>

        <?php } } ?>

    </tr>
  <?php } ?>

  </tbody>
</table>
</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">Pembobotan</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
              <thead>
  <tr>
  <th rowspan="2">No</th>
    <th rowspan="2">NIS</th>
    <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
    
  </tr>

  

  <tr>

  <?php
  $no = 1;
  $kriteria = $saw->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <th>C<?php echo $data_kriteria['kd_kriteria']; ?></th>

  <?php } ?>
  <th rowspan="2">Hasil</th> </tr>
  </thead>
  <tbody>
  <?php
  $hasil_ranks=array();
  $karyawan = $saw->get_data_karyawan();
  while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
    <td><?=$no++?></td>
      <td><?php echo $data_karyawan['nis']; ?></td>
      <?php
      // tampilkan nilai dengan nis ...
      $hasil_normalisasi=0;
      $nilai = $saw->get_data_nilai_id($data_karyawan['nis']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
      //
        $kriteria = $saw->get_data_kriteria_id($data_nilai['kd_kriteria']);
        while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          if ($data_kriteria['sifat']=="min") {
            $min = $saw->nilai_min($data_nilai['kd_kriteria']);
            while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
              
                  <?php
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      echo  $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                   ?>
                 
              </td>
            <?php } ?>

          <?php }elseif ($data_kriteria['sifat']=="max") {
            $max = $saw->nilai_max($data_nilai['kd_kriteria']);
            while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
              
                  <?php
                    $hasil = $data_nilai['nilai']/$data_max['max'];
                    echo $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                  ?>
                
              </td>
            <?php } ?>
          <?php }
        ?>

        <?php } } ?>

      <td>

        <?php

        $hasil_rank['nilai'] = $hasil_normalisasi;
        $hasil_rank['siswa'] = $data_karyawan['nama'];
        array_push($hasil_ranks,$hasil_rank);
        echo $hasil_normalisasi; ?>
      </
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">Rangking</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
              <thead>
  <tr>
    <th>Ranking</th>
    <th>Nama</th>
    <th>Nilai Akhir</th>
  </tr>
  </thead>
  <tbody>
  <?php
   $no=1;
   rsort($hasil_ranks);
   foreach ($hasil_ranks as $rank) { ?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td><?php echo $rank['siswa']; ?></td>
    <td><?php echo $rank['nilai']; ?></td>
  </tr>
  <?php } ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>

<center>Azizah Wina Sriwinarsih -  <?php echo date("Y"); ?> </center>
<br><br>
