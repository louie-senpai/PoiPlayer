<?php
header("Content-Type: application/json;charset=UTF-8");
error_reporting(0);
require 'inc/api/json.php';
$request = $_GET['request'];
$id = $_GET['id'];
if ( $request == 'song' && !empty($id) ) {
    $url = song($id);
    echo '{"url":"'.$url.'","br":320}';
}
elseif ( $request == 'cover' && !empty($id) ) {
	$url = cover($id);
 	echo '{"url":"'.$url.'","size":200}';
}
else {
	echo '404';
}
