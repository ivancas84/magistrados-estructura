<?php

require_once("class/api/Base.php");

class ArchivoAfiliacionesListApi extends BaseApi {

  public $dir = null;
  public $permission = "r";

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);

    return $this->get_dir_contents($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR  . PATH_FILE);
  }
  
  function get_dir_contents($dir, &$results = array()) {
    $files = scandir($dir, SCANDIR_SORT_DESCENDING);

    foreach ($files as $key => $value) {
      $path = $dir . DIRECTORY_SEPARATOR . $value;
      if (!is_dir($path)) {
        $results[] = trim(str_replace($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR  . PATH_FILE . DIRECTORY_SEPARATOR , "", $path), DIRECTORY_SEPARATOR);
      } else if ($value != "." && $value != "..") {
        $this->get_dir_contents($path, $results);
      }
    }

    return $results;
  }

}