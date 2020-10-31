<?php
require_once("../config/config.php");


function get_dir_contents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = $dir . DIRECTORY_SEPARATOR . $value;
        if (!is_dir($path)) {
            $results[] = trim(str_replace($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR  . PATH_FILE . DIRECTORY_SEPARATOR , "", $path), DIRECTORY_SEPARATOR);
        } else if ($value != "." && $value != "..") {
          get_dir_contents($path, $results);
        }
    }

    return $results;
}

$result = get_dir_contents($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR  . PATH_FILE );

echo "<pre>";
print_r($result);