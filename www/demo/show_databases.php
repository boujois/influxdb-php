<?php
	
require_once('../../lib/influxdb-php/class.influxdb.php');
use boujois\influxdb\influx as influx;

$connection = new influx("demo","demo","http://localhost","8086");

echo "Databases: \n";
print_r($connection->show_databases());

?>