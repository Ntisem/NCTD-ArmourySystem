<?php
  class Connect extends PDO{
    public function __construct(){
        parent::__construct("msql:host=localhost;dbname=gps_armoury_database", 'root', '',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utd8"));
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  }
}
$tbl_Notifications = 'notifications';
// $theid = 'id';
?>