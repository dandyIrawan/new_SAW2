<?php

/**
 *
 */
class Saw
{
  private $db;
  function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=beasiswa_db', "root", "");
    // $this->db = new PDO('mysql:host=mysql.idhostinger.com;dbname=u241789732_putri', "u241789732_root", "39133494");
  }

  public function get_data_kriteria(){
    $stmt = $this->db->prepare("SELECT*FROM kriteria ORDER BY kd_kriteria");
    $stmt->execute();
		return $stmt;
  }

  public function get_data_karyawan(){
    $stmt = $this->db->prepare("SELECT*FROM mahasiswa ORDER BY nim");
    $stmt->execute();
    return $stmt;
  }

  public function get_data_kriteria_id($id){
    $stmt = $this->db->prepare("SELECT*FROM kriteria WHERE kd_kriteria='$id' ORDER BY kd_kriteria");
    $stmt->execute();
		return $stmt;
  }

  public function get_data_nilai_id($id){
    $stmt = $this->db->prepare("SELECT*FROM nilai WHERE nim='$id' ORDER BY kd_kriteria");
    $stmt->execute();
    return $stmt;
  }

  public function nilai_max($id){
    $stmt = $this->db->prepare("SELECT kd_kriteria, MAX(nilai) AS max FROM nilai WHERE kd_kriteria='$id' GROUP BY kd_kriteria");
    $stmt->execute();
    return $stmt;
  }

  public function nilai_min($id){
    $stmt = $this->db->prepare("SELECT kd_kriteria, MIN(nilai) AS min FROM nilai WHERE kd_kriteria='$id' GROUP BY kd_kriteria");
    $stmt->execute();
    return $stmt;
  }

}

 ?>
