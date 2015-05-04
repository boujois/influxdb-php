<?php
	
require_once('../../lib/influxdb-php/class.influxdb.php');
use boujois\influxdb\influx as influx;

$influx = new influx("demo","demo","http://localhost","8086");
$influx->select_database("mydb");
$result=$influx->query("select * from foo");

echo "Result: \n";
print_r($result);

?>