<?php

namespace boujois\influxdb;

class influx {
	public $user;
	public $pass;
	public $server;
	public $port;
	public $db;

	public function __construct($user, $pass, $server, $port){
		$this->user      = $user;
		$this->pass      = $pass;
		$this->server    = $server;
		$this->port      = $port;
	}

	public function show_config(){
		$output=array(
			"user"   => $this->user,
			"pass"   => $this->pass,
			"server" => $this->server,
			"port"   => $this->port
		);
		return $output;
	}

	public function server_status(){
		$output=$this->curl_get("ping");
		return(json_decode($output,TRUE));
	}

	public function show_databases(){
		$query_string_array=array();
		$query_string_array=$this->add_credentials();
		$query_string=http_build_query($query_string_array);
		$output=$this->curl_get("db",$query_string);
		return(json_decode($output,TRUE));
	}

	public function select_database($db){
		$this->db=$db;
	}

	public function query($query){
		if(!isset($this->db)){
			$output["error"]="you must use select_database() first";
			return $output;
		}
		$query_string_array=array();
		$query_string_array=$this->add_credentials();
		$query_string_array["q"]=$query;
		$query_string=http_build_query($query_string_array);
		$output=$this->curl_get("db/".$this->db."/series",$query_string);
		return(json_decode($output,TRUE));
	}

	public function add_credentials(){
		$array["u"]=$this->user;
		$array["p"]=$this->pass;
		return $array;
	}


	public function curl_get($method,$query_string=null){
		$ch = curl_init();
		// check for query string parameters
		if(is_null($query_string)){
			$url=$this->server."/".$method;
		}
		else{
			$url=$this->server."/".$method."?".$query_string;
		}
		//echo $url."\n";
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PORT, $this->port);
		$output = curl_exec($ch); 
		curl_close($ch);
		return $output;
	}

}

?>
