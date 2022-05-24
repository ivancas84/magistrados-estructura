<?php

require_once("class/controller/Base.php");

class MagistradosBackupApi extends BaseController{
  /**
   * Controlador de backup de base de datos
   * El directorio debe existir sino tira error
   **/
  
  public function main(){
    /**
     * Eliminar logs
     */
    $db = $this->container->getDb();
    $db->query("DELETE FROM log");

    /**
     * Realizar backup
     */
    $filename=date("Ymd_his") . '_' . $this->entityName . '.sql';
    $exec = "C:" . DIRECTORY_SEPARATOR. "xampp" . DIRECTORY_SEPARATOR. "mysql" . DIRECTORY_SEPARATOR. "bin" . DIRECTORY_SEPARATOR. "mysqldump -u ". DATA_USER . " " . DATA_DBNAME . " > " . $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . PATH_BACKUP . DIRECTORY_SEPARATOR . $filename;
    $result=system($exec,$output);
    if($output==''){ return ["file"=>PATH_BACKUP. DIRECTORY_SEPARATOR . $filename]; }
    else throw new Exception("Error al efectuar copia de seguridad");
  }

}
