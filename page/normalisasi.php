<?php
spl_autoload_register(function($class){
  require_once $class.'.php';
});

$saw = new Saw();
 ?>
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">Kriteria</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
              <thead>
  <tr>
  <th> No</th>
    <th> Nama Kriteria </th>
    <th> sifat </th>
   <th> Bobot </th>
  </tr>
  </thead>
  <tbody>
<?php
$no=1;
$kriteria = $saw->get_data_kriteria();
$jml_kriteria = $kriteria->rowCount();
while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
?>
  <tr>
    <td><?php echo $data_kriteria['kd_kriteria']; ?></td>
    <td><?php echo $data_kriteria['nama']; ?></td>
    <td><?php echo $data_kriteria['sifat']; ?></td>
    <td><?php echo $data_kriteria['bobot']; ?></td>
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
	        <div class="panel-heading"><h3 class="text-center">Karyawan</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
              <thead>
  <tr>
    <th>No</th>
    <th>Nama Karyawan</th>
    <th>Alamat</th>
  </tr>
  </thead>
  <tbody>
<?php
$no=1;
$karyawan = $saw->get_data_karyawan();
while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
?>
  <tr>
    <td>E<?php echo $data_karyawan['nim']; ?></td>
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
	        <div class="panel-heading"><h3 class="text-center">Karyawan Kriteria</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
              <thead>
  <tr>
    <th rowspan="2"><center>Karyawan</center></th>
    <th colspan="<?php echo $jml_kriteria; ?>"><center>Kriteria</center></th>
  <tr>
  <?php
  $kriteria = $saw->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <th><center>C<?php echo $data_kriteria['kd_kriteria']; ?></center></th>

  <?php } ?>
  </tr>
  </thead>
  <tbody>
  <?php
  $karyawan = $saw->get_data_karyawan();
  while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
      <td><center>E<?php echo $data_karyawan['nim']; ?></center></td>
      <?php
      $nilai = $saw->get_data_nilai_id($data_karyawan['nim']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) { ?>
        <td><center><?php echo $data_nilai['nilai']; ?></center></td>

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
    <th rowspan="2"><center>Karyawan</center></th>
    <th colspan="<?php echo $jml_kriteria; ?>"><center>Kriteria</center></th>
  </tr>

  </tr>

  <tr>
  <?php
  $hasil_ranks=array();
  $kriteria = $saw->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <th><center>C<?php echo $data_kriteria['kd_kriteria']; ?></center></th>

  <?php } ?>
  </tr>
  </thead>
  <tbody>
  <?php
  $karyawan = $saw->get_data_karyawan();
  while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
      <td><center>K<?php echo $data_karyawan['nim']; ?></center></td>
      <?php
      // tampilkan nilai dengan nim ...
      $hasil_normalisasi=0;
      $nilai = $saw->get_data_nilai_id($data_karyawan['nim']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
      //
        $kriteria = $saw->get_data_kriteria_id($data_nilai['kd_kriteria']);
        while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          if ($data_kriteria['sifat']=="min") {
            $min = $saw->nilai_min($data_nilai['kd_kriteria']);
            while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
                <center>
                  <?php
                   echo number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                   ?>
                 </center>
              </td>
            <?php } ?>

          <?php }elseif ($data_kriteria['sifat']=="max") {
            $max = $saw->nilai_max($data_nilai['kd_kriteria']);
            while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
                <center>
                  <?php
                  echo $hasil = $data_nilai['nilai']/$data_max['max'];
                    $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                  ?>
                </center>
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
    <th rowspan="2"><center>Karyawan</center></th>
    <th colspan="<?php echo $jml_kriteria; ?>"><center>Kriteria</center></th>
    <th rowspan="2"><center>Hasil</center></th>
  </tr>

  </tr>

  <tr>
  <?php
  $kriteria = $saw->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <th><center>C<?php echo $data_kriteria['kd_kriteria']; ?></center></th>

  <?php } ?>
  </tr>
  </thead>
  <tbody>
  <?php
  $hasil_ranks=array();
  $karyawan = $saw->get_data_karyawan();
  while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
      <td><center>E<?php echo $data_karyawan['nim']; ?></center></td>
      <?php
      // tampilkan nilai dengan nim ...
      $hasil_normalisasi=0;
      $nilai = $saw->get_data_nilai_id($data_karyawan['nim']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
      //
        $kriteria = $saw->get_data_kriteria_id($data_nilai['kd_kriteria']);
        while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          if ($data_kriteria['sifat']=="min") {
            $min = $saw->nilai_min($data_nilai['kd_kriteria']);
            while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
                <center>
                  <?php
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      echo  $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                   ?>
                 </center>
              </td>
            <?php } ?>

          <?php }elseif ($data_kriteria['sifat']=="max") {
            $max = $saw->nilai_max($data_nilai['kd_kriteria']);
            while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
                <center>
                  <?php
                    $hasil = $data_nilai['nilai']/$data_max['max'];
                    echo $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                  ?>
                </center>
              </td>
            <?php } ?>
          <?php }
        ?>

        <?php } } ?>

      <td><center>

        <?php

        $hasil_rank['nilai'] = $hasil_normalisasi;
        $hasil_rank['mahasiswa'] = $data_karyawan['nama'];
        array_push($hasil_ranks,$hasil_rank);
        echo $hasil_normalisasi; ?>
      </<center>
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
    <th><center>Ranking</center></th>
    <th><center>Nama Karyawan</center></th>
    <th><center>Nilai Akhir</center></th>
  </tr>
  </thead>
  <tbody>
  <?php
   $no=1;
   rsort($hasil_ranks);
   foreach ($hasil_ranks as $rank) { ?>
  <tr>
    <td><center><?php echo $no++ ?></center></td>
    <td><center><?php echo $rank['mahasiswa']; ?></center></td>
    <td><center><?php echo $rank['nilai']; ?></center></td>
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
