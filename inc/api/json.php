<?php
/*
 * http://blog.csdn.net/fdipzone/article/details/28766357
 */

function jsonFormat($data, $indent=null){  
  
    // 对数组中每个元素递归进行urlencode操作，保护中文字符  
    array_walk_recursive($data, 'jsonFormatProtect');  
  
    // json encode  
    $data = json_encode($data);  
  
    // 将urlencode的内容进行urldecode  
    $data = urldecode($data);  
  
    // 缩进处理  
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
  
/** 将数组元素进行urlencode 
* @param String $val 
*/  
function jsonFormatProtect(&$val){  
    if($val!==true && $val!==false && $val!==null){  
        $val = urlencode($val);  
    }  
}  

function get_jsons($id,$type){
    $data = array();
    switch ($type) {
    case 1:
        $data = netease_playlist($id);
        break;
    case 2:
        $data = netease_album($id);
        break;
    }
    $data = $data['songs'];
    //var_dump($data);
    $has_tag = '';
    if($data){
        foreach ($data as $k => $v) {
            if($v['collect_tags']){
                $has_tag = $v['collect_tags'];
            }else{
                $has_tag = '暂无标签';
            }
            $lrc = POI_URL.'/inc/lrc.php?id='.$v['song_id'].'';
            $json .= jsonFormat(
                        array(
                            'album' => $v['song_sheet'], 
                            'list' => array(
                                'title' =>$v['song_title'], 
                                'artist' => $v['song_author'], 
                                'cover' => $v['song_cover'].'?param=300x300', 
                                'mp3' => $v['song_src'], 
                                'lrc' => $lrc
                                ), 
                            'tags' => $has_tag
                        )
                    );

            $json .=','; 

            //重新设计JSON结构 20160922 @Louie
        }
        return $json;
    }

    return '非法操作，请检查ID或类型是否存在错误。';
    
}


/*音乐搜索*/
function get_search_jsons($input){
    $poi = get_option('poi_options');
    $search_num = $poi['searchnum'] ? $poi['searchnum'] : '20';
    if($search_num >= 100){
        $search_num = '100';
    }
    $list = array();
    $list = music_search($input, $search_num);
    $cd = POI_URL.'/build/images/cd-2.png';
    $search = '';
    if($list){
        foreach ($list as $key => $val) {
        $lrc = POI_URL.'/inc/lrc.php?id='.$val['song_id'].'';
        $search .= jsonFormat(
                    array(
                        'search' => $input,
                        'list' => array(
                        'title' =>$val['song_title'], 
                        'artist' => $val['song_author'], 
                        'cover' => $val['song_cover'].'?param=300x300', 
                        'mp3' => $val['song_src'],
                        'download' => $val['song_down_src'], 
                        'lrc' => $lrc,
                        'mvid' => $val['song_mv'],
                        'cd' => $cd
                        )
                    )
                );

            $search .=',';
        }
        return $search;
    }

    return false;  
}