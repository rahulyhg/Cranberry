<?php

require_once('core/require.php');

use Cranberry\Database;
use Cranberry\Settings;

$mediaID = $_GET['id'];

if(Database::MatchingRowCount('media', 'id', $mediaID) == 1){
	$media = Database::ExecReturn('SELECT id, mimetype, filename FROM media WHERE id = ?', [$mediaID]);
	$mediaPath = Settings::$mediaPath . DIRECTORY_SEPARATOR . $media['filename'];

	header('Content-Type: ' . $media['mimetype']);
	if(file_exists($mediaPath)){
		readfile($mediaPath);
	}
	else{
		Fail();
	}
}
else{
	Fail();
}

function Fail(){
	header('Content-Type: image/png');
	readfile('assets/mediaerror.png');
}

?>