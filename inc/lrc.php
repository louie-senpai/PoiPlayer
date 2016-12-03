<?php
header('Content-Type: text/text; charset=utf-8');
ERROR_REPORTING(0);
if(isset($_GET['id'])){
$id = $_GET['id'];
$getjson = 'http://music.163.com/api/song/media?id='.$id.'';
$content = file_get_contents($getjson);
preg_match('|"lyric":"(.+)"|U', $content, $matches);
if(!$matches[1]){
	$lrc = '[00:00.500]暂无歌词';
}elseif(!strstr($matches[1],"[")){
	$lrc = '[00:00.500]歌词不支持滚动';
}else{
	$lrc = $matches[1];
}
$lrc = str_replace('\n', "\n", $lrc);
$lrc = str_replace('\r', "\r", $lrc);
$lrc = stripslashes($lrc);
echo $lrc;
}
?>