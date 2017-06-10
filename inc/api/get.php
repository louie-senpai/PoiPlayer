<?php
/*
* 感谢谷歌
*/

function netease_playlist($playlist_id){

	$response = netease_http(0, $playlist_id);

	if ($response["code"] == 200 && $response["result"]) {
		//处理音乐信息
		$result = $response["result"]["tracks"];
		$count  = count($result);

		if ($count < 1) return false;

		$collect_name   = $response["result"]["name"];
		$collect_cover  = $response["result"]["coverImgUrl"];
		$collect_tags   = $response["result"]["tags"];
		//$collect_description = $response["result"]["description"]; //描述

		$collect = array(
			"collect_id"     => $playlist_id,
			"collect_title"  => $collect_name,
			"collect_author" => '',
			"collect_type"   => "collects",
			"collect_count"  => $count
		);

		foreach ($result as $k => $value) {
			$mp3_url = str_replace("http://m", "https://p", $value["mp3Url"]);
			$cover_url = str_replace("http://", "https://", $value['album']['picUrl']);
			$mp3_title = str_replace('"', ' · ', $value["name"]);
			$artists = array();
			foreach ($value["artists"] as $artist) {
				$artists[] = $artist["name"];
			}

			$artists = implode(",", $artists);

			$collect["songs"][] = array(
				"song_id"     => $value["id"],
				"song_title"  => $mp3_title,
				//"song_length" => ceil($value['duration']/1000),
				"song_src"    => $mp3_url,
				"song_author" => $artists,
				"song_cover"  => $cover_url,
				"song_sheet"  => $collect_name,
				"collect_cover" => $collect_cover,
				"collect_tags" => $collect_tags 
			);
		}

		return $collect;
	}

	return false;
}

function netease_album($album_id){

	$response = netease_http(1, $album_id);

	if ($response["code"] == 200 && $response["album"]) {
		//处理音乐信息
		$result = $response["album"]["songs"];
		$count  = count($result);

		if ($count < 1) return false;

		$album_name   = $response["album"]["name"];
		$album_author = $response["album"]["artist"]["name"];
		$cover        = $response["album"]['picUrl'];
		$album_cover  = $response["album"]["blurPicUrl"];

		$album = array(
			"album_id"     => $album_id,
			"album_title"  => $album_name,
			"album_author" => $album_author,
			"album_type"   => "albums",
			"album_count"  => $count
		);

		foreach ($result as $k => $value) {
			$mp3_url = str_replace("http://m", "https://p", $value["mp3Url"]);
			$cover_url = str_replace("http://", "https://", $cover);
			$album["songs"][] = array(
				"song_id"     => $value["id"],
				"song_title"  => $value["name"],
				//"song_length" => ceil($value['duration']/1000),
				"song_src"    => $mp3_url,
				"song_author" => $album_author,
				"song_cover"  => $cover_url,
				"song_sheet"  => $album_name,
				"collect_cover" => $album_cover
			);
		}

		return $album;
	}

	return false;
}


function music_search($name,$num){ //搜索解析
	// 歌曲 1 , 专辑 10 , 歌手 100 , 歌单 1000 , 用户 1002 , mv 1004 , 歌词 1006 , 主播电台 1009
    $response = search_http($name,$num,"1"); 
    //var_dump($response);
    if ($response['code'] == 200 && $response['result']) {
        $result = $response['result']['songs'];
        $artists = $result[0]['artists'][0]['name'];
        $cover = $result[0]['album']['blurPicUrl'];
        foreach ($result as $key => $val) {
        	$mp3_url = str_replace("http://m", "https://p", $val['mp3Url']);
        	$cover_url = str_replace("http://", "https://", $cover);
        	$mp3_title = str_replace('"', ' · ', $val['name']);
	    	$music_list[] = array(
	    		"song_id" => $val['id'],
	    		"song_src" => $mp3_url,
	    		"song_down_src" => $val['mp3Url'],
	    		"song_title"  => $mp3_title,
	    		"song_author" => $artists,
	    		"song_cover" => $cover_url,
	    		"song_mv" => $val['mvid']
	    	);
    	}
    	return $music_list;
    }
    return false;
}

function song_download($song_id){ //歌曲下载

	$response = netease_http(3, $song_id);
	//var_dump($response);
	if ($response["code"] == 200 && $response["data"]) {
		$result = $response["data"]["url"];
		return $result;
	}
	return false;
}

function encrypted_id($dfsid) { 
	//网易高品质算法 http://m2.music.126.net/'.encrypted_id($id).'/'.$id.'.mp3
	$key ='3go8&$8*3*3h0k(2)2';
	$key_len = strlen($key);
	for($i = 0; $i < strlen($dfsid); $i++){
		$dfsid[$i] = $dfsid[$i] ^ $key[$i % $key_len];
	}
	$raw_code = base64_encode(md5($dfsid, true));
	$code = str_replace(array('/', '+'), array('_', '-'), $raw_code);
	return $code;
}


function netease_http($type, $id){
	$header = array(
		"Accept:*/*",
		"Accept-Language:zh-CN,zh;q=0.8",
		"Cache-Control:no-cache",
		"Connection:keep-alive",
		"Content-Type:application/x-www-form-urlencoded;charset=UTF-8",
		"Cookie:visited=true;",
		"DNT:1",
		"Host:music.163.com",
		"Pragma:no-cache",
		"Referer:http://music.163.com/outchain/player?type={$type}&id={$id}&auto=1&height=430&bg=e8e8e8",
		"User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36"
	);

	$prefix = 'http://music.163.com/api/';

	switch($type){
		//歌单
		case 0:
			$url = "playlist/detail?id={$id}&ids=%5B%22{$id}%22%5D&limit=10000&offset=0";
			break;

		//专辑
		case 1:
			$url = "album/{$id}?id={$id}&id={$id}&ids=%5B%22{$id}%22%5D&limit=10000&offset=0";
			break;
		//MV
		case 2:
			$url = "mv/detail?id={$id}&type=mp4";
			break;
		//下载
		case 3:
			$url = "song/enhance/download/url?br=320000&id={$id}"; //br = 320000 / 280000 码率
			break;
	}

	$url = $prefix . $url;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$cexecute = curl_exec($ch);
	@curl_close($ch);
	if ($cexecute) {
		$result = json_decode($cexecute, TRUE);
		return $result;
	} else {
		return false;
	}
}



