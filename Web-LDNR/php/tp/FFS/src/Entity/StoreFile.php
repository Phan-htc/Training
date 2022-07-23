<?php
namespace App\Entity;

class StoreFile {

  protected $pathCSV;

  protected $pathZIP;

  public function getPathCSV() {
    return $this->pathCSV;
  }
  
  public function setPathCSV($path) {
    $this->pathCSV = $path;
  }
  
  public function getPathZIP() {
    return $this->pathZIP;
  }
  
  public function setPathZIP($path) {
    $this->pathZIP = $path;
  }
}
