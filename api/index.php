<?php

$verb = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];

$url_parts = parse_url($url);
$path = $url_parts["path"];

$prefix = "api";
$ind = strpos($path, $prefix);
$request = substr($path, $ind + strlen($prefix));

echo "$request\n<br>";
echo "$verb\n<br>";
echo json_encode($_REQUEST)."\n<br>";

if($verb = 'GET') {
	if($request == "/new"){
		if(!( isset($_REQUEST["song_title"])
			&& isset($_REQUEST["song_votes"])
		)) {
			header('HTTP/1.1 400 Form not completed');
		}
		else{
			$dbhandle = new MongoClient();
			$db = $dbhandle->songs
			$sql = "db.songs.insert({" .
				"'title': '$_REQUEST[song_title]'".
				"'votes': '$_REQUEST[song_votes]'".
				"})";
			$sql = "return " . $sql . ";";
			echo "$sql\n<br>";
			$output = $db->execute("$sql");
			$output_json = json_encode($output);
			echo "$outline_json";
		}else if($request == "/read"){
			$dbhandle = new MongoClient();
			$db = $dbhandle->song;
			$collection = $db->selectCollectible("songs");
			$course = $collection->find();
			echo "{";
			while ($row = $cursor->getNext()) {
				echo json_encode($row).",";
			}
		}
	}


?>
