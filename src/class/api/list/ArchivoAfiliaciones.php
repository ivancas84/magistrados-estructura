<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");

class ArchivoAfiliacionesListApi extends BaseApi {

  public $dir = null;
  public $permission = "r";

  public function main() {
    $data = php_input();
    return $this->get_dir_contents($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR  . PATH_FILE . DIRECTORY_SEPARATOR . $data["subdir"]);
  }
  
  function get_dir_contents($dir, &$results = array()) {
    $files = scandir($dir, SCANDIR_SORT_DESCENDING);

    foreach ($files as $key => $value) {
      $path = $dir . DIRECTORY_SEPARATOR . $value;
      // $results[] = trim(str_replace($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR  . PATH_FILE . DIRECTORY_SEPARATOR , "", $path), DIRECTORY_SEPARATOR);

      if (!is_dir($path)) {
        $results[] = trim(str_replace($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR  . PATH_FILE . DIRECTORY_SEPARATOR , "", $path), DIRECTORY_SEPARATOR);
      } else if ($value != "." && $value != "..") {
        $this->get_dir_contents($path, $results);
      }
    }

    return $results;
  }

}
