<?php
require 'Meting.php';
use Metowolf\Meting;
define('SOURCE', 'netease');

/**
 * jsonFormat
 */
function jsonFormat( $data, $indent = null ) {
    array_walk_recursive($data, 'jsonFormatProtect');
    $data = json_encode($data);
    $data = urldecode($data);
    $ret = '';
    $pos = 0;
    $length = strlen($data);
    $indent = isset($indent)? $indent : '    ';
    $newline = "\n";
    $prevchar = '';
    $outofquotes = true;
    for($i=0; $i<=$length; $i++){
        $char = substr($data, $i, 1);
        if($char=='"' && $prevchar!='\\'){
            $outofquotes = !$outofquotes;
        }elseif(($char=='}' || $char==']') && $outofquotes){
            $ret .= $newline;
            $pos --;
            for($j=0; $j<$pos; $j++){
                $ret .= $indent;
            }
        }
        $ret .= $char;
        if(($char==',' || $char=='{' || $char=='[') && $outofquotes){
            $ret .= $newline;
            if($char=='{' || $char=='['){
                $pos ++;
            }
            for($j=0; $j<$pos; $j++){
                $ret .= $indent;
            }
        }
        $prevchar = $char;
    }
    return $ret;
}  
  
/**
 * 数组urlencode
 */
function jsonFormatProtect( $val ){
    if($val!==true && $val!==false && $val!==null){
        $val = urlencode($val);
    }
}

/**
* MP3链接
* 返回 url
*/
function song( $id ) {
    $API = new Meting(SOURCE);
    $result = $API->format(true)->url($id);
    $data = json_decode($result);
    $url = str_replace('http://', 'https://', $data->url);
    if (strstr($url, 'm7c')) {
        $url = str_replace('https://m7c', 'https://m8', $url);
    }
    elseif(strstr($url, 'm8c')) {
        $url = str_replace('https://m8c', 'https://m8', $url);
    }
    
    return $url;
}

/**
* 专辑图片
* 返回 url
*/
function cover( $id ) {
    $API = new Meting(SOURCE);
    $result = $API->format(true)->pic($id);
    $data = json_decode($result);

    return $data->url;
}

/**
* 歌单
* 返回 id, name, artist, pic_id
*/
function data_playlist( $id, $source ) {
    $API = new Meting($source);
    $result = json_decode( $API->format(true)->playlist($id) );

    return $result;
}

/**
* 专辑
* 返回 id, name, artist, pic_id
*/
function data_album( $id, $source ) {
    $API = new Meting($source);
    $result = json_decode( $API->format(true)->album($id) );

    return $result;
}

/**
 * 输出JSON
 */  
function get_jsons( $id, $type ) {
    switch ( $type ) {
        case 1:
            $data = data_playlist($id, SOURCE);
            break;
        case 2:
            $data = data_album($id, SOURCE);
            break;
    }
    $json = '';
    if ( !empty($data) ) {
        foreach ($data as $key => $song) {
            $lrc = POI_URL.'/inc/lrc.php?id='.$song->id;
            $json .= jsonFormat(
                array(
                'title' =>$song->name,
                'artist' => $song->artist[0],
                'album' => $song->album,
                'pid' => $song->pic_id,
                'mid' => $song->id,
                'lrc' => $lrc
                )
            );
            $json .=',';
        }

        return $json;
    }

    return '检查ID和类型。';
}
