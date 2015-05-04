<?php
	
require_once('../../lib/influxdb-php/class.influxdb.php');
use boujois\influxdb\influx as influx;

$connection = new influx("demo","demo","http://localhost","8086");

echo "Connection Details: \n";
print_r($connection->show_config());

echo "\n\n";

echo "Server Status: \n";
print_r($connection->server_status());

?>