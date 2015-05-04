<?php
	
require_once('../../lib/influxdb-php/class.influxdb.php');
use boujois\influxdb\influx as influx;

$influx = new influx("demo","demo","http://localhost","8086");

echo "Connection Details: \n";
print_r($influx->show_config());

echo "\n\n";

echo "Server Status: \n";
print_r($influx->server_status());

?>