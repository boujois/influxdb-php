<?php
	
require_once('../../lib/influxdb-php/class.influxdb.php');
use boujois\influxdb\influx as influx;

$influx = new influx("demo","demo","http://localhost","8086");

echo "Databases: \n";
print_r($influx->show_databases());

?>